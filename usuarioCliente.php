<?php
class usuarioCliente {
    public $codigo, $nome, $email, $senha, $telefone, $endereco;

    function __construct($codigo, $nome, $email, $senha, $telefone, $endereco){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
       
    }

    function validaUsuarioClienteSenha($email, $senha){
        if($email === $this->email && $senha === $this->senha;){
            return true;
        }
    }return false;
}
