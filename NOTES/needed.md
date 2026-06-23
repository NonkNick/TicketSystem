Sanctum Middleware

Next, you should instruct Laravel that incoming requests from your SPA can authenticate using Laravel's session cookies, while still allowing requests from third parties or mobile applications to authenticate using API tokens. This can be easily accomplished by invoking the statefulApi middleware method in your application's bootstrap/app.php file:

->withMiddleware(function (Middleware $middleware): void {
$middleware->statefulApi();
})

https://laravel.com/docs/13.x/sanctum#spa-authentication