<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $roleToCreate = $request->input('role');

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Acesso negado. Apenas administradores podem realizar esta ação.'], 403);
        }

        if ($roleToCreate === 'admin') {
            return response()->json(['error' => 'O administrador não pode criar outro admin.'], 403);
        }


        return $next($request);
    }
}
