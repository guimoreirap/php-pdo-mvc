<?php 

    require_once 'autoload.php'; 


    if(isset($_POST['excluir'])){

    try{
        $id = $_POST['id'];
        $cliente = new Cliente($id);
    
        //Salva o objeto atualizado
        $cliente->excluir();
    
    } catch(Exception $e){
        Erro::trataErro(($e));
    }

    $msg = "Registro excluido com sucesso.";
    header("location: cliente-listar.php?mensagem={$msg}");
    }
?>
