<?php

// Incluir o autoload do composer para carregar automaticamente as classes utilizadas
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

session_start();

use Services\Auth;

$mensagem = '';
$auth = new Auth();

// Se já estiver logado, redireciona para a página inicial
if (Auth::verificarLogin()) {
    header('Location: paginainicial.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($auth->login($username, $password)) {
        // Redireciona para a página inicial após login bem-sucedido
        header('Location: paginainicial.php');
        exit;
    } else {
        $mensagem = 'Usuário ou senha inválidos';
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Define o modelo de caixa para incluir padding e borda no tamanho total do elemento */
        }

        html{
            font-family: 'Inter', 'sans-serif';
            font-weight: 500;
        }

        body {
            /* para navegadores antigos */
            background: #FEE7C3;

            /* Gradiente para navegadores modernos */
            background: linear-gradient(0deg, rgba(71, 191, 158, 1)  0%, rgba(254, 231, 195, 1) 100%);
            height: auto;
            margin: 0;
            background-repeat: no-repeat;
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

        /*tela login*/
        .info{
            color: #1A4C64;
            font-size: 28px;
            text-align: center;
            font-weight: bold;
        }

        .slogan{
            color: #1A4C64;
            font-size: 20px;
            text-align: center;  
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

        /*Esqueceu a senha?*/
        .esqueci{
            text-decoration: none;
            color: gray;
        }

        /*Cadastre-se*/
        .cadastre{
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

    <header> 
        <div class="empresa">
            <img src="../img/logo.png" alt="logo da página" class="logo mt-2">
        </div>
    </header>

    <main>
        <div class="container mt-3">
            <div class="row justify-content-center align-items-stretch d-flex">
                
                <!-- Lado esquerdo: vídeo e texto -->
                <div class="col-md-6 mb-4 d-flex">
                    <div class="p-4 bg-light rounded h-100 w-100">
                        <p class="info">Quer um "rolê" diferente? Na Cine&Places você consegue!</p>
                        <div class="ratio ratio-16x9 mb-3">
                            <iframe src="https://www.youtube.com/embed/ZhlqoygmDLI?si=pxSgXNjmSyKq_ZAy"
                                title="YouTube video player" allowfullscreen></iframe>
                        </div>
                        <p class="slogan">Aqui, você aluga seus quartos, casas e mansões saídas diretamente de seus filmes e séries favoritos!</p>
                    </div>
                </div>

                <!-- Lado direito: login -->
                <div class="col-md-4 d-flex segcontainer">
                    <div class="card w-100 h-100">
                        <div class="card-header">
                            <?php if ($mensagem): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($mensagem) ?></div>
                            <?php endif; ?>
                            <form method="post" class="needs-validation" novalidate> 
                            <h4 class="log mb-0">Efetuar login</h4>
                        </div>
                        <div class="card-body w-90 mb-4">
                            <form class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="user" class="form-label">Usuário:</label>
                                    <input type="text" name="username" id="user" class="form-control" required placeholder="Digite o usuário">
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Senha:</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Digite a senha">
                                    <span class="password-toggle mt-3" onclick="togglePassword()">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <a href="redefinirsenha.html" class="esqueci">Esqueceu a senha?</a>
                                </div>
                                
                                <!-- Botão de login principal -->
                                <button  class="btn btn-warning w-100 mb-3">
                                    Entrar
                                </a>
                                </button>

                                <!-- Botões sociais -->
                                <div class="jeitosentrar">
                                    <a class="btn btn-facebook me-2" href="https://pt-br.facebook.com/login/device-based/regular/login/">
                                        <i class="bi bi-facebook me-2"></i> 
                                    </a>
                                    <a class="btn btn-google" href="https://accounts.google.com/v3/signin/identifier?service=mail&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&flowName=GlifWebSignIn&flowEntry=AccountChooser&ec=asw-gmail-globalnav-signin&ddm=1">
                                        <i class="bi bi-google me-2"></i>
                                    </a>
                                </div>
                                <a href="cadastrar.php" class="cadastre">Novo por aqui? Cadastre-se.</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>