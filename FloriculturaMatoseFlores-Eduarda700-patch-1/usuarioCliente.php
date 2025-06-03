<?php
class usuarioCliente {
    public $idusuario_cliente, $nome_cliente,$senha_cliente, $email_cliente, $telefone_cliente, $cpf_cliente,
    $data_nascimento, $cep_cliente, $rua_cliente, $numero_cliente, $complemento_cliente, $bairro_cliente, $cidade_cliente, $estado_cliente;

    function __construct( $idusuario_cliente, $nome_cliente,$senha_cliente, $email_cliente, $telefone_cliente, $cpf_cliente,
    $data_nascimento, $cep_cliente, $rua_cliente, $numero_cliente, $complemento_cliente, $bairro_cliente,
     $cidade_cliente, $estado_cliente){
        $this->idusuario_cliente = $idusuario_cliente;
        $this->nome_cliente = $nome_cliente;
        $this->senha_cliente = $senha_cliente;
        $this->email_cliente = $email_cliente;
        $this->telefone_cliente = $telefone_cliente;
        $this->cpf_cliente = $cpf_cliente;
        $this->cep_cliente = $cep_cliente;
        $this->rua_cliente = $rua_cliente;
        $this->numero_cliente = $numero_cliente;
        $this->complemento_cliente = $complemento_cliente;
        $this->bairro_cliente = $bairro_cliente;
        $this->cidade_cliente = $cidade_cliente;
        $this->estado_cliente = $estado_cliente;
    }

   
    function validaUsuarioClienteSenha($email_cliente, $senha_cliente){
        return ($email_cliente == $this->email_cliente && $senha_cliente == $this->senha_cliente);
    }
}
?>



