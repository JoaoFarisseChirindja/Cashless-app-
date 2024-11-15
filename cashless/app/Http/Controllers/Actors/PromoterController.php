<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PromoterController extends Controller
{
    public function dashboard()
    {
        return view('actors.promoter.dashborad');
    }
    public function index()
    {
        $staff = User::where('role', 'staff')->get();
        return response()->json(['staff' => $staff], 200);
    }
    public function show($id)
    {
        $user = User::find($id);


        if ($user && $user->id === Auth::id()) {
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['error' => 'Você não pode acessar esse usuário.'], 403);
    }

    public function store(CreateUserRequest $request)
    {
        if ($request->role !== 'staff') {
            return response()->json(['error' => 'O promoter só pode criar staff.'], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => 'staff',
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Staff criado com sucesso!', 'user' => $user], 201);
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
        return response()->json(['message' => 'Perfil deletado com sucesso!'], 200);
    }
}
