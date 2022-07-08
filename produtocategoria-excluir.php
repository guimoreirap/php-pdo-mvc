<?php 

    require_once 'autoload.php'; 


    if(isset($_POST['excluir'])){

    try{
        $id = $_POST['id'];
        $categoria = new ProdutoCategoria($id);
    
        //Salva o objeto atualizado
        $categoria->excluir();
    
    } catch(Exception $e){
        Erro::trataErro(($e));
    }

    $msg = "Registro excluido com sucesso.";
    header("location: produtocategoria-listar.php?mensagem={$msg}");
    }
?>
