<?php 

namespace Models;
use Interfaces\Locavel;



class Quarto extends Imovel implements Locavel {

    public function calcularAluguel(int $dias): float {
        return $dias * DIARIA_QUARTO;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Quarto '{$this->nome}' alugado com sucesso!";
        }
        return "Quarto '{$this->nome}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Quarto '{$this->nome}' devolvido com sucesso!";
        }
        return "Quarto '{$this->nome}' está disponível.";
    }
}

// Visto