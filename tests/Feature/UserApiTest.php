<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase; 

    public function test_deve_criar_um_usuario_via_api_e_criptografar_a_senha_no_banco(): void
    {
        // 1. ARRANGE (Preparar o ambiente)
        
        // A. Criamos um usuário "Admin" no banco em memória só para poder logar
        $admin = User::factory()->create([
            'login' => 'admin_master',
            'is_active' => true,
        ]);

        // B. A Chave Mestra: Falamos pro Laravel fingir que o Admin está com o token na mão
        Sanctum::actingAs($admin);

        // C. Os dados do NOVO usuário que o Admin vai tentar criar
        $payload = [
            'name' => 'Usuário de Teste',
            'email' => 'teste@automacao.com',
            'login' => 'testador',
            'password' => 'senhaSuperSecreta123'
        ];

        // 2. ACT (Agir - Disparar a requisição agora como "logado")
        $response = $this->postJson('/api/users', $payload);

        // 3. ASSERT (Verificar as garantias da Engenharia)
        
        // A API deve ter retornado status 201 (Created)
        $response->assertStatus(201);

        // O JSON de resposta deve conter os dados
        $response->assertJsonFragment([
            'name' => 'Usuário de Teste',
            'email' => 'teste@automacao.com',
        ]);

        // O usuário novo deve existir na tabela 'users'
        $this->assertDatabaseHas('users', [
            'email' => 'teste@automacao.com',
            'login' => 'testador',
        ]);

        // A senha em texto puro NÃO pode estar no banco!
        $this->assertDatabaseMissing('users', [
            'password' => 'senhaSuperSecreta123'
        ]);
    }
}