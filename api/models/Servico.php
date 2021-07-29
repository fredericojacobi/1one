<?php
include_once "ObjectBase.php";

class Servico extends ObjectBase
{
    public string
        $id_Usuario,
        $id_TipoServico,
        $titulo,
        $descricaoCurta,
        $descricaoLonga,
        $valorDesejado,
        $dataExpiracao;

    public function __construct($id_Usuario,
                                $tipoServico,
                                $titulo,
                                $descricaoCurta,
                                $descricaoLonga,
                                $valorDesejado,
                                $dataExpiracao)
    {
        $this->id_Usuario = $id_Usuario;
        $this->id_TipoServico = $tipoServico;
        $this->titulo = $titulo;
        $this->descricaoCurta = $descricaoCurta;
        $this->descricaoLonga = $descricaoLonga;
        $this->valorDesejado = $valorDesejado;
        $this->dataExpiracao = $dataExpiracao;
    }
}
