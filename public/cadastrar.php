<?php
// $arquivo = $_SERVER['DOCUMENT_ROOT'] . '/data/usuarios.json';
$arquivo = __DIR__ . '/../data/usuarios.json';

// Verificar se o arquivo realmente existe e é acessível
if (!file_exists($arquivo)) {
    echo "O arquivo não existe!";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $username = strtolower(trim($_POST['username']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Verifica se as senhas coincidem
    if ($password !== $confirmPassword) {
        $mensagem = "As senhas não coincidem.";
    } else {
        // Verifica se o arquivo JSON existe e é válido
        if (file_exists($arquivo)) {
            $usuariosJson = file_get_contents($arquivo);
            $usuarios = json_decode($usuariosJson, true);

            if (!is_array($usuarios)) {
                $usuarios = [];
            }

            // Verifica se o nome de usuário já existe
            foreach ($usuarios as $usuario) {
                if ($usuario['username'] === $username) {
                    $mensagem = "Nome de usuário já cadastrado.";
                    break;
                }
            }

            // Se o usuário não foi encontrado
            if (!isset($mensagem)) {
                // Criptografa a senha
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Adiciona o novo usuário no array
                $usuarios[] = [
                    "username" => $username,
                    "password" => $hashedPassword,
                    "perfil" => "usuario"  // Perfil padrão de usuário
                ];

                // Verifica se o arquivo é gravável
                if (is_writable($arquivo)) {
                    // Tenta salvar os dados no arquivo JSON
                    if (file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                        $mensagem = "Cadastro realizado com sucesso!";
                        $sucesso = true;
                    } else {
                        $mensagem = "Erro ao salvar os dados.";
                    }
                } else {
                    $mensagem = "Arquivo não é gravável.";
                }
            }
        } else {
            // Se o arquivo não existe, cria e salva os dados
            $usuarios = [
                [
                    "username" => $username,
                    "password" => password_hash($password, PASSWORD_DEFAULT),
                    "perfil" => "usuario"
                ]
            ];

            // Verifica se o arquivo é gravável
            if (is_writable($arquivo)) {
                // Tenta salvar os dados no arquivo JSON
                if (file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                    $mensagem = "Cadastro realizado com sucesso!";
                    $sucesso = true;
                } else {
                    $mensagem = "Erro ao salvar os dados.";
                }
            } else {
                $mensagem = "Arquivo não é gravável.";
            }
        }
    }
}
?>


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
    <link rel="stylesheet" href="styles/stylecadastrar.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Define o modelo de caixa para incluir padding e borda no tamanho total do elemento */
        }

        html, body {
            height: 100%;
            margin: 0;
            background: linear-gradient(180deg, rgba(71, 191, 158, 1), rgba(254, 231, 195, 1));
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;

        }
        /* Cabeçalho */
        header {
            background-color: #001D47;
            color: #fff;
            padding: 2px;
        }

        /* Logo */
        header .logo {
            max-width: 80px;
            height: 80px;
        }

        /* Logo container */
        header .empresa {
            display: flex;
            flex-direction: row;
        }

        /* Menu horizontal */
        .navlist {
            display: flex;
            flex-direction: row;
        }

        /* Todos os links dentro do header */
        header a {
            color: #fff !important;
            text-decoration: none;
            font-size: 20px; /* tamanho base para todos os links */
            font-weight: 500;
        }

        /* Cor ao passar o mouse */
        header a:hover {
            color: #ddd !important;
            text-decoration: none;
        }

        /* Itens de lista do menu */
        li {
            list-style-type: none;
        }

        /* Estilo dos links de navegação */
        li a {
            text-decoration: none;
            margin: 10px;
            font-size: 22px; /* sobrescreve o 20px acima para os itens do menu */
            font-weight: 500;
            color: #fff !important;
        }


        /* Div do usuário (lado direito) */
        .usuario {
            display: flex;
            flex-direction: row;
            border-radius: 20px;
            align-items: center;
            padding: 10px;
        }


        .quadrado {
            margin: 4rem 4rem 4rem 5rem; /* topo, direita, baixo, esquerda */
            padding: 1rem;
            border: 2px solid #ffffff;
            border-radius: 8px;
        }


        /* Botão sair */
        #sair {
            background-color: crimson;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        #sair:hover {
            background-color: darkred;
        }


        .segcontainer{
            height: 520px;
        }

        .card {
            margin-bottom: 2rem; /* equivalente ao mb-4 do Bootstrap */
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


        /*Cadastre-se*/
        .entrem{
            text-decoration: none;
            color: gray;
            align-items: center;
            text-align: center;
        }

        /*botões login*/
        .btn-google{
            color:#fff;
            background-color:#dd4b39;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-google:focus,
        .btn-google.focus{
            color:#fff;
            background-color:#c23321;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-google:hover{
            color:#fff;
            background-color:#c23321;
            border-color:rgba(0,0,0,0.2)
        }

        .btn-facebook{
            color:#fff;
            background-color:#3b5998;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook:focus,
        .btn-facebook.focus{
            color:#fff;
            background-color:#2d4373;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook:hover{
            color:#fff;
            background-color:#2d4373;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook:active,
        .btn-facebook.active,
        .open>.dropdown-toggle.btn-facebook{
            color:#fff;
            background-color:#2d4373;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook:active:hover,
        .btn-facebook.active:hover,
        .open>.dropdown-toggle.btn-facebook:hover,
        .btn-facebook:active:focus,
        .btn-facebook.active:focus,
        .open>.dropdown-toggle.btn-facebook:focus,
        .btn-facebook:active.focus,
        .btn-facebook.active.focus,
        .open>.dropdown-toggle.btn-facebook.focus{
            color:#fff;
            background-color:#23345a;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook:active,.btn-facebook.active,
        .open>.dropdown-toggle.btn-facebook{
            background-image:none
        }
        .btn-facebook.disabled:hover,
        .btn-facebook[disabled]:hover,
        fieldset[disabled] .btn-facebook:hover,
        .btn-facebook.disabled:focus,
        .btn-facebook[disabled]:focus,
        fieldset[disabled] .btn-facebook:focus,
        .btn-facebook.disabled.focus,
        .btn-facebook[disabled].focus,
        fieldset[disabled] .btn-facebook.focus{
            background-color:#3b5998;
            border-color:rgba(0,0,0,0.2)
        }
        .btn-facebook .badge{
            color:#3b5998;
            background-color:#fff
        }

        .jeitosentrar {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap; /* para responsividade */
        }

        .jeitosentrar .btn {
            flex: 1;
            min-width: 150px;
            text-align: center;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>    
<!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a href="../inicio.html"><img src="../img/logo.png" alt="Logo" class="logo mt-2"></a>
                    <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                </div>
            </div>
        </nav>
    </header>
    <main>        
        <div class="container mt-3 mb-5 segcontainer">            
            <div class="card mx-auto" style="max-width: 420px;">                
                <div class="card-header">                    
                    <h4 class="log mb-0">Cadastrar-se</h4>                
                </div>                
                <div class="card-body mb-4">                    
                    <form method="POST" class="needs-validation" novalidate>                        
                        <?php if (isset($mensagem)): ?>                            
                            <div class="alert <?= isset($sucesso) && $sucesso ? 'alert-success' : 'alert-danger' ?>" role="alert">                                
                                <?= $mensagem ?>                            
                            </div>                        
                            <?php endif; ?>                            
                            <!-- Nome Completo -->                        
                             <div class="mb-3">                            
                                <label for="nomeCompleto" class="form-label">Nome Completo</label>                            
                                <input type="text" name="username" id="nomeCompleto" class="form-control" required placeholder="Digite seu nome">                        
                            </div>                                                  
                            <!-- Senha -->                        
                             <div class="mb-3 position-relative">                            
                                <label for="senha" class="form-label">Crie uma senha:</label>                            
                                <input type="password" name="password" id="senha" class="form-control" required placeholder="Crie uma senha">                            
                                <span class="password-toggle mt-3" onclick="togglePassword('senha')">                                
                                    <i class="bi bi-eye"></i>                            
                                </span>                        
                            </div>                            
                            <!-- Confirmar Senha -->                        
                             <div class="mb-3 position-relative">                            
                                <label for="confirmarSenha" class="form-label">Confirme sua senha:</label>                            
                                <input type="password" name="confirmPassword" id="confirmarSenha" class="form-control" required placeholder="Digite a senha novamente">                            
                                <span class="password-toggle mt-3" onclick="togglePassword('confirmarSenha')">                                
                                    <i class="bi bi-eye"></i>                            
                                </span>                        
                            </div>                            
                            <!-- Botão de cadastro -->                        
                             <button type="submit" class="btn btn-warning w-100 mb-3">Cadastrar</button>                            
                             <!-- Link para login -->                        
                              <div class="text-center">                            
                                <a href="login.php" class="entrem">Já tem uma conta? Entre.</a>                        
                            </div>                    
                        </form>                
                    </div>            
                </div>        
            </div>    
        </main>
</body>
</html>
<script>    
function togglePassword(id) {        
    const passwordField = document.getElementById(id);        
    const type = passwordField.type === "password" ? "text" : "password";        
    passwordField.type = type;    
    }
    // visto
</script>