<?php
namespace Models;

// Classe abstrata para todos os tipos de veiculos

abstract class Imoveis {
    protected string $nome;
    protected string $local;
    protected bool $disponivel;

    public function __construct (string $nome, string $local){
        $this -> nome = $nome;
        $this -> local = $local;
        $this -> disponivel = true;
    }

    //  Função para cálculo de aluguel / float pq e valor de dinheiro
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel(): bool {
        return $this->disponivel;
    }
    public function getNome(): string{
        return $this->nome;
    }
    public function getLocal(): string{
        return $this->local;
    }
    public function setDisponivel (bool $disponivel):void{
        // void = vazio
        $this->disponivel = $disponivel;

    }

}

