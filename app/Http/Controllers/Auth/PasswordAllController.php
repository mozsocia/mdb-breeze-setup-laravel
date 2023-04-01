<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\View\View;

class PasswordAllController extends Controller
{
    use AuthBaseController;

    /**
     * Display the password reset link request view.
     */
    public function forgot_create(): View
    {
        return view($this->view . 'auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function forgot_store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $user = $this->model::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Check if there is already a password reset token for the given email
        $existingToken = DB::table('password_resets')->where('email', $request->email)->first();

        if ($existingToken) {
            // Use the existing password reset token
            $token = $existingToken->token;
        } else {
            // Generate a new password reset token
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        // Send reset password email

        $resetLink = url(route($this->prefix . 'password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        Mail::send('emails.password-reset', ['resetLink' => $resetLink], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Your Password');
        });

        return back()->with('status', 'We have emailed your password reset link!');
    }

    /**
     * Display the password reset view.
     */
    public function reset_create(Request $request): View
    {
        return view($this->view . 'auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset_store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid reset token.']);
        }

        $user = $this->model::where('email', $reset->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete the password reset token from the database
        DB::table('password_resets')->where('email', $reset->email)->delete();

        return redirect()->route($this->prefix . 'login')->with('status', 'Your password has been reset!');

        return back()->withInput($request->only('email'));
    }
}
