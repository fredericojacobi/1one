<?php
include_once "ObjectBase.php";

class Usuario extends ObjectBase
{
    public string
        $nome,
        $sobrenome,
        $dataNascimento,
        $endereco,
        $antecedentesCriminais,
        $arquivoCpf,
        $dataVerificado,
        $cpf,
        $tipoUsuario,
        $telefone,
        $verificado;


    public function __construct($nome,
                                $sobrenome,
                                $dataNascimento,
                                $cpf,
                                $tipoUsuario,
                                $endereco,
                                $telefone,
                                $verificado = false)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataNascimento = $dataNascimento;
        $this->cpf = $cpf;
        $this->tipoUsuario = $tipoUsuario;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        if(empty($verificado))
            $this->verificado = 0;
        else
        $this->verificado = $verificado;
    }
}
