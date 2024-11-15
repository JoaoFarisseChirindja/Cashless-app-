<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
    return Auth::check() && in_array($user->role, ['admin', 'manager', 'promoter', 'customer']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
        $role = $this->input('role');


        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,manager,promoter,customer,staff',
        ];

        if ($this->is('admin/*')) {
            if ($role === 'admin') {
                abort(403, 'Não pode criar este usuário');
            }
        } elseif ($this->is('manager/*')) {
            if (in_array($role, ['admin', 'manager'])) {
                abort(403, 'Não pode criar este usuário (administrador ou gerente)');
            }
        } elseif ($this->is('promoter/*')) {
            if ($role !== 'staff') {
                abort(403, 'O promotor só pode criar Funcionários.');
            }
        } elseif ($this->is('customer/*')) {
            if ($role !== 'customer') {
                abort(403, 'Não tem permissão para criar usuários');
            }
        } elseif ($this->is('staff/*')) {
            abort(403, 'Não tem permissão para criar usuários');
        }

        return $rules;
    }
}
