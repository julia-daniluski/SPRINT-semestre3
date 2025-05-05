<?php 

namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Estudio extends Imoveis implements Locavel {

    public function calcularAluguel(int $dias): float {
        return $dias * DIARIA_ESTUDIO;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Estúdio '{$this->nome}' alugada com sucesso!";
        }
        return "Estúdio '{$this->nome}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Estúdio '{$this->nome}' devolvida com sucesso!";
        }
        return "Estúdio '{$this->nome}' está disponível.";
    }

}
