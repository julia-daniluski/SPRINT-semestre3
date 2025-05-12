<?php
namespace Services;

use Models\{Imoveis, Casa, Quarto, Estudio};

// classe para gerenciar a locação
class Locadora {
    private array $imoveis = [];

    public function __construct() {
        $this->carregarImoveis();
    }
    
    private function carregarImoveis(): void{
        if(file_exists(ARQUIVO_JSON)){
            //decodifica o arquivo JSON
            $dados = json_decode(file_get_contents(ARQUIVO_JSON), true);

            foreach($dados as $dado){
                if ($dado['tipo'] === 'Casa'){
                    $imovel = new Casa($dado['nome'], $dado ['local']);
                } elseif ($dado['tipo'] === 'Estudio') {
                    $imovel = new Estudio($dado['nome'], $dado['local']);
                } else {
                    $imovel = new Quarto($dado['nome'], $dado ['local']);
                }
                $imovel->setDisponivel($dado['disponivel']);

                $this->imoveis[] = $imovel;
            }
        }
    }

    // Salvar veículos
    private function salvarImoveis(): void{
        $dados = [];

        foreach($this-> imoveis as $imovel) {
            $dados[] = [
                'tipo' => ($imovel instanceof Casa) ? 'Casa' : ($imovel instanceof Estudio ? 'Estudio' : 'Quarto'), 
                'nome' => $imovel -> getNome(),
                'local' => $imovel -> getLocal(),
                'disponivel' => $imovel -> isDisponivel()
            ];
        }

            $dir = dirname(ARQUIVO_JSON);

            if(!is_dir($dir)){
                mkdir($dir, 0777, true);
            }

            file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
    }

        // Adicionar novo imóvel
        public function adicionarImovel(Imoveis $imovel): void {
            $this->imoveis[] = $imovel;
            $this->salvarImoveis();
        }


    //Remover veículo
    public function deletarImovel (string $nome, string $local): string{
        foreach ($this->imoveis as $key => $imovel){
            // verifica se o modelo e placa correspondem
            if($imovel->getNome() === $nome && $imovel->getLocal() === $local){
                // remove o veículo do array
                unset($this->imoveis[$key]);

                //reorganizar os indices
                $this->imoveis = array_values($this->imoveis);

                //Salvar o novo estado 
                $this->salvarImoveis();
                return "Imóvel '{$nome}' removido com sucesso!";
            }
        }
        return "Imóvel não encontrado!";
    }

    //Alugar imóvel por n dias
    public function alugarImovel(string $nome, int $dias = 1): string{
        //percorre a lista
        foreach($this->imoveis as $imovel){
            if($imovel->getNome() === $nome && $imovel->isDisponivel()){
                // calcular valor do aluguel
                $valorAluguel = $imovel->calcularAluguel($dias);

                //Marcar como indisponivel
                $mensagem = $imovel->alugar();

                $this->salvarImoveis();

                return $mensagem . "Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
            } 
        }
        return "Imóvel não disponível";
    }

    //Devolver veículo
    public function devolverImovel(string $nome) :string{
        //Percorre a lista
        foreach($this->imoveis as $imovel){
            if($imovel->getNome() === $nome && !$imovel->isDisponivel()){

                // disponibilizar o veículo
                $mensagem = $imovel->devolver();

                $this->salvarImoveis();
                return $mensagem;
            }
        }
        return "Imóvel já disponível ou não encontrado.";
    }

    // Retorna lista de veículos
    public function listarImoveis(): array{
        return $this->imoveis;
    }

    // Calcular previsão do valor
    public function calcularPrevisaoAluguel(string $tipo, int $dias): float{
        if($tipo === 'Casa'){
            return (new Casa('', '')) ->calcularAluguel($dias);
        } elseif ($tipo === 'Estudio') {
            return (new Estudio('', ''))->calcularAluguel($dias);
        }
        return (new Quarto('', '')) ->calcularAluguel($dias);
    }
}