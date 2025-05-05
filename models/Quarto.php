<?php 

namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Quarto extends Imoveis implements Locavel {

    public function calcularAluguel(int $dias): float {
        return $dias * DIARIA_QUARTO;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Quarto '{$this->nome}' alugada com sucesso!";
        }
        return "Quarto '{$this->nome}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Quarto '{$this->nome}' devolvida com sucesso!";
        }
        return "Quarto '{$this->nome}' está disponível.";
    }

}
