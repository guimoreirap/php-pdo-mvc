<?php
require_once 'autoload.php'; 

if(isset($_POST['salvar'])){

    $id = $_POST['id'];
    $nome = $_POST['nome'];

    //ATUALIZA O OBJETO
    $categoria = new ProdutoCategoria($id);
    $categoria->nome = $nome;

    try{
        $categoria->atualizar();
    }
    catch(Exception $e){
        Erro::trataErro(($e));
    }
    //Salva o objeto atualizado
    
    //Manda a mensagem para o produto-listar após a alteração bem sucedida
    $msg = "Registro alterado com sucesso.";
    header("location: produtocategoria-listar.php?mensagem={$msg}");
}   

    //Chamada do cabecalho do HTML
    require_once 'layouts/cabecalho.php';
?>
    <title> Categoria de Produto alterar</title>
</head>
<body>
    <?php 
        require_once 'layouts/menu.php'; 
    ?>

    <div class="container-fluid pt-3">

        <div class="card bg-light" >
                <div class="card-body">
                    <h2 class="card-title">Categoria de Produto alterar</h2>
                </div>
        </div>

        <?php
            $id = $_POST['id'];
            $categoria = new ProdutoCategoria($id);
        ?>
        
    <form name="form" class="pt-3" method="post">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">

        <div class="mb-3">
                <label for="nome" class="form-label">Nome</label> 

                <!-- TROCAR OS $LINHA POR $PRODUTO MAS DA ERRO-->

                <input name="nome" type="text" class="form-control" id="nome" value="<?= $categoria->nome ?>">
        </div>
        
        
            <button name="salvar" type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>  Salvar
            </button>

                <button type="button" class="btn btn-dark">
                    <a href="produto-listar.php">
                        <i class="fas fa-undo"></i> Voltar
                    </a>
                    
                </button>
    </form>

    </div>
    
<?php 
    require_once 'layouts/rodape.php';
?>