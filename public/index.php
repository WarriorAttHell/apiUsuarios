<?php

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

if (file_exists(__DIR__ . '/../vendor/autoload.php') && file_exists(__DIR__ . '/../bootstrap/app.php')) {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->handleRequest(\Illuminate\Http\Request::capture());

    return;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel pronto para subir</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4ecf7 100%);
            color: #102a43;
        }

        main {
            width: min(720px, calc(100vw - 32px));
            background: #ffffff;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(16, 42, 67, 0.12);
        }

        h1 {
            margin-top: 0;
            font-size: 2rem;
        }

        p {
            line-height: 1.5;
        }

        code {
            background: #f0f4f8;
            border-radius: 6px;
            padding: 2px 6px;
        }

        ul {
            padding-left: 18px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <main>
        <h1>Base Docker para Laravel pronta</h1>
        <p>O Nginx, o PHP 8.4 FPM e o PostgreSQL ja estao configurados para um projeto Laravel.</p>
        <p>Assim que os arquivos do framework estiverem na raiz do projeto, este mesmo <code>public/index.php</code> passa a iniciar a aplicacao normalmente.</p>
        <ul>
            <li>Suba os containers com <code>docker compose up -d --build</code>.</li>
            <li>Instale as dependencias com <code>docker compose exec app composer install</code>.</li>
            <li>Gere a chave com <code>docker compose exec app php artisan key:generate</code>.</li>
            <li>Rode as migrations com <code>docker compose exec app php artisan migrate</code>.</li>
        </ul>
    </main>
</body>
</html>
