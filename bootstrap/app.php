<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->redirectGuestsTo(function (Request $request) {
            
            // Se a rota for da API, aborta imediatamente com o JSON 401
            if ($request->is('api/*')) {
                abort(response()->json([
                    'erro' => 'Não autenticado. Token ausente ou inválido.'
                ], 401));
            }
            
            // Se um dia você tiver um Front-end Web no mesmo projeto, ele cai aqui:
            // return route('login'); 
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Força  retorno em JSON se a rota for 'api/'
        // $exceptions->renderable(function (AuthenticationException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'erro' => 'Não autenticado. Token ausente ou inválido.'
        //         ], 401);
        //     }
        // });
    })->create();
