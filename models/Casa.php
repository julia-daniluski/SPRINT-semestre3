<?php 

namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Casa extends Imovel implements Locavel {

    public function calcularAluguel(int $dias): float {
        return $dias * DIARIA_CASA;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Casa '{$this->nome}' alugada com sucesso!";
        }
        return "Casa '{$this->nome}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Casa '{$this->nome}' devolvida com sucesso!";
        }
        return "Casa '{$this->nome}' está disponível.";
    }
}

// Visto
