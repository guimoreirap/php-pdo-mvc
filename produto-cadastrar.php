<?php
require_once 'classes/Produto.php';

if(isset($_POST['salvar'])){

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    //ATUALIZA O OBJETO
    $produto = new Produto();
    $produto->nome = $nome;
    $produto->descricao = $descricao;
    $produto->status = $status;

    try{
        $produto->inserir();
    }
    catch(Exception $e){
        Erro::trataErro(($e));
    }
    //Salva o objeto atualizado
    
    //Manda a mensagem para o produto-listar após a alteração bem sucedida
    $msg = "Registro inserido com sucesso.";
    header("location: produto-listar.php?mensagem={$msg}");
}   
require_once 'cabecalho.php';

?>
    <title> Cadastro de produto</title>
</head>
<body>
    <?php 
        require_once 'nav-body.php'; 
    ?>

    <div class="container-fluid pt-3">

        <div class="card bg-light" >
                <div class="card-body">
                    <h2 class="card-title">Cadastro de produto</h2>
                </div>
        </div>
        
        <form name="form" class="pt-3" method="post">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label> 
                <input name="nome" type="text" class="form-control" id="nome">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input name="descricao" type="text" class="form-control" id="descricao">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input name="status" type="text" class="form-control" id="status">
            </div>
            
                <button name="salvar" type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>  Salvar
                </button>

                <a href="#">
                    <button type="button" class="btn btn-dark">
                        <a href="produto-listar.php">
                            <i class="fas fa-undo"></i> Voltar
                        </a>
                        
                    </button>
                </a>
        </form>
    </div>
<?php 
    require_once 'rodape.php';
?>