<?php
require_once __DIR__ . '/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine&Places</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Link ao CSS Externo -->
    <link rel="stylesheet" href="styles/styleadm.css">
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
/* header{
    background-color: #001D47;
    color: #fff;
    padding: 2px;
    display: flex;
    justify-content: space-between;
    align-items: center;
} */



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
    color: #78C2E2 !important;
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



h3{
    text-transform: uppercase;
}

h1{
    text-align: center;
}
/* PADRONIZAÇÃO DAS IMAGENS DA GALERIA */
.small-image-container {
    width: 100%;
    height: 220px; /* Altura padrão da imagem */
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 10px;
}
  
.small-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Mantém proporção, cobre totalmente o container */
    border-radius: 12px;
    transition: transform 0.3s ease;
}
  
.small-image-container:hover img {
    transform: scale(1.03); /* Zoom leve ao passar o mouse */
}

.mansao {
    border-radius: 10px; /* Arredondamento dos cantos */
    object-fit: cover;   /* Preenche sem distorcer */
    width: 100%;         /* Ocupa toda a largura */
    height: auto;        /* Altura automática */
    display: block;
}

.imagem-container {
    padding: 20px; /* Espaçamento ao redor da imagem */
}

/* Ajuste na navbar para garantir melhor responsividade */
.navbar-toggler {
    border-color: #fff;
}

/* Contêiner para a tabela de veículos */
.card-body {
    padding: 20px;
}

/* Ajustando os badges */
.badge {
    font-size: 14px;
}

/* Aumentando o tamanho dos botões */
.btn {
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 25px;
}

/* Estilos para os cards de cálculo de aluguel */
.card {
    border-radius: 15px;
}

.card-header {
    background-color: #001D47;
    color: #fff;
}

.card-body {
    background-color: #fff;
    padding: 20px;
}

.action-wrapper{
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: flex-start;
}

.btn-group-actions{
    display:flex;
    gap: 0.5rem;
    align-items: center;
}

.rent-group{
    display: flex;
    align-items: center;
    gap: 0.5rem;
    order: 2;
}
.delete-btn{
    order: 1;
}

.days-input{
    width: 60px !important;
    padding: 0.25rem 0.5rem;
    text-align: center;
}

.add {
    display: flex;
    justify-content: center;
    text-decoration: none;
    background-color: #001D47;
    color: #78C2E2;
    padding: 7px 18px;
    border-radius: 40px;
    margin-bottom: 20px;
    transition: all 0.5s ease-in-out;
}

.add:hover{
    background-color: #78C2E2;
    color: #001D47;
    transform: scale(1.03);
}

footer {
    background: #001D47;
    color: #ffffff;
    text-align: center;
    padding: 20px;
    margin-top: 20px;
}


/* Responsividade */
@media (max-width: 768px) {
    .navbar-toggler {
        margin-top: 5px;
        background-color: #1d4378;
    }
    .usuario {
        flex-direction: column;
        gap: 10px;
    }
    .action-wrapper{
        flex-direction: column;
        align-items: stretch;
    }

    .btn-group-actions{
        flex-direction: column;
    }

    .rent-group{
        order: 1;
        width: 100%;
    }
    .delete-btn{
        order: 2;
        width: 100%;
    }
    .days-input{
        width: 100% !important;
    }
}

/* Responsividade para o Header */
@media (max-width: 991.98px) {
    header .container {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    /* Ajusta logo e botão mobile */
    header .empresa {
        width: 100%;
        justify-content: space-between;
        align-items: center;
    }

    /* Centraliza menu ao abrir */
    .navbar-collapse {
        width: 100%;
    }

    .navlist {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .navlist .nav-item {
        width: 100%;
    }

    .navlist .nav-link {
        padding: 0.5rem 1rem;
        width: 100%;
    }

    /* Ajusta layout do usuário para mobile */
    .usuario {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        gap: 0.5rem;
    }

    .usuario .welcome-text {
        font-size: 16px;
    }

    #sair {
        margin-top: 0;
        padding: 5px 10px;
        font-size: 14px;
    }
    .navbar-toggler {
        background-color: #1d4378;
        border: 1px solid white; /* ou outra cor */
        padding: 6px 10px;
        border-radius: 5px;
    }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%2300BFFF' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    
}
    </style>
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex align-items-center justify-content-between w-100">

                <!-- Esquerda: Logo + Menu -->
                <div class="d-flex align-items-center gap-4">

                    <!-- Logo -->
                    <div class="empresa">
                        <a href="#home">
                            <img src="img/logo.png" alt="Logo da página" class="logo mt-2">
                        </a>
                    </div>

                    <!-- Botão Mobile -->
                    <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Menu -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav navlist mt-1">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.html">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Anunciar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sobre">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contatos">Contato</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Direita: Usuário -->
                <div class="d-flex align-items-center gap-3 user-info border p-2 rounded-5 usuario">
                    <span class="user-icon">
                        <i class="bi bi-person-circle" style="font-size: 24px;"></i>
                    </span>
                    <span class="welcome-text">
                        Bem-vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong>
                    </span>
                    <!-- botao de logout -->
                    <a href="login.php" id="sair" class="btn btn-outline-danger d-flex align-items-center gap-1 mt-3">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>
            </div>
        </nav>
    </header>

        <?php if ($mensagem):?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($mensagem) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <main>
        <!-- Tabela de locais cadastrados -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Aluguéis disponíveis:</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Lugar</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                            <?php if (Auth::isAdmin()): ?>
                                            <th>Ações</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($locadora->listarImoveis() as $Imovel): ?>
                                        <tr>
                                            <!-- fudeu aqui pra baixo -->
                                             <!-- essa linha pode estar dando errado por contra que tem 3 itens / favor avaliar oque esta errado e concertar  -->
                                        <td><?= $imovel instanceof \Models\Casa ? 'Casa' : 'Quarto' : 'Estudio' ?></td>
                                        <td><?= htmlspecialchars($imovel->getNome()) ?></td>
                                        <td><?= htmlspecialchars($imovel->getLocal()) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $imovel->isDisponivel() ? 'sucess' : 'warning' ?>"><?= $imovel->isDisponivel() ? 'Disponível' : ' Alugado' ?></span>
                                        </td>
                                        <?php if (Auth::isAdmin()): ?>
                                        <td><div class="action-wrapper">
                                            <form method="post" class="btn-group-actions">
                                                <input type="hidden" name="nome" value="<?=htmlspecialchars($imovel->getNome()) ?>">
                                                <input type="hidden" name="local" value="<?=htmlspecialchars($imovel->getLocal()) ?>">
                                                <!-- Botão deletar (sempre disponivel pro adm)-->
                                                <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                <!--Botões condicionais-->
                                                <div class="rent-group ">
                                                    <?php if (!$imovel->isDisponivel()): ?>

                                                    <!--Veiculo alugado-->
                                                    <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                    <?php else: ?>
                                                    <!--Veiculo disponivel-->
                                                    <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                    <button class="btn btn-success" type="submit" name="alugar">Alugar</button>  
                                                    <?php endif; ?>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            <tr>

</body>
</html>
<!--  codigo site que funciona -->
</head>
<body class="container py-4">
    <div class="container py-4">
        <!-- Barra de informações de usuario -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between alien-items-center inicio">
                    <h1>Lista de Locadora de veículos</h1>
                    <div class="d-flex align-items-center gap-3 user-info mx-3">
                        <span class="user-icon">
                            <i class="bi bi-person" style="font-size: 24px;"></i>
                        </span>
                        <!-- Bem vindo,(usuario) -->
                        <span class="welcome-text">
                            Bem-vindo, <strong><?=htmlspecialchars($administrador['username'])?></strong>
                        </span>
                        <!-- botão de logout -->
                        <a href="?logout=1" class="btn btn-outline-danger d-flex align-items-center gap-1"><i class="bi bi-box-arrow-in-right"></i>Sair</a>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php if ($mensagem):?>
        <div class="alert alert-info alert-dismissble fade show" role="alert">
            <?=htmlspecialchars($mensagem) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            <!-- pra fechar os phps -->
        <?php endif; ?>

        <!-- Formulario para adicionar novo veiculo -->
        <div class="row same-height-row">
        <?php if (Auth::isAdmin()): ?>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="mb-0">Adicionar novo veículo</h4>
                    </div>
                    <div class="card-body">
                        <form action="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo:</label>
                                <input type="text" class="form-control" name="modelo" required>
                                <div class="invalid-feedback">
                                    Informe um modelo válido"
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="placa" class="form-label">Placa:</label>
                                <input type="text" class="form-control" name="placa" required>
                                <div class="invalid-feedback">
                                    Informe uma placa válida
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo:</label>
                                <select name="tipo" class="form-select" id="tipo" required>
                                    <option value="">Carro</option>
                                    <option value="">Moto</option>
                                    <option value="">Helicoptero</option>
                                </select>
                            </div>
                            <button class="btn btn-success w-100" type="submit" name="adicionar">Adicionar veículo</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- formulario para calculo de aluguel -->
            <div class="col-<?= Auth::isAdmin() ? 'md-6':'12' ?>">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Calcular a previsão de aluguel
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="" class="input-label">Tipo de veículo:</label>
                                <select class="form-select" name="" id="" required>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade de dias</label>
                                <input type="number" name="quantidade" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100" name="calcular">Calcular</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- tabela de veiculos cadastrados -->
        <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <!-- mb- margin botton -->
                        Veículos Cadastrados 🚗
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Placa</th>
                                <th>Status</th>
                                <!-- açoes so vai aparecer para o adm -->
                                 <?php if (Auth::isAdmin()): ?>
                                <th>Ações</th>
                                <?php endif; ?>
                            </thead>
                            <tbody>
                                <!-- exibir todo o backend -->
                                 <?php foreach ($locadora->listarVeiculos() as $veiculo): ?>
                                <tr>
                                    <!-- tr = table row -->
                                     <!-- td= dados da tabela/ php pq quer que ele mostra oq tem na tabela / ele pega la de veiculos ai ele vai comparar com o carro e se nao retornar como carro vai ser Moto -->
                                    <td><?= $veiculo instanceof \Models\Carro ? 'Carro' : 'Moto' ?> </td>
                                    <td><?= htmlspecialchars($veiculo->getModelo()) ?></td>
                                    <td><?= htmlspecialchars($veiculo->getPlaca()) ?> </td>
                                    <td><span class="badge bg-<?=$veiculo->isDisponivel() ? 'sucess' : 'warning' ?>">
                                        <?= $veiculo->isDisponivel() ? 'Disponivel' : 'Alugado' ?>
                                    </span>
                                    </td>
                                    <?php if (Auth::isAdmin()): ?>
                                    <td>
                                        <div class="action-wrapper">
                                            <form action="post" class="btn-group-actions">
                                                <input type="hidden" name="modelo" value="<?= htmlspecialchars($veiculo->getModelo()) ?>">

                                                <input type="hidden" name="placa" value="<?= htmlspecialchars($veiculo->getPlaca()) ?>">
                                                <!-- botao deletar (sempre fica disponivel para o 'adm/Admin') -->
                                                 <!-- delete-btn nao e do bootstrap vou fazer a classe -->
                                                 <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                 <!-- botoes condicionais -->
                                                  <div class="rent-group">
                                                    <?php if (!$veiculo->isDisponivel()): ?>
                                                    <!-- Veiculos alugado/devolver -->
                                                     <button class="btn btn-warning btn-sm" type="submit" name="devolver">Devolver</button>
                                                        <?php else: ?>
                                                     <!-- veiculo disponivel -->
                                                      <!-- name e oq voce ta selecionando se fosse meses ia colocar meses /  required = obrigatorio -->
                                                      <input type="number" name="dias" class="form-control days-input" value="1" min="1" required>
                                                      <button class="btn btn-primary" name="alugar" type="submit">Alugar</button>
                                                      <?php endif; ?>
                                                  </div>
                                            </form>  
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                 <?php endforeach; ?>                                                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>