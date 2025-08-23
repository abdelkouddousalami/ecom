<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogFormSubmissions
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('POST') && $request->path() === 'admin/products') {
            Log::info('ADMIN FORM SUBMISSION:', [
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'all_data' => $request->all(),
                'customizable_field' => $request->input('customizable'),
                'has_customizable' => $request->has('customizable'),
            ]);
        }
        
        return $next($request);
    }
}
