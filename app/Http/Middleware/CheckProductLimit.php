<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProductLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->products()->count() >= 5) {
            return redirect()->route('products.index')
                ->with('error', 'لقد وصلت إلى الحد الأقصى من المنتجات (5).');
        }

        return $next($request);
    }
}
