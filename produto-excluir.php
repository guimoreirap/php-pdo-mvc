<?php 

    require_once 'autoload.php'; 


    if(isset($_POST['excluir'])){

    try{
        $id = $_POST['id'];
        $produto = new Produto($id);
    
        //Salva o objeto atualizado
        $produto->excluir();
    
    } catch(Exception $e){
        Erro::trataErro(($e));
    }

    $msg = "Registro excluido com sucesso.";
    header("location: produto-listar.php?mensagem={$msg}");
    }
?>
