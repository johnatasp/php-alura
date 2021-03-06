<?php

declare(strict_types=1);

namespace Alura\Model;

/**
 * Class ContaPoupanca
 * @package Alura\Model
 */
class ContaPoupanca extends Conta
{
    /**
     * ContaPoupanca constructor.
     * @param Titular $titular
     * @param int $numero
     * @param int $saldo
     */
    public function __construct(Titular $titular, int $numero, int $saldo = 0)
    {
        parent::__construct($titular, $numero, $saldo);
    }

    /**
     * @return float
     */
    public function getTarifa(): float
    {
        return 0.02;
    }
}
