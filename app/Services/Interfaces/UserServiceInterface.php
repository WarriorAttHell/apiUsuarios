<?php

    namespace App\Services\Interrfaces;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Collection;

    interface UserServiceInterface {
        public function listarTodos(): Collection;
        public function buscarPorId(int $id): ?User;
        public function criarUsuario(array $data): User;
        public function atualizarUsuario(int $id, array $data): bool;
        public function deletarUsuario(int $id): bool;
    }