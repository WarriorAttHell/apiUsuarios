<?php
    namespace App\Services;

    use App\Services\Interfaces\UserServiceInterfaces;
    use App\Rpositories\Interfaces\UserRepositoryInterface;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Database\Eloquent\Collection;

    class UserService implements UserServiceInterface {

        public function __construct(
            private UserRepositoryInterface $userRepository
        ) {}

        public function listarTodos(): Collection {
            return $this->userRepository->getAll();
        }

        public function buscarPorId(int $id): ?User {
            return $this->userRepository->findById($id);
        }

        public function criarUsuario(array $data): User {
            // criptografar senha antes de salvar
            if(isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $data['is_active'] = true;

            return $this->userRepository->create($data);
        }

        public function ataulizarUsuario(int $id, array $data): bool {
            // Se enviado uma nova senha, deve criptografar a mesma
            if(isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            return $this->userRepository->update($id, $data);
        }

        public function deletarUsuario(int $id): bool {
            return $this->userRepository->delete($id);
        }

    }