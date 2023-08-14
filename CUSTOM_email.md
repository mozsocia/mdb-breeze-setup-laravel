
`php artisan vendor:publish --tag=laravel-mail`

AuthServiceProvider boot method
```php
public function boot()
{
    $this->registerPolicies();

    //

    VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new MailMessage)
            ->subject('Verify Email Address moz')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $url);
    });


}
```