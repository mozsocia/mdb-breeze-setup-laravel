<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class LoginRegContorller extends Controller
{

    use AuthBaseController;
    /**
     * Display the registration view.
     */
    public function reg_create(): View
    {
        return view($this->view . 'auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reg_store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . $this->model],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $this->model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $this->sendEmailVerification($user);
        }


        Auth::guard($this->guard)->login($user);

        return redirect($this->home);
    }

    public function sendEmailVerification($user) {
        $verificationUrl = URL::temporarySignedRoute(
            $this->name_prefix . 'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        Mail::send('emails.verify-email', ['verificationUrl' => $verificationUrl], 
        function ($message) use ($user) {
            $message->to($user->email)->subject('Verify Your Email Address');
        });
    }

    /**
     * Display the login view.
     */
    public function login_create(): View
    {
        return view($this->view . 'auth.login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login_store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $this->authenticate($request);

        $request->session()->regenerate();

        return redirect()->intended($this->home);
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function authenticate($request): void
    {
        $this->ensureIsNotRateLimited($request);

        if (!Auth::guard($this->guard)->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited($request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey($request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

}
