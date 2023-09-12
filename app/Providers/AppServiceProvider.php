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
        Response::macro('jsonResponse', function (bool $success = true, string $message = '', array $data = [], int $code = HttpStatusCodes::HTTP_OK): \Illuminate\Http\JsonResponse {
            return Response::json([
                'success' => $success,
                'message' => $message,
                'data' => $data
            ], $code);
        });

        Response::macro('resource', function ($resource = null, string $message = ''): \Illuminate\Http\JsonResponse {
            return Response::jsonResponse(
                true,
                $message,
                ['resource' => $resource],
                HttpStatusCodes::HTTP_OK
            );
        });

        Response::macro('validateFailed', function (array $data = []): \Illuminate\Http\JsonResponse {
            return Response::jsonResponse(false, 'An error occurred while checking for validity.', $data, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
        });

        Response::macro('created', function (array $data = []): \Illuminate\Http\JsonResponse {
            return Response::jsonResponse(true, 'Create new resource successfully.', $data, HttpStatusCodes::HTTP_CREATED);
        });

        Response::macro('updated', function ($model): \Illuminate\Http\JsonResponse {
            return Response::resource($model, 'Updated resource successfully.');
        });

        Response::macro('deleted', function (): \Illuminate\Http\JsonResponse {
            return Response::resource(null, 'Deleted resource successfully.');
        });

        Response::macro('restored', function ($model): \Illuminate\Http\JsonResponse {
            return Response::resource($model, 'Resource recovery successful.');
        });

        Response::macro('developing', function (): \Illuminate\Http\JsonResponse {
            return Response::jsonResponse(
                false,
                'This feature is under development and will be updated in the next version. We apologize for any inconvenience and appreciate your understanding.',
                [],
                HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
            );
        });
    }
}
