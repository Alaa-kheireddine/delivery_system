<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if(! $user->must_change_password ){
            return $next($request);
        }

        if ($user->temporary_password_expires_at?->isPast()) {
            Auth::logout();

            $session = $request->session();

            $session->invalidate();
            $session->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'Temporary password expired.');
        }

        if ($request->routeIs('password.force-change', 'password.force-change.update', 'logout')) {
            return $next($request);
        }

        return redirect()->route('password.force-change');
    }
}
