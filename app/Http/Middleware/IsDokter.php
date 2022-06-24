<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsDokter
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
        $role = User::find(Auth::id());

        if (!$role) {
            return redirect('home');
        }

        if ($role->role->nama !== 'Dokter') {
            return redirect('home');
        }

        return $next($request);
    }
}
