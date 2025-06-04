<?php
class usuarioProprietaria {
    public $idusuario_proprietaria  , $email_proprietaria  ,$nome_proprietaria  , $senha_proprietaria ;

    function __construct( $idusuario_proprietaria , $nome_proprietaria , $email_proprietaria,$senha_proprietaria ){
        $this->idusuario_proprietaria  = $idusuario_proprietaria;
        $this->email_proprietaria  = $email_proprietaria ;
        $this->nome_proprietaria  = $nome_proprietaria ;
        $this->senha_proprietaria  = $senha_proprietaria ;
    }

   
    function validaSenha($senha){
        return $senha === $this->senha_proprietaria;
    }
}
?>



