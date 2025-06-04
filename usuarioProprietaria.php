<?php
class UsuarioProprietaria {
    public $id, $nome, $email, $senha;

    function __construct($id, $nome, $email, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    function validaUsuarioSenha($email, $senha) {
        return $this->email === $email && $this->senha === $senha;
    }
}
?>