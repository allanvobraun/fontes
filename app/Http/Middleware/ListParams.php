<?php

namespace App\Http\Middleware;

use Closure;

class ListParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $field)
    {
        $requestData = $request;
        $new_field = explode(",", $request->input($field));
        $requestData[$field] = $new_field;
        return $next($requestData);
    }
}
