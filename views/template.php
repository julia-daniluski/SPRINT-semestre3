<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




require_once __DIR__ . '/../services/Auth.php';
require_once __DIR__ . '/../services/Locadora.php'; // Adicione este require se necessário


use Services\Auth;
use Services\Locadora;


$usuario = Auth::getUsuario();
$locadora = new Locadora(); // ✅ Corrigido: instanciando a classe Locadora

$previsao = null;
$tipoAluguel = '';
$diasAluguel = '';
$mensagem = null; // Inicializado para evitar erro


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['calcular'])) {
        $tipoAluguel = $_POST['tipo_aluguel'];
        $diasAluguel = (int) $_POST['quantidade'];

        $precos = [
            'casa' => 190, // valor por dia
            'quarto' => 80,
            'estudio' => 150
        ];

        $previsao = ($precos[$tipoAluguel] ?? 0) * $diasAluguel;
    }
}


// Processamento dos formulários
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    if (isset($_POST['calcular'])) {
//        $tipoAluguel = $_POST['tipo_aluguel'];
//        $diasAluguel = (int) $_POST['quantidade'];
//
//        $precos = ['casa' => 1900, 'quarto' => 800, 'estudio' => 5000];
//        $previsao = ($precos[$tipoAluguel] ?? 0) * $diasAluguel;
//    }

//    if (isset($_POST['adicionar']) && Auth::isAdmin()) {
//        $localHospedagem = $_POST['Nome'];
//        $valorHospedagem = $_POST['Local'];
//        $tipoHospedagem = $_POST['tipo'];
//        $mensagem = "Hospedagem adicionada com sucesso!";
//    }
//}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Locadora de Veículos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f0f8ff; /* Cor de fundo para as linhas ímpares */
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e6f7ff; /* Cor de fundo para as linhas pares */
        }

        .table th, .table td {
            color: #001D47; /* Cor do texto das células da tabela */
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
        #nome, #local{
            background-color: #e6f7ff; /* Cor de fundo */
            color: #001D47; /* Cor do texto */
            border: 1px solid #001D47; /* Cor da borda */
        }


        .botaoadd{
            background-color: #1d4378;
            color: #78C2E2;
        }

        .botaoadd:hover{
            background-color: #78C2E2;
            color: #001D47;
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
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a href="#home"><img src="../img/logo.png" alt="Logo" class="logo mt-2"></a>
                    <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mt-1">
                            <li class="nav-item"><a class="nav-link" href="../public/paginainicial.php">Início</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Alugar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contatos">Contato</a></li>
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
                    <a href="?logout=1" id="sair" class="btn btn-outline-danger d-flex align-items-center gap-1 mt-1">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <?php if ($mensagem): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($mensagem) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Lista de imóveis -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Aluguéis disponíveis:</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Local</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                            <?php if (Auth::isAdmin()): ?>
                                            <th>Ações</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($locadora->listarImoveis() as $imovel): ?>
                                        <tr>
                                            <td>                                  
                                                <?= $imovel instanceof \Models\Casa ? 'Casa' : 'Estudio' ?>                                    
                                            </td>
                                            <td><?= htmlspecialchars($imovel->getNome()) ?></td>
                                            <td><?= htmlspecialchars($imovel->getLocal()) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $imovel->isDisponivel() ? 'success' : 'warning' ?>">
                                                    <?= $imovel->isDisponivel() ? 'Disponível' : 'Alugado' ?>
                                                </span>
                                            </td>
                                            <?php if (Auth::isAdmin()): ?>
                                                <td>
                                                    <div class="action-wrapper">
                                                        <form method="post" class="btn-group-actions">
                                                            <input type="hidden" name="nome" value="<?= htmlspecialchars($imovel->getNome()) ?>">
                                                            <input type="hidden" name="local" value="<?= htmlspecialchars($imovel->getLocal()) ?>">
                                                            
                                                            <button type="submit" name="deletar" class="btn btn-danger btn-sm delete-btn">Deletar</button>
                                                            
                                                            <div class="rent-group">
                                                                <?php if (!$imovel->isDisponivel()): ?>
                                                        
                                                                <button type="submit" name="devolver" class="btn btn-warning btn-sm">Devolver</button>
                                                                <?php else: ?>
                                                                <input type="number" name="dias" value="1" class="form-control days-input" min="1" required>
                                                                <button type="submit" name="alugar" class="btn btn-primary btn-sm">Alugar</button>
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

        <!-- Formulário de cálculo -->
        <div class="row g-4">
            <div class="col-<?=Auth::isAdmin() ? 'md-6':'12'?>">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>Calcular previsão de aluguel</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="tipo_aluguel" class="form-label">Tipo de local:</label>
                                <select name="tipo_aluguel" id="tipo_aluguel" class="form-select" required>
                                    <option value="casa" <?= (isset($tipoAluguel) && $tipoAluguel === 'casa') ? 'selected' : '' ?>>Casa</option>
                                    <option value="quarto" <?= (isset($tipoAluguel) && $tipoAluguel === 'quarto') ? 'selected' : '' ?>>Quarto</option>
                                    <option value="estudio" <?= (isset($tipoAluguel) && $tipoAluguel === 'estudio') ? 'selected' : '' ?>>Estúdio</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Diárias:</label>
                                <input type="number" id="quantidade" name="quantidade" value="<?= $diasAluguel ?>" class="form-control" min="1" required>
                            </div>
                            <button type="submit" name="calcular" class="btn btn-primary w-100 botaoadd">Calcular</button>
                            <?php if (!is_null($previsao)): ?>
                            <div class="alert alert-success mt-3">
                                Valor total do aluguel: <strong>R$ <?= number_format($previsao, 2, ',', '.') ?></strong>
                            </div>
                        <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

  <?php if (!is_null($previsao)): ?>
    <div class="alert alert-success mt-3">
        Valor total do aluguel: <strong>R$ <?= number_format($previsao, 2, ',', '.') ?></strong>
    </div>
<?php endif; ?>



            <!-- Formulário de administrador para adicionar novo local de hospedagem -->
            <div class="row same-height-row">
                <?php if (Auth::isAdmin()): ?>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4>Adicionar nova hospedagem</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Local da hospedagem</label>
                                    <input type="text" name="nome" id="Nome" class="form-control" required>
                                    <div class="invalid-feedback">Informe um lugar válido</div>
                                </div>
                                <div class="mb-3">
                                    <label for="Local" class="form-label">Valor da hospedagem</label>
                                    <input type="text" name="Local" id="Local" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo da hospedagem</label>
                                    <select name="tipo" id="tipo" class="form-select" required>
                                        <option value="" selected disabled>Selecione...</option>
                                        <option value="casa">Casa</option>
                                        <option value="quarto">Quarto</option>
                                        <option value="estudio">Estúdio</option>
                                    </select>
                                </div>
                                <button type="submit" name="adicionar" class="btn btn-success w-100 botaoadd">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer id="contatos" class="text-center mt-5">
        <p class="text-muted">Nos encontre nas redes sociais:</p>
        <div class="d-flex justify-content-center gap-3 mb-2">
            <a href="#"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#"><i class="bi bi-twitter fs-4"></i></a>
        </div>
        <p class="text-muted">© 2025 Cine&Places. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
