<?php

namespace App\Http\Middleware;

use Closure;

class SetEnterpriseId
{
    public function handle($request, Closure $next)
    {
        $enterpriseId = $request->user()->enterprise_id;
        $request->attributes->set('enterprise_id', $enterpriseId);

        return $next($request);
    }
}
