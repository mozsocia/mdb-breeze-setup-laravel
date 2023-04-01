<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerifiedCustom
{

    public function handle($request, Closure $next, $routeNamePrefix = null)
    {
        if (!Auth::check() || Auth::user()->hasVerifiedEmail()) {
            return $next($request);
        }

        $prefix = $routeNamePrefix? $routeNamePrefix . "." : "";

        $verificationUrl = URL::temporarySignedRoute(
            $prefix . 'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => Auth::user()->getKey(),
                'hash' => sha1(Auth::user()->getEmailForVerification()),
            ]
        );

        Mail::send('emails.verify-email', ['verificationUrl' => $verificationUrl], function ($message) {
            $message->to(Auth::user()->email)->subject('Verify Your Email Address');
        });

        return $request->expectsJson()
        ? abort(403, 'Your email address is not verified.')
        : redirect()->route($prefix . 'verification.notice')->with('status', 'Email verification link sent, Please check');

    }
}
