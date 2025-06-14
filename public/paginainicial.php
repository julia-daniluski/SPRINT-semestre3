<?php
session_start();
// php
require_once __DIR__ . '/../services/Auth.php';
use Services\Auth;
$usuario = Auth::getUsuario();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Destroi todas as variáveis de sessão
    $_SESSION = [];
    session_destroy();

    // Redireciona para a página de login
    header("Location: login.php");
    exit;
}
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


        /* Div do usuário (lado direito) - Estilo que deve ser aplicado em ambas as páginas */
        .usuario {
            display: flex;
            flex-direction: row;
            border: 1px solid white;  /* Adiciona borda branca */
            border-radius: 40px;
            align-items: center;
            padding: 0px 10px;       /* Ajuste no padding para ficar igual nas duas páginas */
            gap: 10px;               /* Espaço entre os elementos internos */
            margin-left: auto;       /* Empurra para a direita */
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
            margin-top: 24px;
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
            transition: all 0.8s ease;
        }

        a{
            text-decoration: none;
        }

        h1:hover{
            color: #1d4378 !important;
            font-size: 43px;
        }

        h2 {
            background-color: #001D47;
            color: #FEE7C3;
            border-radius: 30px;
            width: 200px;
            height: 45px;
            font-size: 25px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.5s ease-in-out;
            cursor: pointer;
        }

        h2:hover{
            background-color:#FEE7C3;
            color: #001D47;
            transform: scale(1.03);
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
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .mansao:hover{
            transform: scale(1.03);
        }

        .imagem-container {
            padding: 20px; /* Espaçamento ao redor da imagem */
        }

        .btn {
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

        .btn:hover{
            background-color: #78C2E2;
            color: #001D47;
            transform: scale(1.03);
        }

        /* Fundo geral do modal */
        .modal-content {
            background: linear-gradient(0deg, rgba(71, 191, 158, 1)  0%, rgba(254, 231, 195, 1) 100%);
            color: #001D47; /* cor do texto clara */
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        /* Cabeçalho */
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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f0f8ff; /* Cor de fundo para as linhas ímpares */
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e6f7ff; /* Cor de fundo para as linhas pares */
        }

        .table th, .table td {
            color: #001D47; /* Cor do texto das células da tabela */
        }


        /* FOOTER */
        footer {
            background: #001D47;
            color: #FEE7C3;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }


        /* Garante que o layout se adapte em telas pequenas */
        @media (max-width: 576px) {
            h1 {
                font-size: 28px;
            }

            h2 {
                font-size: 20px;
                width: 160px;
                height: 40px;
            }
            .quadrado {
                padding: 0.6rem; /* ajuste de padding */
                width: 100%; /* ocupa toda a largura */
                margin: 0.1rem; 
            }

            .small-image-container {
                height: 160px;
            }

            .btn, .fecha {
                padding: 6px 14px;
                font-size: 14px;
            }

            .mansao {
                height: auto;
            }
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


            header .logo {
                height: 60px;
                max-width: 60px;
            }

            .imagem-container {
                padding: 10px;
            }

            .modal-body {
                font-size: 14px;
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
                    <a href="../inicio.html"><img src="../img/logo.png" alt="Logo" class="logo mt-2"></a>
                    <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mt-1">
                    <li class="nav-item"><a class="nav-link" href="../public/paginainicial.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Alugar</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalSobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalContato">Contato</a>
                    </li>
                </ul>

                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 usuario">
                    <span class="user-icon">
                        <i class="bi bi-person-circle" style="font-size: 24px;"></i>
                    </span>
                    <span class="welcome-text">
                        Bem-vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong>
                    </span>
                    <a href="?logout=1" id="sair" class="btn btn-outline-danger d-flex align-items-center gap-1 mt-4">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($mensagem):?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($mensagem) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
    <h1 class="mt-4">Cine&Places</h1>
    <!-- Conteúdo Principal -->
    <main>
        <div class="container imagem-container" id="main-image-container">
            <div class="main-image center-image">
                <img src="../img/mansao.png" alt="Casa da Família Adams" class="mansao shadow-lg mt-2">
                <div class="main-image-info">
                    <a href="index.php"><h2 class="mt-4">Aluguel</h2></a>
                </div>
            </div>
        </div>
    <!-- GALLERY -->
    <div class="container" id="gallery-container">
        <div class="col-12">
            <h1>Locações mais procuradas 🔥</h1>
        </div>
        <div class="row gx-md-5 mt-4">
            <!-- IMG 1 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-2"><img src="../img/Casas De Contos De Fadas Na Vida Real - Mundo Gump.jpg" alt="Casa do Harry Potter"></div>
                <h3>Aluga-se castelo harry potter</h3>
                <p class="secondary-color"> R$:800,00 - 1 Dia e 1 Noite</p>
                <!-- Botão para Modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">🏰 Hospedagem temática: Castelo de Harry Potter (Alnwick Castle Experience)</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Viva a magia de Hogwarts com uma estadia inesquecível no castelo onde as primeiras cenas da saga ganharam vida! 🧙‍♂️✨
                                    </p>

                                    
                                    <h4>🏡 Acomodação:</h4>
                                    <p>
                                        Espaço temático completo dentro de uma ala exclusiva do castelo;

                                        2 suítes encantadoras com decoração inspirada nas casas de Hogwarts;

                                        1 cama king + 2 camas de solteiro (colchões extras sob consulta);

                                        Aquecimento central + Wi-Fi em todos os cômodos;

                                        Sala de estar mágica com vitrais, lareira elétrica e livros de feitiço decorativos;

                                        Cozinha estilo medieval equipada com utensílios modernos;

                                        Banheiro com banheira vitoriana e chuveiro quente;
                                    </p>
                                    
                                    <h4> 🧹 Extras e magia</h4>
                                    <p>
                                        Salinha de poções (com decoração e aromas encantadores);

                                        Espaço de leitura com coleção temática e poltronas confortáveis;

                                        Kit de boas-vindas com cartas, cachecóis das casas e doces bruxos;

                                        Pátio externo com vista para o castelo, ideal para fotos e momentos ;mágicos

                                        Decoração totalmente imersiva – das paredes ao chão;
                                    </p>

                                    
                                    <h4>📍 Localização</h4>
                                    <p>
                                        
                                        📌 Alnwick, Northumberland – Inglaterra;

                                        ✔️ A poucos minutos de:


                                        Centro comercial;


                                        Farmácias;


                                        Supermercados;


                                        Cafeterias e pubs locais;


                                        Parques e trilhas ao redor do castelo;
                                    </p>

                                    
                                    <h4>💰 Faixa de preço (varia com temporada e número de hóspedes):</h4>
                                    <p>
                                        A partir de £220 por noite – experiência completa no universo bruxo
                                    </p>
                                    
                                    <h4>📌 Regras do local::</h4>
                                    <p>
                                        Check-in: a partir de 15h;

                                        Check-out: até 11h;

                                        Ambiente livre de fumo;

                                        Pets não são permitidos;

                                        Festas apenas com aviso prévio e dentro dos limites da experiência;
                                    </p>
                                    <h4>👥 Ideal para:</h4>
                                    <p>
                                        Fãs de Harry Potter, casais em busca de uma viagem mágica, famílias, ou grupos de amigos que sonham em viver dentro de um castelo cinematográfico.
                        '               🪄  Reserve agora e sinta-se como se estivesse nos corredores de Hogwarts – sem precisar de um Expresso da Plataforma 9¾!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
                                <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMG 2 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-3"><img src="../img/victoria.jpg" alt="Escola Brilhante Victoria"></div>
                <h3>ALUGA-SE ESCOLA  DE BRILHANTE VICTORIA</h3>
                <p class="secondary-color">R$:5000,00 - 1 Dia e 1 Noite</p>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hospedagem temática: Escola da Brilhante Victória</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Tenha uma experiência única hospedando-se em um espaço inspirado na vibe da Hollywood Arts, bem ao lado da verdadeira Burbank High School, onde a série nasceu!
                                    </p>

                                    
                                    <h4>🏡 Acomodação:</h4>
                                    <p>
                                        Ambiente escolar temático exclusivo só para você e sua turma;

                                        Salas adaptadas como dormitórios confortáveis (estilo república estudantil);
                                        
                                        2 dormitórios criativos com decoração artística e juvenil;
                                        
                                        1 cama queen + 2 camas de solteiro (colchões extras sob consulta);
                                        
                                        Wi-Fi de alta velocidade em todos os espaços;
                                        
                                        Área comum com sofás, quadros artísticos e instrumentos decorativos;
                                        
                                        Copa equipada com micro-ondas, frigobar, cafeteira e utensílios;
                                        
                                        Banheiros em estilo vestiário, com chuveiro quente e secadores de cabelo;
                                    </p>
                                    
                                    <h4>🎸 Extras e diversão</h4>
                                    <p>
                                        Estúdio improvisado com microfone, luzes e fundo para vídeos ou karaokê;
                                        Cantinho de artes com materiais para desenho, pintura e customização;
                                        Decoração que remete aos corredores da série;
                                        
                                        Kit de boas-vindas com brindes inspirados em Brilhante Victória;
                                        
                                        Área externa com mural para fotos, luzes e puffs.
                                    </p>

                                    
                                    <h4>📍 Localização</h4>
                                    <p>
                                        📌 Burbank, Califórnia – ao lado da verdadeira Burbank High School

                                        ✔️ A poucos minutos de restaurantes, cafés, mercados e farmácias

                                        ✔️ Próximo a postos de gasolina, academias e centros comerciais

                                        ✔️ Fácil acesso ao centro de Burbank e atrações locais

                                        ✔️ Bairro seguro e movimentado, com clima californiano autêntico
                                    </p>

                                    
                                    <h4>💰 Faixa de preço (varia com temporada e número de hóspedes):</h4>
                                    <p>
                                        A partir de US$185 por noite – experiência completa no estilo "escola de artes";
                                    </p>
                                    
                                    <h4>📌 Regras do local::</h4>
                                    <p>
                                        Check-in: a partir de 15h

                                        Check-out: até 11h;

                                        Ambiente 100% livre de fumo;

                                        Animais de pequeno porte são permitidos;

                                        Eventos pequenos são permitidos com aviso prévio;
                                    </p>
                                    <h4>👥 Ideal para:</h4>
                                    <p>
                                        Fãs de Brilhante Victória, grupos criativos, estudantes de artes, criadores de conteúdo, ou qualquer um que queira viver um pouco da energia da série em um espaço jovem, divertido e cheio de personalidade.
                                        🎤 Reserve agora e sinta-se dentro da escola onde sonhos artísticos ganham vida!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
                                <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMG 3 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-4"><img src="../img/ainda estou aqui.webp" alt="Casa do Ainda estou aqui"></div>
                <h3>ALUGA-SE CASA DE AINDA ESTOU AQUI</h3>
                <p class="secondary-color">R$:1900,00 - 1 Dia e 1 Noite</p>
                <!-- Botão para Modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Casa "Ainda Estou Aqui"</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>
                                        🏡 Acomodação:
                                    </h4>
                                    <p>
                                            Casa completa só para você (e sua companhia)!
                                            2 quartos aconchegantes com decoração inspirada no filme;
                                            1 cama de casal + 2 camas de solteiro (colchões extras sob consulta);
                                            Ventiladores em todos os cômodos;
                                            Wi-Fi com boa cobertura pela casa;
                                            Sala de estar com detalhes do cenário original do longa;
                                            Cozinha equipada com fogão, geladeira, micro-ondas e utensílios;
                                            Banheiro com chuveiro quente e itens básicos de higiene.
                                    </p>

                                    
                                    <h4>🎬 Extras e atmosfera</h4>
                                    <p>
                                            Ambiente acolhedor, com decoração que remete às cenas mais marcantes do filme;
                                            Cantinho para leitura e relaxamento, com livros e objetos de cena;
                                            Kit de boas-vindas com itens personalizados do filme;
                                            Varanda com vista para o porto – perfeito para um café no fim da tarde;
                                            Pequeno jardim externo com espaço para descanso.
                                    </p>
                                    
                                    <h4>📍 Localização</h4>
                                    <p>
            
                                        Bairro residencial tranquilo no Rio de Janeiro;
                                            A poucos passos de:
            
                                            ✔️ Porto
                                            ✔️ Farmácia
                                            ✔️ Restaurantes variados
                                            ✔️ Escola e ponto de ônibus
                                            ✔️ Fácil acesso ao centro e à orla
                                    </p>

                                    
                                    <h4>💰 Faixa de preço (pode variar conforme temporada e número de hóspedes):</h4>
                                    <p>
                                        A partir de US$:879,476 por noite – casa completa para até 4 pessoas!
                                    </p>

                                    
                                    <h4>📌 Regras da casa:</h4>
                                    <p>
                                            Check-in: a partir de 14h
                                            Check-out: até 11h
                                            Não é permitido fumar dentro da casa
                                            Animais de estimação: não são permitidos
                                            Festas não são permitidas – ambiente pensado para tranquilidade e descanso
                                    </p>
                                    
                                    <h4>👥 Ideal para:</h4>
                                    <p>
                                            Casais, amigos ou fãs de cinema que buscam um lugar calmo e com charme
                                            Perfeito para quem quer viver uma experiência diferente e memorável no Rio
                                            ✨ Reserve agora e viva momentos emocionantes na mesma casa onde a história ganhou vida. Uma hospedagem cheia de significado, conforto e conexão com o cinema brasileiro!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
                                <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMG 4 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-5"><img src="../img/Casa-da-Monica.jpg" alt="Casa da turma da Mônica"></div>
                <h3>ALUGA-SE CASA DA MÔNICA</h3>
                <p class="secondary-color">R$:1900,00 - 1 Dia e 1 Noite</p>
                <!-- Botão para Modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">🏰 Casa da Mônica – Hospedagem Temática em São José dos Campos
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Uma casa divertida e cheia de personalidade para crianças de todas as idades!
                                        🧡 Já imaginou se hospedar em uma casa totalmente inspirada na Turma da Mônica? Na Casa da Mônica, cada cantinho tem um detalhe especial que traz o universo dos gibis para a vida real! Um espaço acolhedor, completo e perfeito para momentos em família, amigos ou simplesmente viver um fim de semana inesquecível com nostalgia e alegria.
                                    </p>

                                    
                                    <h4>🏡 Acomodação:</h4>
                                    <p>
                                        Casa inteira para você e sua turma;
                                        2 quartos temáticos (1 da Mônica, 1 do Cebolinha);
                                        Cama de casal + 2 camas de solteiro (colchões extras sob consulta);
                                        Ar-condicionado e ventiladores;
                                        Wi-Fi em todos os cômodos;
                                        Sala de estar com decoração inspirada no bairro do Limoeiro;
                                        Cozinha completa com utensílios, geladeira, micro-ondas, fogão;
                                        Banheiro com chuveiro quente.
                                    </p>
                                    
                                    <h4> 🎉 Extras e diversão</h4>
                                    <p>
                                        Espaço kids com brinquedos, livros e gibis da Turma da Mônica;
                                        Decoração temática do piso ao teto (incluindo quadros, roupa de cama e objetos divertidos);
                                        Kit de boas-vindas com doces, gibis e lembrancinhas;
                                        Cantinho da Magali (com frutas de verdade!);
                                        Mini jardim com área para brincar ou relaxar.
                                    </p>

                                    
                                    <h4>📍 Localização</h4>
                                    <p>
                                        
                                        Bairro residencial calmo e seguro em São José dos Campos;
                                        Próximo a padarias, farmácias e supermercados;
                                        Fácil acesso à Via Dutra e pontos turísticos da cidade.
                                    </p>

                                    
                                    <h4>💰 Faixa de preço (varia com temporada e número de hóspedes):</h4>
                                    <p>
                                        A partir de US$:158,305 por noite – casa completa.
                                    </p>
                                    
                                    <h4>📌 Regras do local::</h4>
                                    <p>
                                        Check-in: a partir de 14h;
                                        Check-out: até 11h;
                                        Não fumar dentro da casa;
                                        Permitido animais de pequeno porte;
                                        Festinhas pequenas são bem-vindas (mas sem planos infalíveis do Cebolinha, por favor 😄).
                                    </p>
                                    <h4>👥 Ideal para:</h4>
                                    <p>
                                        deal para famílias, casais ou qualquer fã de uma boa aventura temática! Reserve agora e viva sua própria história no universo da Turma da Mônica, onde diversão e conforto andam lado a lado (sem a confusão do Cebolinha, prometemos)!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
                                    <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>

            <!-- IMG 5 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-6"><img src="../img/Shrek-1.jpg" alt="Casa do Shrek"></div>
                <h3>ALUGA-SE HOTEL DO BURRO FILME SHREK</h3>
                <p class="secondary-color"> R$:800,00 - 1 Dia e 1 Noite</p>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop5">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">🏡 Hotel do Shrek nas Terras Altas da Escócia</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Hospedagem temática, conforto garantido e uma pitada de conto de fadas.

                                        Desfrute de uma estadia inesquecível no Hotel do Shrek, situado entre as montanhas das deslumbrantes Terras Altas da Escócia. Uma acomodação única que mistura natureza, conforto e um toque de magia inspirado no universo do ogro mais famoso do cinema. 🌿
                                    </p>

                                    
                                    <h4>🏡 Acomodação:</h4>
                                    <p>
                                        
                                        Cama confortável em ambiente aconchegante;
                                        Frigobar;
                                        Wi-Fi gratuito;
                                        Ar-condicionado individual;
                                        Banheiro privativo com chuveiro.
                                    </p>
                                    
                                    <h4> 🍽️ Comodidades:</h4>
                                    <p>
                                        Todas as refeições inclusas no pacote;
                                        Alimentação temática opcional (inspirada no universo do filme);
                                        Limpeza diária.
                                    </p>

                                    
                                    <h4>🎥  Detalhe especial:</h4>
                                    <p>
                                        Além do banheiro privativo, há um banheiro externo a 20 metros do hotel, como no filme — ideal para quem quer uma experiência ainda mais imersiva.
                                    </p>

                                    
                                    <h4> 📍 Localização:</h4>
                                    <p>
                                        Situado em meio à natureza, com vistas incríveis das montanhas escocesas. Perfeito para relaxar, explorar trilhas e se desconectar do caos da cidade.
                                    </p>
                                    
                                    <h4>💰Faixa de preço (ajustável):</h4>
                                    <p>
                                        A partir de US$:228,663 por noite (inclui todas as refeições)
                                    </p>
                                     <h4>📜 Regras da casa</h4>
                                    <p>
                                        Check-in: a partir de 14h;
                                        Check-out: até 11h;
                                        Não é permitido fumar no interior dos quartos;
                                        Animais de estimação são bem-vindos (desde que não falem demais, como o Burro 🐴).
                                    </p>
                                    <p>Ideal para casais, famílias ou fãs de experiências temáticas. Reserve agora e viva como se estivesse em um verdadeiro conto de fadas (com um leve toque de lama).</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary fecha" data-bs-dismiss="modal">Fechar</button>
                                    <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMG 6 -->
            <div class="col-xs-12 col-md-4 quadrado">
                <div class="small-image-container center-image" id="img-6"><img src="../img/cabana_tonystark2.webp" alt="Cabana do Tony Stark"></div>
                <h3>ALUGA-SE CABANA TONY STARK VINGADORES</h3>
                <p class="secondary-color">R$:1900,00 - 1 Dia e 1 Noite</p>
                <!-- Botão para Modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop6">
                    Mais informações
                </button>
                  <!-- Modal -->
                <div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">🏡 Hospedagem temática: Cabana do Tony Stark – Vingadores: Ultimato</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Desfrute de uma experiência única na icônica cabana de Tony Stark, situada à beira de um lago tranquilo, em Fairburn, na Geórgia. Perfeita para quem quer viver a paz e o estilo de vida do Homem de Ferro. 🌿
                                    </p>

                                    
                                    <h4>🏡 Acomodação:</h4>
                                    <p>
                                        
                                        Cabana completa, com 3 quartos e capacidade para até 6 pessoas;


                                        1 cama king-size e 2 camas de casal 🛏️;


                                        Sala de estar aconchegante com lareira e vista para o lago 🔥;


                                        Cozinha equipada com utensílios, forno, geladeira e cafeteira 🍳;


                                        Estacionamento gratuito 🚗;


                                        Wi-Fi disponível em toda a propriedade 📶.
                                    </p>
                                    
                                    <h4> 🎥Extras e Ambiente:</h4>
                                    <p>
                                        Localizada à beira de um lago calmo, ideal para relaxar e desconectar 🏞️


                                        Parte de uma propriedade equestre de 8.000 acres, com opções para passeios e trilhas 🐎


                                        Área externa com deck de madeira, perfeito para momentos tranquilos ao ar livre 🌅


                                        Decoração inspirada no estilo simples e acolhedor de Tony Stark.
                                    </p>

                                    
                                    <h4>📍 Localização</h4>
                                    <p>
                                        
                                        Em Fairburn, Geórgia, a apenas 30 minutos do Aeroporto Internacional de Atlanta ✈️


                                        Próxima a comércios locais, supermercados e restaurantes 🍽️


                                        Fácil acesso às principais rodovias e a um ambiente tranquilo e rural 🌳
                                    </p>

                                    
                                    <h4>💰 Faixa de preço (varia com temporada e número de hóspedes):</h4>
                                    <p>
                                        A partir de US$285 por noite – cabana completa com toda a experiência Stark.
                                    </p>
                                    
                                    <h4>📌 Regras do local::</h4>
                                    <p>
                                        Check-in: a partir das 15h ⏰


                                        Check-out: até 11h;
                                        
                                        
                                        Não é permitido fumar dentro da cabana 🚭
                                        
                                        
                                        Animais de pequeno porte são bem-vindos 🐾
                                        
                                        
                                        Festas pequenas com aviso prévio 🎉
                                    </p>
                                    <h4>👥 Ideal para:</h4>
                                    <p>
                                        Fãs de Vingadores, casais, famílias ou grupos de amigos que buscam uma estadia cinematográfica e tranquila, com um toque de luxo e a tranquilidade de Tony Stark.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn fecha btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <a href="index.php"><button type="button" class="btn btn-primary">Alugar</button></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    

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


    <!-- Incluindo as dependências do Bootstrap no final do body --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Visto -->