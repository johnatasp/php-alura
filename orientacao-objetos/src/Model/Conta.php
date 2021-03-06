<?php

declare(strict_types=1);

namespace Alura\Model;

use Alura\Exception\SaldoInsuficienteException;
use InvalidArgumentException;

/**
 * Class Conta
 * @package Alura\Model
 */
abstract class Conta
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    private int $numero;

    /**
     * @var float
     */
    private float $saldo;

    /**
     * @var Titular
     */
    private Titular $titular;

    /**
     * @var float
     */
    private float $tarifa;

    /**
     * @var int
     */
    protected static $sequence = 0;

    /**
     * Conta constructor.
     * @param Titular $titular
     * @param int $numero
     * @param int $saldo
     */
    public function __construct(Titular $titular, int $numero, int $saldo = 0)
    {
        $this->id = ++Conta::$sequence;
        $this->titular = $titular;
        $this->numero = $numero;
        $this->saldo = $saldo;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return float
     */
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    /**
     * @param float $saldo
     */
    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
    }

    /**
     * @return Titular
     */
    public function getTitular(): Titular
    {
        return $this->titular;
    }

    /**
     * @param Titular $titular
     */
    public function setTitular(Titular $titular): void
    {
        $this->titular = $titular;
    }

    /**
     * @param float $valor
     */
    public function sacar(float $valor): void
    {
        if ($this->saldo < $valor) {
            throw new SaldoInsuficienteException();
        }

        $this->saldo -= $valor + ($valor * $this->getTarifa());
    }

    /**
     * @param float $valor
     */
    public function depositar(float $valor): void
    {
        if (0 >= $valor) {
            throw new InvalidArgumentException("Valor invalido.");
        }

        $this->saldo += $valor;
    }

    /**
     * @param float $valor
     * @param Conta $destino
     */
    public function transferir(float $valor, Conta &$destino): void
    {
        if ($this->saldo < $valor) {
            throw new SaldoInsuficienteException();
        }

        $this->sacar($valor);
        $destino->depositar($valor);
    }


    /**
     * @return float
     */
    abstract protected function getTarifa(): float;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Nº: {$this->numero}, Titular: {$this->titular->getNome()}, "
            . "CPF: {$this->titular->getCpf()}, Saldo: {$this->saldo}" . PHP_EOL;
    }
}
