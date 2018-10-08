<?php

namespace Pluma\Support\CORS\Middleware;

use Closure;
use Asm89\Stack\CorsService;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Request;
use Illuminate\Http\Response as AppResponse;
use Symfony\Component\HttpFoundation\Response;

class CORS
{
    /**
     * CorsService instance.
     *
     * @var CorsService
     */
    protected $cors;

    /**
     * Dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * Inject the CorsService and Dispatcher on initialization.
     *
     * @param CorsService $cors
     */
    public function __construct(CorsService $cors, Dispatcher $events)
    {
        $this->cors = $cors;

        $this->events = $events;
    }

    /**
     * Handle an incoming request. Based on Asm89\Stack\Cors by asm89
     *
     * @see https://github.com/asm89/stack-cors/blob/master/src/Asm89/Stack/Cors.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->cors->isCorsRequest($request)) {
            return $next($request);
        }

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', config('cors.allowedOrigins', '*'));
        $response->headers->set('Access-Control-Allow-Headers', config('cors.allowedHeaders'));
        $response->headers->set('Access-Control-Allow-Methods', config('cors.allowedMethods'));

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    protected function addHeaders(Request $request, Response $response)
    {
        // Prevent double checking
        if (! $response->headers->has('Access-Control-Allow-Origin')) {
            $response = $this->cors->addActualRequestHeaders($response, $request);
        }

        $response->headers->set('Access-Control-Allow-Headers', 'Authorization, X-Requested-With, Origin, X-Auth-Token, X-CSRF-Token, Content-type');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        return $response;
    }
}
