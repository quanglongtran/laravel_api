<?php

namespace App\Providers;

use App\Commons\HttpStatusCodes;
use App\Observers\PermissionObserver;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('jsonResponse', function (bool $success = true, string $message = '', array $data = [], int $code = HttpStatusCodes::HTTP_OK) {
            return Response::json([
                'success' => $success,
                'message' => $message,
                'data' => $data
            ], $code);
        });

        Response::macro('validateFailed', function (array $data = []) {
            return Response::jsonResponse(false, 'An error occurred while checking for validity.', $data, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
        });

        Response::macro('created', function (array $data = []) {
            return Response::jsonResponse(true, 'Create new resource successfully.', $data, HttpStatusCodes::HTTP_CREATED);
        });

        Response::macro('updated', function (array $data = []) {
            return Response::jsonResponse(true, 'Updated resource successfully.', $data, HttpStatusCodes::HTTP_OK);
        });

        Response::macro('deleted', function () {
            return Response::jsonResponse(true, 'Deleted resource successfully.', [], HttpStatusCodes::HTTP_OK);
        });
    }
}
