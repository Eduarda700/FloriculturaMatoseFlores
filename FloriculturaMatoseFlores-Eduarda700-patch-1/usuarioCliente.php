<?php
class usuarioCliente {
    public $idcliente, $usuario_cliente, $email, $senha, $telefone, $endereco_cliente;

    function __construct( $idcliente, $usuario_cliente, $email, $senha, $telefone, $endereco_cliente){
        $this->idcliente = $idcliente;
        $this->usuario_cliente = $usuario_cliente;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco_cliente = $endereco_cliente;
       
    }

    function validaUsuarioClienteSenha($usuario_cliente, $senha){
        if($usuario_cliente == $this->usuario_cliente && $senha == $this->senha){
            return true;
        }
        return false;
    }
}
