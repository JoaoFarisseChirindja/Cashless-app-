@extends('layouts.admin.master')
@section('content')
<div class="container" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Atualizar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Para indicar uma atualização -->
                <div class="modal-body">
                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="update_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="update_name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <!-- Telefone -->
                    <div class="mb-3">
                        <label for="update_phone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="update_phone" name="phone" value="{{ $user->phone }}" required>
                    </div>

                    <!-- Tipo de Usuário -->
                    <div class="mb-3">
                        <label  for="role" class="form-label">Tipo de Usuário</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="promoter" {{ $user->role === 'promoter' ? 'selected' : '' }}>Promoter</option>
                            <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="update_status" class="form-label">Status</label>
                        <select class="form-select" id="update_status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="update_email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Imagem -->
                    <div class="mb-3">
                        <label for="update_image" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="update_image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
