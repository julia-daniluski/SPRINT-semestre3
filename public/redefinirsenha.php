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
</head>
<body>
    <!-- deixar header -->
    <header> 
        <div class="empresa">
            <img src="img/logo.png" alt="logo da página" class="logo mt-2">
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main>
        <div class="container-sm mt-3 ">
                    <div class="card w-100 h-100">
                        <div class="card-header">
                            <h4 class="log mb-0">Cadastrar-se</h4>
                        </div>
                        <div class="card-body w-90 mb-4">
                            <form class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="user" class="form-label">Email:</label>
                                    <input type="text" name="username" id="user" class="form-control" required placeholder="Digite seu email">
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Crie uma nova senha:</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Crie uma senha">
                                    <span class="password-toggle mt-3" onclick="togglePassword()">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Confirme sua nova senha:</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Digite a senha">
                                    <span class="password-toggle mt-3" onclick="togglePassword()">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                                
                                <!-- Botão redefinir senha -->
                                    <a href="login.php" class="btn btn-warning w-100 mb-3">Redefinir</a>
                                <!-- Botão voltar ao login -->
                                <div class="d-flex justify-content-center">
                                    <a href="login.php" class="btn btn-outline-danger w-30 mb-3">Voltar</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
