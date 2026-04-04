<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function listarTodos(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function buscarPorId(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function criarUsuario(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $data['is_active'] = true;

        return $this->userRepository->create($data);
    }

    public function atualizarUsuario(int $id, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($id, $data);
    }

    public function deletarUsuario(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
