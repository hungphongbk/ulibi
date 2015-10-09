<?php

namespace App\Http\Middleware;

use App\Ulibier;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdministratorMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     * Check if current user is Admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->guest()) {
            return redirect()->to('/admin/login');
        }
        /** @var Ulibier $user */
        $user=$this->auth->user();
        if(!$user->permission->isAdmin){
            return redirect()->to('/admin/login');
        }
        return $next($request);
    }
}
