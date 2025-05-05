<?php 

namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Cenario extends Imoveis implements Locavel {

    public function calcularAluguel(int $dias): float {
        return $dias * DIARIA_CENARIO;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Cenário '{$this->nome}' alugada com sucesso!";
        }
        return "Cenário '{$this->nome}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Cenário '{$this->nome}' devolvida com sucesso!";
        }
        return "Cenário '{$this->nome}' está disponível.";
    }

}
