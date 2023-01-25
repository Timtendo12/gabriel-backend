<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        //dd("IT GOES THROUGH HERE!");
        $headers = [
            'Access-Control-Allow-Origin' => "http://10.0.2.98:19000",
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin',
        ];
        if ($request->getMethod() == "OPTIONS") {
            return Response('OK', 200, $headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value)
            $response->header($key, $value);
        return $response;
    }
}
