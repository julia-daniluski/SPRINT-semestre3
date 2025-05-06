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
    <link rel="stylesheet" href="styles/stylelogin.css">
</head>
<body>

    <header> 
        <div class="empresa">
            <img src="img/logo.png" alt="logo da página" class="logo mt-2">
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

                        <form action="salvar.php" method="post"> 
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

</body>
</html>