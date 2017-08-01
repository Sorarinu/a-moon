<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckForMaintenanceMode
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance()) {
            $ip = $request->getClientIp();
            Log::debug($ip);
            $allowIp = explode(',', env('MAINTENANCE_IP'));
            if (!is_array($allowIp) || !in_array($ip, $allowIp)) {
                throw new HttpException(503);
            }
        }
        return $next($request);
    }
}
