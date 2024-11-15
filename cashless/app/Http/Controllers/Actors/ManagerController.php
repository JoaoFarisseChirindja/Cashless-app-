<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboard()
    {
        return view('actors.manager.dashborad');
    }
    public function index()
    {
        $users = User::whereNotIn('role', ['admin', 'manager'])->get();
        return response()->json(['users' => $users], 200);
    }

    public function store(CreateUserRequest $request)
    {
        if (in_array($request->role, ['admin', 'manager'])) {
            return response()->json(['error' => 'Você não pode criar admins ou managers.'], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Usuário criado com sucesso!', 'user' => $user], 201);
    }

    public function show($id)
    {
        $user = User::find($id);


        if ($user && $user->id === Auth::id()) {
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['error' => 'Você não pode acessar esse usuário.'], 403);
    }


    public function update(CreateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user || $user->id !== Auth::id()) {
            return response()->json(['error' => 'Você não pode editar esse perfil.'], 403);
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return response()->json(['message' => 'Perfil atualizado com sucesso!', 'user' => $user], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user || $user->id !== Auth::id()) {
            return response()->json(['error' => 'Você não pode deletar esse perfil.'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso!'], 200);
    }
}
