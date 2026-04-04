<?php

    namespace App\Services\Interfaces;

    use App\Models\User;

    interface AuthServiceInterface {
        /**
         * Tenta realizar o login e retorna o token em texto, null se falhar.
         */

        public function login(array $credenciais): ?string;
    }