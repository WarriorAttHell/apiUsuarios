<?php

    namespace App\Services;

    use App\Models\User;
    use App\Services\Interfaces\AuthServiceInterface;
    use App\Repositories\Interfaces\UserRepositoryInterface;
    use Illuminate\Support\Facades\Hash;

    class AuthService implements AuthServiceInterface {
        public function __construct(
            private UserRepositoryInterface $userRepository
        ) { }

        public function login(array $credenciais): ?string {
            // Busca por e-mail ou pelo login
            $identifcador = $credenciais['login'] ?? '';
            $senha = $credenciais['password'] ?? '';

            $usuario = $this->userRepository->findByEmailOrLogin($identifcador);

            // Valida se o usuário está ativo
            if(!$usuario || !Hash::check($senha, $usuario->password)) {
                return null; //Usuário desativado não faz login
            }

            // Sanctum Gera e retorna token de acesso
            return $usuario->createToken('acess_token')->plainTextToken;
        }
    }