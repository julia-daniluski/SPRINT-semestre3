<?php

// Incluir o autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o arquivo com as variáveis
require_once __DIR__ . '/../config/config.php';

session_start();

// Importar as classes Locadora e Auth
use Services\{Locadora, Auth};

// Importar as classes Carro e moto
use Models\{Casa, Quarto, Estudio};

// Verificar se o usuário está logado
if(!Auth::verificarLogin()){
    header('Location: login.php');
    exit;
}

// Condição para logout
if (isset($_GET['logout'])){
    (new Auth())->logout();
    header('Location: login.php');
    exit;
}

// Criar uma instância da classe locadora
$locadora = new Locadora();

$mensagem = '';

$usuario = Auth::getUsuario();

// Verificar os dados do formulário via POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Verificar se requer permissão de administrador
    if(isset($_POST['adicionar']) || isset($_POST['deletar']) || isset($_POST['alugar']) ||isset($_POST['devolver'])){

        if(!Auth::isAdmin()){
            $mensagem = "Você não tem permissão para realizar essa ação.";
            goto renderizar;
        }
    }

    if(isset($_POST['adicionar'])){
        $nome = $_POST['nome'];
        $local = $_POST['local'];
        $tipo = $_POST['tipo'];
        switch ($tipo) {
            case 'Casa':
                $imovel = new Casa($nome, $local);
                break;
            case 'Quarto':
                $imovel = new Quarto($nome, $local);
                break;
            case 'Estudio':
                $imovel = new Estudio($nome, $local);
                break;
            default:
                $mensagem = "Tipo de imóvel inválido.";
                goto renderizar;
        }
        $locadora->adicionarImovel($imoveis);

        $mensagem = "Imóvel adicionado com sucesso!";
    }
    elseif(isset($_POST['alugar'])){

        $dias = isset($_POST['dias']) ? (int)$_POST['dias'] : 1;
        $mensagem = $locadora->alugarImovel($_POST['nome'], $dias);
    }
    elseif(isset($_POST['devolver'])){
        $mensagem = $locadora->devolverImovel($_POST['nome']);
    }
    elseif(isset($_POST['deletar'])){
        $mensagem = $locadora->deletarImoveis($_POST['nome'], $_POST['local']);
    }
    elseif(isset($_POST['calcular'])){
        $dias = (int)$_POST['dias_calculo'];
        $tipo = $_POST['tipo_calculo'];
        $valor = $locadora->calcularPrevisaoAluguel($dias, $tipo);

        $mensagem = "Previsão de valor para {$dias} dias: R$ " . number_format($valor, 2, ',', '.');
    }    
}

renderizar:
require_once __DIR__ . '/../views/template.php';

?>
