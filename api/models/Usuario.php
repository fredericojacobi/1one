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
        $verificado,
        $email,
        $senha,
        $ativo,
        $permissao;


    public function __construct($nome,
                                $sobrenome,
                                $dataNascimento,
                                $cpf,
                                $tipoUsuario,
                                $endereco,
                                $telefone,
                                $email,
                                $senha,
                                $ativo = false,
                                $verificado = false)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataNascimento = $dataNascimento;
        $this->cpf = $cpf;
        $this->tipoUsuario = $tipoUsuario;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
        if(empty($ativo))
            $this->ativo = 0;
        else
            $this->ativo = $ativo;
        if (empty($verificado))
            $this->verificado = 0;
        else
            $this->verificado = $verificado;
    }
}
