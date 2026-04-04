<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceInterface $authService
    ) {}

    public function login(Request $request)
    {
        $credenciais = $request->only(['login', 'password']);
        $token = $this->authService->login($credenciais);

        if (! $token) {
            return response()->json([
                'erro' => 'Credenciais invalidas ou usuario inativo',
            ], 401);
        }

        return response()->json([
            'mensagem' => 'Login realizado com sucesso',
            'token' => $token,
        ], 200);
    }
}
