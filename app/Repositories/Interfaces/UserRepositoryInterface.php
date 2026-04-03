<?php

    namespace App\Repositories\Interfaces;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Collections;

    interface UserRepositorieInterface {
        public function getAll(): Collection;
        public function findById(int $id);
        public function findByEmailOrLogin( string $identifier): ?User;
        public function create(array $data): User;
        public function update(int $id, array $data): bool;
        public function delete( int $id): bool;
    }