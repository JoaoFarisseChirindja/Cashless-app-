<?php

namespace App\Http\Controllers\Actors;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard ()
    {
        $users = User::whereNot('role', 'admin')->get();
        return view('actors.admin.dashborad', compact('users'));
    }
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }
    public function create()
    {
        return view('actors.admin.users.create');
    }

    public function edit($id)
    {
        if(!($user = User::find($id)))
        return redirect()->back();

        return view('actors.admin.users.edit', compact('user'));
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();


        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);


        return redirect()->back();
    }


    public function show($id)
    {
        if(!($user = User::find($id)))
        {
            redirect()->back();
        }

        return $user ? response()->json(['user' => $user], 200) : response()->json(['error' => 'Usuário não encontrado.'], 404);
    }


    public function update(CreateUserRequest $request, $id)
    {

        if (!($user = User::find($id))) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $data['password']->filled('password') ? bcrypt($data['password']) : $user->password,
            'role' => $data['role'],
        ]);

        return response()->json(['message' => 'Usuário atualizado com sucesso!', 'user' => $user], 200);
    }


    public function destroy($id)
    {
        if (!($user = User::find($id))) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->back();
    }
}
