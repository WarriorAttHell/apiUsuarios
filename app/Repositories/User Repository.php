<?php

    namespace App\Repositories;

    use App\Models\User;
    use App\Repositories\Interface\UserRepositoryInterface;
    use Illiminate\Database\Eloquent\Collection;

    class UserRepository implements UserRepositoryInterface {
        public function getAll(): Collection {
            return User::all();
        }

        public function findById(int $id): ?User {
            return User::find($id);
        }

        public function findbyEmailOrLogin(string $identifier): ?User {
            // Útil no login: Permite que usuário entre com e-mail ou login
            return User::where('email', $identifier)
                        ->orWhere('login', $identifier)
                        ->first();
        }

        public function create(array $data): User {
            return User::create($data);
        }

        public function update(int $id, array $data) : bool {
            $user = $this->findById($id);

            if(!$user){
                return false;
            }

            return $user->update($data);
        }

        public function delete(int $id): bool {
            $user = $this->findById($id);

            if(!$user){
                return false;
            }

            return $user->delete();
        }
    }