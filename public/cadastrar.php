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


        @media{
            /*Diminuir container*/
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
        <div class="container mt-3 mb-5 segcontainer">
            <div class="card mx-auto" style="max-width: 420px;">
                <div class="card-header">
                    <h4 class="log mb-0">Cadastrar-se</h4>
                </div>
                <div class="card-body mb-4">
                    <form action="salvar.php" class="needs-validation" novalidate>
    
                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="nomeCompleto" class="form-label">Nome Completo</label>
                            <input type="text" name="username" id="nomeCompleto" class="form-control" required placeholder="Digite seu nome">
                        </div>
    
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="Digite seu email">
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
    
                        <!-- Botão principal -->
                        <a href="index.html" class="btn btn-warning w-100 mb-3">Cadastrar</a>
    
                        <!-- Botões sociais -->
                        <div class="jeitosentrar d-flex justify-content-center mb-3">
                            <a class="btn btn-facebook me-2" href="https://pt-br.facebook.com/login/device-based/regular/login/">
                                <i class="bi bi-facebook me-2"></i> Facebook
                            </a>
                            <a class="btn btn-google" href="https://accounts.google.com/v3/signin/identifier">
                                <i class="bi bi-google me-2"></i> Google
                            </a>
                        </div>
    
                        <!-- Link para login -->
                        <div class="text-center">
                            <a href="login.php" class="entrem">Já tem uma conta? Entre.</a>
                        </div>
                        <!-- Botão voltar ao login -->
                        <div class="d-flex justify-content-center">
                            <a href="login.php" class="btn btn-outline-danger w-30 mb-3">Voltar</a>
                        </div>
                        
    
                    </form>
                </div>
            </div>
        </div>
    </main>
    

</body>
</html>
