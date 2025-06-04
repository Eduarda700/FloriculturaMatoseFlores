<?php
class UsuarioFuncionario {
    public $idusuario, $usuario, $senha;

    function __construct($idusuario, $usuario, $senha){
        $this->idusuario = $idusuario;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    function validaUsuarioSenha($usuario, $senha){
        if($usuario == $this->usuario && $senha == $this->senha){
            return true;
        }
        return false;
    }
}
?>