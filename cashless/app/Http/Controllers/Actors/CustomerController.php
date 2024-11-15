<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function home()
    {
        return view('actors.custormer.home');
    }
    public function show()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => 'customer',
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Cliente registrado com sucesso!', 'user' => $user], 201);
    }
    public function update(CreateUserRequest $request)
    {
        $user = Auth::user()->id;

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return response()->json(['message' => 'Perfil atualizado com sucesso!', 'user' => $user], 200);
    }
    public function destroy()
    {
        $user = Auth::user()->id;
        $user->delete();
        return response()->json(['message' => 'Conta deletada com sucesso!'], 200);
    }
}
