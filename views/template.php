<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../services/Auth.php';
require_once __DIR__ . '/../services/Locadora.php'; // Adicione este require se necessário


use Services\Auth;
use Services\Locadora;


$usuario = Auth::getUsuario();

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
            border-radius: 40px !important;
            align-items: center;
            padding: 20px 10px !important;
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

                .modal-header {
            background-color: #f0f8ff;
            border-bottom: 1px solid #444;
            color: #1d4378;
        }

        /* Corpo do modal */
        .modal-body {
            background-color: #ffffff;
            padding: 20px;
            line-height: 1.6;
        }

        /* Rodapé do modal */
        .modal-footer {
            background-color: #f0f8ff;
            border-top: 1px solid #444;
        }

                .fecha{
            display: flex;
            justify-content: center;
            text-decoration: none;
            background-color: #78C2E2;
            color: #001D47;
            padding: 7px 18px;
            border-radius: 40px;
            margin-bottom: 20px;
            transition: all 0.5s ease-in-out;
        }

        .fecha:hover{
            background-color: #FEE7C3;
            color: #001D47;
            transform: scale(1.03);
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

        /* FOOTER */
        footer {
            background: #001D47;
            color: #FEE7C3;
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form button[name="calcular"]').closest('form');
        const tipoAluguel = document.getElementById('tipo_aluguel');
        const quantidade = document.getElementById('quantidade');
        const resultadoDiv = document.getElementById('previsaoResultado');

        const precos = {
            casa: 1900,
            quarto: 800,
            estudio: 5000
        };

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Impede o envio do formulário

            const tipo = tipoAluguel.value;
            const dias = parseInt(quantidade.value, 10);

            if (!tipo || isNaN(dias) || dias <= 0) {
                resultadoDiv.innerText = 'Por favor, preencha corretamente os campos.';
                resultadoDiv.classList.remove('text-primary');
                resultadoDiv.classList.add('text-danger');
                return;
            }

            const valor = precos[tipo] * dias;
            resultadoDiv.innerText = `Valor estimado: R$ ${valor.toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
            resultadoDiv.classList.remove('text-danger');
            resultadoDiv.classList.add('text-primary');
        });
    });
</script>

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
                <ul class="navbar-nav mt-1">
                    <li class="nav-item"><a class="nav-link" href="../public/paginainicial.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Alugar</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalSobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalContato">Contato</a>
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
                    <a href="?logout=1" id="sair" class="btn btn-outline-danger d-flex align-items-center gap-1 mt-1">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="modalSobre" tabindex="-1" aria-labelledby="modalSobreLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSobreLabel">Sobre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p>A Cine&Places é uma empresa brasileira que oferece uma experiência única para apaixonados por cinema e séries. Ela se especializa em alugar imóveis inspirados ou que foram realmente usados em produções cinematográficas e televisivas. Seja para gravar cenas de filmes independentes, séries, ou até mesmo para quem deseja passar dias imersos no ambiente de um set de filmagem, a Cine&Places proporciona um cenário autêntico e memorável.</p>
        <p>A empresa possui uma vasta gama de imóveis, desde casas e apartamentos que serviram como cenário de filmes famosos até espaços que foram inspirados por cenas icônicas. Todos com preços tabelados com os melhores valores para você Isso permite que cineastas, produtores e fãs do universo cinematográfico experimentem, de maneira única, a possibilidade de viver ou criar dentro desses ambientes fantásticos.</p>
</p>Além de ser uma excelente opção para profissionais da área de produção audiovisual, a Cine&Places também atrai turistas e entusiastas que desejam reviver suas cenas favoritas, seja para férias temáticas ou para momentos especiais, como sessões de fotos ou filmagens caseiras. A empresa une a magia do cinema com a possibilidade de vivenciar a realidade dos sets, criando memórias inesquecíveis e experiências imersivas para todos os tipos de públicos.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalContato" tabindex="-1" aria-labelledby="modalContatoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContatoLabel">Contato</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p>Telefone: (11) 4002-8922</p>
        <p>E-mail: contato@cineandplaces.com.br</p>
        <p>Redes Sociais: @cineandplaces (Instagram, Facebook, Twitter)</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


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

<!-- Formulários lado a lado -->
<div class="row g-4">
    <!-- Previsão de aluguel -->
    <div class="col-md-6">
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
                    <div id="previsaoResultado" class="mt-3 fw-bold text-primary"></div>
                    </form>
            </div>
        </div>
    </div>

    

   <!-- adicionar imovel -->
<?php
if (isset($_POST['adicionar'])) {
    $tipo = htmlspecialchars(trim($_POST['tipo'] ?? ''));
    $nome = htmlspecialchars(trim($_POST['nome'] ?? ''));
    $local = htmlspecialchars(trim($_POST['local'] ?? ''));
    $disponivel = isset($_POST['disponivel']) ? true : false;

    if ($tipo && $nome && $local) {
        $novoImovel = [
            "tipo" => $tipo,
            "nome" => $nome,
            "local" => $local,
            "disponivel" => $disponivel
        ];

        $arquivo = 'imoveis.json';

        if (file_exists($arquivo)) {
            $conteudo = file_get_contents($arquivo);
            $dados = json_decode($conteudo, true);
            if (!is_array($dados)) $dados = [];
        } else {
            $dados = [];
        }

        $dados[] = $novoImovel;
        file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
?>

<?php if (Auth::isAdmin()): ?>
<div class="col-md-6">
    <div class="card h-100">
        <div class="card-header">
            <h4>Adicionar nova hospedagem</h4>
        </div>
        <div class="card-body">
            

            <form action="" method="post">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo da hospedagem</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="" selected disabled>Selecione...</option>
                        <option value="Casa">Casa</option>
                        <option value="Quarto">Quarto</option>
                        <option value="Estúdio">Estúdio</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="local" class="form-label">Local</label>
                    <input type="text" name="local" id="local" class="form-control" required>
                </div>

                <button type="submit" name="adicionar" class="btn btn-primary w-100 botaoadd">Adicionar</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>


    </main>

    <!-- Rodapé -->
    <footer id="contatos">
        <p class="secondary-color">Nos encontre nas redes sociais: </p>
        <br>
        <div class="row justify-content-center" id="social-icons-container">
          <div class="col-1">
            <a href="#"><i class="bi bi-facebook secondary-color"></i></a>
          </div>
          <div class="col-1">
            <a href="#"><i class="bi bi-instagram secondary-color"></i></a>
          </div>
          <div class="col-1">
            <a href="#"><i class="bi bi-twitter secondary-color"></i></a>
          </div>
          <br><br><br>
          <p class="secondary-color">© 2025 Cine&Places. Todos os direitos reservados.</p>
          <br>
        </div>
        
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
