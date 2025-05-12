<?php
namespace Models;

// Classe abstrata para todos os tipos de imóveis
abstract class Imoveis {
    protected string $nome;
    protected string $local;
    protected bool $disponivel;

    public function __construct(string $nome, string $local) {
        if (empty($nome) || empty($local)) {
            throw new \InvalidArgumentException("Nome e Local não podem ser vazios.");
        }

        $this->nome = $nome;
        $this->local = $local;
        $this->disponivel = true;
    }

    // Função abstrata para cálculo de aluguel
    abstract public function calcularAluguel(int $dias): float;

    // Verifica se o imóvel está disponível
    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    // Retorna o nome do imóvel
    public function getNome(): string {
        return $this->nome;
    }

    // Retorna o local do imóvel
    public function getLocal(): string {
        return $this->local;
    }

    // Altera a disponibilidade do imóvel
    public function setDisponivel(bool $disponivel): void {
        $this->disponivel = $disponivel;
    }

    // Método para alugar o imóvel
    public function alugar(): void {
        if ($this->disponivel) {
            $this->setDisponivel(false);
        } else {
            throw new \Exception("O imóvel já está alugado.");
        }
    }

    // Método para devolver o imóvel
    public function devolver(): void {
        if (!$this->disponivel) {
            $this->setDisponivel(true);
        } else {
            throw new \Exception("O imóvel já está disponível.");
        }
    }
}
