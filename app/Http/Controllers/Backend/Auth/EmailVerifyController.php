<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class EmailVerifyController extends Controller
{
    use AuthBaseController;
    /**
     * Display the email verification prompt.
     */
    public function notice(Request $request): RedirectResponse | View
    {
        return $request->user()->hasVerifiedEmail()
        ? redirect()->intended($this->home)
        : view($this->view . 'auth.verify-email');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->home . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($this->home . '?verified=1');
    }

    /**
     * Send a new email verification notification.
     */
    public function send(Request $request)
    {
        $user = $request->user();

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->home)->with('status', 'already verified');
        }

        $verificationUrl = URL::temporarySignedRoute(
            $this->prefix . 'verification.verify',
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

        // $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Email Verification Link Sent');
    }
}
