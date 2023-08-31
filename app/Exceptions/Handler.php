<?php

namespace App\Exceptions;

use App\Commons\HttpStatusCodes;
use Illuminate\Support\Facades\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        // if your api client has the correct content-type this expectsJson() 
        // should work. if not you may use $request->is('/api/*') to match the url.

        if ($request->expectsJson()) {
            if ($exception instanceof AuthenticationException) {
                return Response::jsonResponse(false, 'Unauthenticated', [], HttpStatusCodes::HTTP_UNAUTHORIZED);
            }

            if ($exception instanceof ValidationException) {
                return Response::validateFailed(['errors' => $exception->validator->getMessageBag()]);
            }

            if ($exception instanceof BadRequestException) {
                return Response::jsonResponse(false, $exception->getMessage(), [], $exception->getCode());
            }

            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return Response::jsonResponse(false, $exception->getMessage(), [], HttpStatusCodes::HTTP_FORBIDDEN);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                return Response::jsonResponse(false, $exception->getMessage(), [], HttpStatusCodes::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return Response::jsonResponse(false, $exception->getMessage(), [], HttpStatusCodes::HTTP_NOT_FOUND);
            }

            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return Response::jsonResponse(false, 'This resource does not exist', [], HttpStatusCodes::HTTP_NOT_FOUND);
            }

            if ($exception instanceof \Spatie\Permission\Exceptions\PermissionDoesNotExist) {
                return Response::jsonResponse(false, $exception->getMessage(), [], HttpStatusCodes::HTTP_NOT_FOUND);
            }

            logger($exception);
            return Response::jsonResponse(false, 'Server bị cháy', [], HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }
}
