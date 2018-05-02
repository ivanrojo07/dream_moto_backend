<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $trusted_domains = ["http://localhost:8100","http://localhost:8100/?ionicplatform=android","http://localhost:8100/ionic-lab", "*"];
        if (isset($request->server()['HTTP_ORIGIN'])) {
            # code...
            $origin = $request->server()['HTTP_ORIGIN'];
            if (in_array($origin,$trusted_domains)) {
                # code...
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: Content-Type');
                
            }
        }
        return $next($request);
    }
}
