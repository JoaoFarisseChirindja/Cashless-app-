<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagerPermission
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

        if ($user->role !== 'manager') {
            return response()->json(['error' => 'Acesso negado. Apenas gerentes podem realizar esta ação.'], 403);
        }

        if (in_array($roleToCreate, ['admin', 'manager'])) {
            return response()->json(['error' => 'O gerente não pode criar administradores ou outros gerentes.'], 403);
        }

        return $next($request);
    }
}
