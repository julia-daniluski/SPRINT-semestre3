<?php

session_start();

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
header 
{
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

    #tipo



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

/* Estilos para o seletor select */
#tipo {
    background-color: #e6f7ff; /* Cor de fundo */
    color: #001D47; /* Cor do texto */
    border: 1px solid #001D47; /* Cor da borda */
}

/* Estilos para as opções dentro do select */
#tipo option {
    background-color: #78C2E2; /* Cor de fundo das opções */
    color: #001D47; /* Cor do texto das opções */
}

#tipo:focus {
    background-color: #001D47; /* Cor de fundo quando o campo está em foco */
    color: #78C2E2; /* Cor do texto quando o campo está em foco */
    border: 1px solid #001D47; /* Cor da borda quando o campo está em foco */
}

/* Alterando a cor de fundo e borda do campo select */
#tipo-aluguel {
    background-color: #e6f7ff; /* Cor de fundo */
    color: #001D47; /* Cor do texto */
    border: 1px solid #001D47; /* Cor da borda */
}

/* Estilos para as opções dentro do select */
#tipo-aluguel option {
    background-color: #78C2E2; /* Cor de fundo das opções */
    color: #001D47; /* Cor do texto das opções */
}

#tipo-aluguel:focus {
    background-color: #001D47; /* Cor de fundo quando o campo está em foco */
    color: #78C2E2; /* Cor do texto quando o campo está em foco */
    border: 1px solid #001D47; /* Cor da borda quando o campo está em foco */
}

/* Alterando a cor de fundo e borda do input de número */
#quantidade {
    background-color: #e6f7ff; /* Cor de fundo */
    color: #001D47; /* Cor do texto */
    border: 1px solid #001D47; /* Cor da borda */
}

/* Cor do campo de texto e borda */
#modelo, #placa {
    background-color: #e6f7ff; /* Cor de fundo */
    color: #001D47; /* Cor do texto */
    border: 1px solid #001D47; /* Cor da borda */
}



/* Estilos para o rótulo */
.form-label {
    color: #001D47; /* Cor do texto do rótulo */
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
                            <img src="../img/logo.png" alt="Logo da página" class="logo mt-2">
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
                    <span class="welcome-text">Bem-vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong></span>
                    <a href="../public/login.php" id="sair" class="btn btn-outline-danger d-flex align-items-center gap-1 mt-3">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>
            </div>
        </nav>
        <?php if ($mensagem): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensagem) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
    </header>



    <main>
        <!-- Tabela de veículos cadastrados -->
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
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Quarto</td>
                                            <td>Castelo de Alnwick - Hogwarts (Harry Potter), Inglaterra</td>
                                            <td>A partir de US$ 17,589.75</td>
                                            <td><span class="badge bg-success">Disponível</span></td>
                                            <td><div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <!-- Botão deletar (sempre disponivel pro adm)-->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                    <!--Botões condicionais-->
                                                    <div class="rent-group ">

                                                        <!--Veiculo alugado-->
                                                        <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                        <!--Veiculo disponivel-->
                                                        <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                        <button class="btn btn-success" type="submit" name="alugar">Alugar</button>                                            
                                                    </div>
                                                </form>
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <td>Estúdio</td>
                                            <td>Cenário Friends, Califórnia</td>
                                            <td>A partir de US$ 8,596.98</td>
                                            <td><span class="badge bg-warning">Alugado</span></td>
                                            <td><div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <!-- Botão deletar (sempre disponivel pro adm)-->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                    <!--Botões condicionais-->
                                                    <div class="rent-group ">

                                                        <!--Veiculo alugado-->
                                                        <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                        <!--Veiculo disponivel-->
                                                        <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                        <button class="btn btn-success" type="submit" name="alugar">Alugar</button>                                            
                                                    </div>
                                        </tr>
                                        <tr>
                                            <td>Casa</td>
                                            <td>Casa da Mônica, São José dos Campos</td>
                                            <td>A partir de US$ 158,305.00</td>
                                            <td><span class="badge bg-success">Disponível</span></td>
                                            <td><div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <!-- Botão deletar (sempre disponivel pro adm)-->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                    <!--Botões condicionais-->
                                                    <div class="rent-group ">

                                                        <!--Veiculo alugado-->
                                                        <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                        <!--Veiculo disponivel-->
                                                        <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                        <button class="btn btn-success" type="submit" name="alugar">Alugar</button>                                            
                                                    </div>
                                        </tr>
                                        <tr>
                                            <td>Casa</td>
                                            <td>Cabana Tony Stark (Vingadores: Ultimato), Bouckaert Farm</td>
                                            <td>A partir de US$ 351,790.00</td>
                                            <td><span class="badge bg-warning">Alugado</span></td>
                                            <td><div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <!-- Botão deletar (sempre disponivel pro adm)-->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                    <!--Botões condicionais-->
                                                    <div class="rent-group ">

                                                        <!--Veiculo alugado-->
                                                        <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                        <!--Veiculo disponivel-->
                                                        <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                        <button class="btn btn-success" type="submit" name="alugar">Alugar</button>                                            
                                                    </div>
                                        </tr>
                                        <tr>
                                            <td>Quarto</td>
                                            <td>Hotel Shrek, Terras Altas da Escócia</td>
                                            <td>A partir de US$ 228,663.00</td>
                                            <td><span class="badge bg-success">Disponível</span></td>
                                            <td><div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <!-- Botão deletar (sempre disponivel pro adm)-->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">Deletar</button>

                                                    <!--Botões condicionais-->
                                                    <div class="rent-group ">

                                                        <!--Veiculo alugado-->
                                                        <button class="btn btn-warning btn-sm " type="submit" name="devolver">Devolver</button>
                                                        <!--Veiculo disponivel-->
                                                        <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required>
                                                        <button class="btn btn-success" type="submit" name="alugar">Alugar</button>                                            
                                                    </div>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Formulário de cálculo -->
<div class="container mt-4">
    <div class="row justify-content-center align-items-stretch d-flex">

    <?php
// Inicializa a variável para armazenar a previsão
$previsao = null;

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcular'])) {
    // Recebe os dados do formulário
    $tipoAluguel = $_POST['tipo_aluguel'];
    $diasAluguel = $_POST['quantidade']; // Altere para 'quantidade' já que esse é o nome do campo

    // Definir o preço por diária para cada tipo de aluguel
    $precoDiaria = 0;

    switch ($tipoAluguel) {
        case 'casa': // Corrigir para minúsculo
            $precoDiaria = 100; // Preço por diária da casa
            break;
        case 'quarto': // Corrigir para minúsculo
            $precoDiaria = 50; // Preço por diária do quarto
            break;
        case 'estudio': // Corrigir para minúsculo
            $precoDiaria = 75; // Preço por diária do estúdio
            break;
        default:
            $precoDiaria = 0; // Valor padrão (não deve chegar a esse ponto)
    }

    // Cálculo da previsão total
    $previsao = $precoDiaria * $diasAluguel;
}
?>

<?php
// Inicializa as variáveis
$previsao = null;
$tipoAluguel = '';
$diasAluguel = 0;
$valorHospedagem = '';
$localHospedagem = '';
$tipoHospedagem = '';

// Verifica se o formulário de cálculo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcular'])) {
    // Recebe os dados do formulário de cálculo
    $tipoAluguel = $_POST['tipo_aluguel'];
    $diasAluguel = $_POST['quantidade'];

    // Definir o preço por diária para cada tipo de aluguel
    $precoDiaria = 0;

    switch ($tipoAluguel) {
        case 'casa':
            $precoDiaria = 100; // Preço por diária da casa
            break;
        case 'quarto':
            $precoDiaria = 50; // Preço por diária do quarto
            break;
        case 'estudio':
            $precoDiaria = 75; // Preço por diária do estúdio
            break;
        default:
            $precoDiaria = 0;
    }

    // Cálculo da previsão total
    $previsao = $precoDiaria * $diasAluguel;
}

// Verifica se o formulário de adicionar local foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar']) && Auth::isAdmin()) {
    // Recebe os dados do formulário de adicionar local
    $localHospedagem = $_POST['modelo'];
    $valorHospedagem = $_POST['placa'];
    $tipoHospedagem = $_POST['tipo'];

    // Aqui você pode adicionar a lógica para salvar os dados no banco de dados ou outra ação necessária
    // Exemplo de como você poderia salvar no banco (dependendo do seu banco de dados):
    // $query = "INSERT INTO locais_hospedagem (local, valor, tipo) VALUES ('$localHospedagem', '$valorHospedagem', '$tipoHospedagem')";
}

?>

<!-- Formulário de cálculo -->
<div class="container mt-4">
    <div class="row justify-content-center align-items-stretch d-flex">
        <!-- Formulário de previsão de aluguel -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-0">Calcular a previsão de aluguel</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="tipo-aluguel" class="form-label">Tipo de aluguel:</label>
                            <select class="form-select" id="tipo-aluguel" name="tipo_aluguel" required>
                                <option value="casa" <?= $tipoAluguel == 'casa' ? 'selected' : '' ?>>Casa</option>
                                <option value="quarto" <?= $tipoAluguel == 'quarto' ? 'selected' : '' ?>>Quarto</option>
                                <option value="estudio" <?= $tipoAluguel == 'estudio' ? 'selected' : '' ?>>Estúdio</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade de diárias:</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control" value="<?= $diasAluguel ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 add" name="calcular">Calcular</button>
                    </form>

                    <!-- Exibe a previsão do cálculo -->
                    <?php if ($previsao !== null): ?>
                        <div class="mt-4">
                            <h5>Previsão de Aluguel:</h5>
                            <p>Total a pagar: R$ <?= number_format($previsao, 2, ',', '.') ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulário de administrador para adicionar novo local de hospedagem -->
<?php if (Auth::isAdmin()): ?>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h4>Adicionar novo local de hospedagem</h4>
            </div>
            <div class="card-body">
                <form method="post" action="#" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Local:</label>
                        <input type="text" class="form-control" name="modelo" id="modelo" required>
                        <div class="invalid-feedback">Informe um local válido</div>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Valor:</label>
                        <input type="text" class="form-control" name="placa" id="placa" required>
                        <div class="invalid-feedback">Informe um valor válido</div>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo:</label>
                        <select name="tipo" class="form-select" id="tipo">
                            <option value="casa">Casa</option>
                            <option value="quarto">Quarto</option>
                            <option value="estudio">Estúdio</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100 add" type="submit" name="adicionar">Adicionar hospedagem</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>


    </main>

    <footer id="contatos" class="mt-5">
        <p class="secondary-color text-center">Nos encontre nas redes sociais:</p>
        <div class="row justify-content-center" id="social-icons-container">
            <div class="col-1 text-center">
                <a href="#"><i class="bi bi-facebook secondary-color"></i></a>
            </div>
            <div class="col-1 text-center">
                <a href="#"><i class="bi bi-instagram secondary-color"></i></a>
            </div>
            <div class="col-1 text-center">
                <a href="#"><i class="bi bi-twitter secondary-color"></i></a>
            </div>
        </div>
        <p class="secondary-color text-center mt-4">© 2025 Cine&Places. Todos os direitos reservados.</p>
    </footer>

    <!-- Script para mostrar o campo 'Outro' -->
    <script>
        function mostrarCampoOutro(select) {
            const outroContainer = document.getElementById('outro-container');
            const outroInput = document.getElementById('tipo_outro');

            if (select.value === 'outro') {
                outroContainer.style.display = 'block';
                outroInput.required = true;
            } else {
                outroContainer.style.display = 'none';
                outroInput.required = false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
