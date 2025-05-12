<?php


// Verifica se é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo JSON da requisição
    $input = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados foram enviados
    if (!isset($input['username']) || !isset($input['senha'])) {
        echo json_encode(["sucesso" => false, "mensagem" => "Dados incompletos"]);
        exit;
    }

    $username = strtolower(trim($input['username']));
    $novaSenha = $input['senha'];

    // Caminho do JSON
    $arquivo = __DIR__ . '/../data/usuarios.json';

    // Verifica se o arquivo existe
    if (!file_exists($arquivo)) {
        echo json_encode(["sucesso" => false, "mensagem" => "Arquivo de usuários não encontrado"]);
        exit;
    }

    // Lê os dados do JSON
    $usuariosJson = file_get_contents($arquivo);
    $usuarios = json_decode($usuariosJson, true);

    if (!is_array($usuarios)) {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao ler os dados"]);
        exit;
    }

    // Busca o usuário e atualiza a senha
    $usuarioEncontrado = false;

    foreach ($usuarios as &$usuario) {
        if (strtolower($usuario['username']) === $username) {
            $usuario['password'] = password_hash($novaSenha, PASSWORD_DEFAULT);
            $usuarioEncontrado = true;
            break;
        }
    }

    if (!$usuarioEncontrado) {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado"]);
        exit;
    }

    // Salva os dados atualizados
    if (file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        echo json_encode(["sucesso" => true, "mensagem" => "Senha atualizada com sucesso"]);
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar os dados"]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(0deg, rgba(71, 191, 158, 1) 0%, rgba(254, 231, 195, 1) 100%);
            min-height: 100vh;
        }

        header {
            background-color: #001D47;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .logo {
            max-width: 80px;
            height: 80px;
        }

        .container-sm {
            margin-top: 50px;
        }

        label {
            color: #1A4C64;
            font-size: 18px;
        }

        h4 {
            color: #1A4C64;
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/logo.png" alt="logo da página" class="logo">
    </header>

    <main>
        <div class="container-sm">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Redefinir Senha</h4>
                </div>
                <div class="card-body">
                    <form onsubmit="event.preventDefault(); redefinirSenha();">
                    <div class="mb-3">
    <label for="user" class="form-label">Usuário:</label>
    <input type="text" name="username" id="user" class="form-control" required placeholder="Digite o usuário">
</div>

                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Nova Senha:</label>
                            <input type="password" id="novaSenha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmaSenha" class="form-label">Confirmar Senha:</label>
                            <input type="password" id="confirmaSenha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Redefinir</button>
                        <a href="login.php" class="btn btn-outline-danger w-100 mt-2">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function redefinirSenha() {
            const username = document.getElementById("user").value;
            const novaSenha = document.getElementById("novaSenha").value;
            const confirmaSenha = document.getElementById("confirmaSenha").value;

            if (novaSenha !== confirmaSenha) {
                alert("As senhas não coincidem.");
                return;
            }

            fetch(window.location.href, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ username: username, senha: novaSenha })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.mensagem);
                if (data.sucesso) {
                    window.location.href = "login.php";
                }
            })
            .catch(() => alert("Erro ao processar solicitação."));
        }
    </script>
</body>
</html>
