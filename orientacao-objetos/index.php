<?php

require_once 'src/Model/Conta.php';
require_once 'src/Model/Pessoa.php';
require_once 'src/Model/Titular.php';
require_once 'src/Model/Endereco.php';

use Alura\Model\{Conta, Titular, Endereco};

$mariaEndereco = new Endereco("Santa Rita", "Tibiri 2", "S/N", "79A");
$pedroEndereco = new Endereco("João Pessoa", "Centro", "João Agripino", "12");

$maria = new Titular("Maria", "123.456.789-10", $mariaEndereco);
$pedro = new Titular("Pedro", "109.876.543-21", $pedroEndereco);

$mariaConta = new Conta($maria, 77851, 100);
$pedroConta = new Conta($pedro, 65109);

$mariaConta->depositar(75);
$pedroConta->sacar(100);
$mariaConta->transferir(75, $pedroConta);

echo $mariaConta->__toString();
echo $pedroConta->__toString();
