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
    <!-- Link do bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link dos ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .action-wrapper{
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: flex-start;
        }

        .btn-group-actions{
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .delete-btn{
            order: 1;
        }

        .rent-group{
            display: flex;
            align-items: center;
            gap: 0.5rem;
            order: 2;
        }

        .days-input{
            width: 60px !important;
            padding: 0.25rem 0.5rem;
            text-align: center;
        }


        @media (max-width: 768px){
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
    </style>
    <title> ADM - Locadora de veículos</title>
</head>
<body class="container py-4">
    <div class="container py-4">
    <!--Barra de informações de usuario-->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center inicio ">
                    <h1>Sistema de Locadora de veículos</h1>
                    <div class="d-flex align-items-center gap-3 user-info mx-3">
                        <span class="user-icon">
                        <i class="bi bi-person-circle" style="font-size:24px"></i>
                        </span>
                        <!--Bem vindo,[usuario]-->
                        <span class="welcome-text">
                            Bem vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong>
                        </span>
                        <!--Botão de logout-->
                        <a href="?logout=1" class="btn btn-outline-danger d-flex align-items-center gap-1">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </a>
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

        <!--Formulario para add novos veiculos-->
        <div class="row same-height-row">
            <?php if(Auth::isAdmin()): ?>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="mb-0">Adicionar novo veículo 🚗</h4>
                    </div>
                    <div class="card-body">
                        <form action="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="modelo" class="form-label">
                                    Modelo:
                                </label>
                                <input type="text" class="form-control" name="modelo" required>
                                <div class="invalid-feedback">
                                        Informe um modelo válido!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="placa" class="form-label">
                                    Placa:
                                </label>
                                <input type="text" class="form-control" name="placa" required>
                                <div class="invalid-feedback">
                                    Informe uma placa válida!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">
                                    Tipo:
                                </label>
                                <select class="form-select" name="tipo" id="tipo" required>
                                    <option value="empty" disabled selected> </option>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                </select>
                            </div>
                            <button class="btn btn-success w-100" type="submit" name="adicionar">Adicionar veículo</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Formulário para cálculo de aluguel -->
            <div class="col-<?= Auth::isAdmin() ? 'md-6':'12' ?>">
                <div class="card-h-100">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Calcular a previsão de aluguel💰
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="" class="input-label">
                                    Tipo de veículo
                                </label>
                                <select class="form-select" name="tipo" id="tipo" required>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">
                                    Quantidade de dias 📅
                                </label>
                                <input type="number" name="dias_calculo" class="form-control" value="1" required>
                            </div>
                            <button class="btn btn-success w-100" type="submit" name="calcular"> Calcular previsão </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabela de veículos cadastrados -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Veículos cadastrados🗒️
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
                                    <?php if (Auth::isAdmin()): ?>
                                    <th>Ações</th>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php foreach ($locadora->listarVeiculos() as $veiculo): ?>
                                    <tr>
                                        <td><?= $veiculo instanceof \Models\Carro ? 'Carro' : 'Moto' ?></td>
                                        <td><?= htmlspecialchars($veiculo->getModelo()) ?></td>
                                        <td><?= htmlspecialchars($veiculo->getPlaca()) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $veiculo->isDisponivel() ? 'success' : 'warning' ?>"><?= $veiculo->isDisponivel() ? 'Disponível' : 'Alugado' ?> </span>
                                        </td>
                                        <?php if (Auth::isAdmin()): ?>
                                        <td> 
                                            <div class="action-wrapper">
                                                <form action="post" class="btn-group-actions">
                                                <input type="hidden" name="modelo" value="<?=htmlspecialchars($veiculo->getModelo()) ?>">
                                                <input type="hidden" name="placa" value="<?=htmlspecialchars($veiculo->getPlaca()) ?>">
                                                    <!-- Botão deletar(apenas para adm) -->
                                                    <button class="btn btn-danger btn-sm delete-btn" type="submit" name="deletar">
                                                        Deletar
                                                    </button>

                                                    <!-- Botões condicionais -->
                                                    <div class="rent-group">
                                                        <?php if (!$veiculo->isDisponivel()): ?>
                                                    <!-- Veiculo alugado -->
                                                        <button class="btn btn-warning btn-sm" type="submit" name="devolver"> Devolver </button>
                                                    <?php else: ?>
                                                        <!-- Veículo disponível -->
                                                        <input type="number" name="dias" class="form-control days-input" value="1" min="1" required>
                                                        <button class="btn btn-primary" name="alugar" type="submit"> Alugar </button>
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