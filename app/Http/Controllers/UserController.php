<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = $this->userService->listarTodos();

        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $usuario = $this->userService->criarUsuario($data);

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $usuario = $this->userService->buscarPorId($id);

        if (! $usuario) {
            return response()->json(['erro' => 'Usuario nao encontrado'], 404);
        }

        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $atualizado = $this->userService->atualizarUsuario($id, $data);

        if (! $atualizado) {
            return response()->json(['erro' => 'Usuario nao encontrado para atualizar'], 404);
        }

        return response()->json(['mensagem' => 'Usuario atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $deletado = $this->userService->deletarUsuario($id);

        if (! $deletado) {
            return response()->json(['erro' => 'Usuario nao encontrado para exclusao'], 404);
        }

        return response()->json(null, 204);
    }
}
