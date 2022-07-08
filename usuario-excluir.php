<?php 

    require_once 'classes/Usuario.php'; 
    require_once 'classes/Erro.php';

    if(isset($_POST['excluir'])){

    try{
        $id = $_POST['id'];
        $usuario = new Usuario($id);
    
        //Salva o objeto atualizado
        $usuario->excluir();
    
    } catch(Exception $e){
        Erro::trataErro(($e));
    }

    $msg = "Registro excluído com sucesso.";
    header("location: usuario-listar.php?mensagem={$msg}");
    }
?>
