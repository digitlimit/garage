<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Create a new exception handler instance.
     *
     * @return void
     */
    public function __construct(
        Container $container,
        readonly private ResponseHelper $response
    ) {
        parent::__construct($container);
    }

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

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        if ($e->response) {
            return $e->response;
        }

        return $this->shouldReturnJson($request, $e) || $request->is('api/*')
            ? $this->invalidJson($request, $e)
            : $this->invalid($request, $e);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['message' => $exception->getMessage()], 401);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        return match (true) {
            $e instanceof ModelNotFoundException => $this->response->notFound(),
            $e instanceof AuthenticationException => $this->response->unauthenticated(),
            $e instanceof RecordsNotFoundException => $this->response->notFound('Record not found'),
            $e instanceof AuthorizationException => $this->response->denied(),
            $e instanceof MethodNotAllowedHttpException => $this->response->methodNotSupported(),

            default => parent::render($request, $e)
        };
    }
}
