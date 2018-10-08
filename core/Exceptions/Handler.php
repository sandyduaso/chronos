<?php

namespace Pluma\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Pluma\Support\Exceptions\Handler as BaseHandler;

class Handler extends BaseHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return $this->renderAjaxExceptions($request, $exception);
        } else {
            return $this->renderExceptions($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Render an exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    protected function renderAjaxExceptions($request, $exception)
    {
        // 403 | Authorization exception
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException
            || $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
        ) {
            return response()->json(["[ERR 403] Unauthorized request"], 403);
        }

        // 404 | Model not found exception
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'errors' => [
                    'status' => 404,
                    'source' => ['pointer' => ''],
                    'title' => $exception->getMessage(),
                    'detail' => 'Model requested not found.',
                ]
            ], 404);
        }

        return parent::render($request, $exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptions($request, $exception)
    {
        // API
        // All api's will render 404 if accessed through web browser
        // and not through ajax.
        //
        // TODO: if (regex('api/v1', $request->path()) return view::404

        # 404 Exception
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->view("Theme::errors.404", [
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => $exception->getMessage(),
                    'description' => config('errors.messages.404'),
                ]
            ], 404);
        }

        # 404 Exception
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view("Theme::errors.404", [
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => $exception->getMessage(),
                    'description' => config('errors.messages.404'),
                ]
            ], 404);
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException
            || $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
        ) {
            return response()->view('Theme::errors.403', [
                'error' => [
                    'code' => 'NOT_AUTHORIZED',
                    'message' => $exception->getMessage(),
                    'description' => config('errors.messages.403'),
                ]
            ], 403);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(config('path.login', 'login'));
    }
}
