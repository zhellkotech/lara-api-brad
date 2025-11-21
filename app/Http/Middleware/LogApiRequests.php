<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        Log::info('API Request:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'parameters' => $request->all(),
        ]);

        // $logMessage = 'API Request:' . PHP_EOL .
        //     'URL: ' . $request->fullUrl() . PHP_EOL .
        //     'Method: ' . $request->method() . PHP_EOL .
        //     'Parameters: ' . json_encode($request->all()) . PHP_EOL . PHP_EOL;

        // file_put_contents(storage_path('logs/api.log'), $logMessage, FILE_APPEND);

        return $next($request);
    }
}
