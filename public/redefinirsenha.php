<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Locadora de veículos</title>
    <!-- Link do bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link dos ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link para CSS -->
    <link rel="stylesheet" href="styles/styleredefinir.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box; /* Define o modelo de caixa para incluir padding e borda no tamanho total do elemento */
}

:root {
  --primary-color: #001D47; /* azul */
}

html{
    font-family: 'Inter', 'sans-serif';
    height: 100%;
    }
    
body {
    /* para navegadores antigos */
    background: #FEE7C3;

    /* Gradiente para navegadores modernos */
    background: linear-gradient(0deg, rgba(71, 191, 158, 1)  0%, rgba(254, 231, 195, 1) 100%);
    min-height: 100vh;
    margin: 0;
    background-repeat: no-repeat;
    background-size: cover; /* garante que preencha a tela */
}
    



/*  Cabeçalho */
header{
    background-color: #001D47;
    color: #fff;
    padding: 2px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}


header .logo {
    max-width: 80px;
    height: 80px;
}


header .empresa{
    display: flex;
    flex-direction: row;
}

.navlist{
    display: flex;
    flex-direction: row;
}

li{
    list-style-type: none;
}

li a{
    text-decoration: none;
    margin: 10px;
    color: #fff;
    font-size: 22px;
}

.usuario{
    display: flex;
    flex-direction: row;
}

.segcontainer{
    height: 520px;
}

.login {
        display: flex;
        flex-direction: row;
        justify-content: center; /* Centraliza tudo horizontalmente */
        align-items: flex-start; /* Alinha ao topo */
        gap: 40px; /* Espaço entre os containers */
        padding: 50px;
}
    
.login-container {
        width: 400px;
        margin: 100px auto;
        /* background: #fdf3ffb1;
        text-align: center;
        padding: 20px;
        box-sizing: border-box; */
}
    

.password-toggle{
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

/*tela redefinir*/
.log{
    color: #1A4C64;
    font-size: 25px;
    text-align: center; 
    font-weight: bold;
}

label{
    color: #1A4C64;
    font-size: 23px;
    text-align: center; 
}


@media{
    /*Diminuir container*/
}
        </style>

<body>
    <!-- deixar header -->
    <header> 
        <div class="empresa">
            <img src="img/logo.png" alt="logo da página" class="logo mt-2">
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main>
        <div class="container-sm mt-3">
            <div class="card w-100 h-100">
                <div class="card-header">
                    <h4 class="text-center">Redefinir Senha</h4>
                </div>
                <div class="card-body">
                    <form onsubmit="event.preventDefault(); redefinirSenha();">
                        <div class="mb-3">
                            <label for="user" class="form-label">Email:</label>
                            <input type="email" id="user" class="form-control" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="novaSenha" class="form-label">Nova Senha:</label>
                            <input type="password" id="novaSenha" class="form-control" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="confirmaSenha" class="form-label">Confirmar Senha:</label>
                            <input type="password" id="confirmaSenha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Redefinir</button>
                        <a href="login.php" class="btn btn-outline-danger w-100 mt-2">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
        <?php
header("Content-Type: application/json");

// Verifica método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["sucesso" => false, "mensagem" => "Método não permitido"]);
    exit;
}

// Lê o corpo JSON da requisição
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email']) || !isset($input['senha'])) {
    echo json_encode(["sucesso" => false, "mensagem" => "Dados incompletos"]);
    exit;
}

$email = strtolower(trim($input['email']));
$novaSenha = $input['senha'];

// Caminho do JSON
$arquivo = 'usuarios.json';

// Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Arquivo de usuários não encontrado"]);
    exit;
}

// Lê o JSON
$usuariosJson = file_get_contents($arquivo);
$usuarios = json_decode($usuariosJson, true);

if (!is_array($usuarios)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao ler os dados"]);
    exit;
}

// Atualiza senha se encontrar o usuário
$usuarioEncontrado = false;

foreach ($usuarios as &$usuario) {
    if (strtolower($usuario['email']) === $email) {
        $usuario['senha'] = password_hash($novaSenha, PASSWORD_DEFAULT);
        $usuarioEncontrado = true;
        break;
    }
}

if (!$usuarioEncontrado) {
    echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado"]);
    exit;
}

// Salva JSON atualizado
if (file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode(["sucesso" => true, "mensagem" => "Senha atualizada com sucesso"]);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar os dados"]);
}
?>

    </main>

    <script>
        function redefinirSenha() {
            const email = document.getElementById("user").value;
            const novaSenha = document.getElementById("novaSenha").value;
            const confirmaSenha = document.getElementById("confirmaSenha").value;

            if (novaSenha !== confirmaSenha) {
                alert("As senhas não coincidem.");
                return;
            }

            fetch("redefinir-senha.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email: email, senha: novaSenha })
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
