<?php
class usuario {
    public $codigo, $nome, $email, $senha, $telefone;

    function __construct($codigo, $nome, $email, $senha){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
       
    }

    function validaUsuarioSenha($email, $senha){
        return $email === $this->email && $senha === $this->senha;
    }
}

