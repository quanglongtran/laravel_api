<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    public const EXPLICIT_BINDINGS = [
        'postCategory' => \App\Models\PostCategory::class,
        'postThread' => \App\Models\PostThread::class,
        'post' => \App\Models\Post::class,
        'role' => \App\Models\Role::class,
        'permission' => \App\Models\Permission::class,
        'user' => \App\Models\User::class,
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::pattern('model', '\d+');

        foreach (self::EXPLICIT_BINDINGS as $name => $class) {
            Route::model($name, $class);
            Route::model(
                "{$name}WithTrashed",
                $class,
                fn ($id) =>
                $class::withTrashed()->findOrFail($id)
            );
        }
    }
}
