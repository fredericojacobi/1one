<?php
include_once "ObjectBase.php";

class Permissao extends ObjectBase
{
    public string $nome, $nivel, $categoria;

    public function __construct($nome, $nivel, $categoria)
    {
        $this->nome = $nome;
        $this->nivel = $nivel;
        $this->categoria = $categoria;
    }
}