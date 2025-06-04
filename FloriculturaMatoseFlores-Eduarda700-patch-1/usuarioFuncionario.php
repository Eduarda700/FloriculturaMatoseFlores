<?php
class usuarioFuncionario {
    public $idusuario_funcionario , $email_funcionario ,$nome_funcionario , $senha_funcionario;

    function __construct( $idusuario_funcionario, $nome_funcionario, $email_funcionario,$senha_funcionario){
        $this->idusuario_funcionario = $idusuario_funcionario;
        $this->email_funcionario = $email_funcionario;
        $this->nome_funcionario = $nome_funcionario;
        $this->senha_funcionario = $senha_funcionario;
    }

   
    function validaSenha($senha){
        return $senha === $this->senha_funcionario;
    }
}
?>



