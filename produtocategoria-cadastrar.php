<?php
    require_once 'classes/ProdutoCategoria.php'; 
    require_once 'classes/Erro.php';
    
    if(isset($_POST['salvar'])){

        $nome = $_POST['nome'];
    
        //ATUALIZA O OBJETO
        $categoria = new ProdutoCategoria();
        $categoria->nome = $nome;
    
        try{
            $categoria->inserir();
        }
        catch(Exception $e){
            Erro::trataErro(($e));
        }
        //Salva o objeto atualizado
        
        //Manda a mensagem para o produto-listar após a alteração bem sucedida
        $msg = "Registro inserido com sucesso.";
        header("location: produtocategoria-listar.php?mensagem={$msg}");
    }   
    

    //Inicio do head do HTML
    require_once 'layouts/cabecalho.php';
  
?>
    <title>Cadastro de Categoria de Produto</title>
</head>
<body>
    <?php
      require_once 'layouts/menu.php';
    ?>     
    
    <div class="container-fluid pt-3">
        <div class="card" id="card">
            <div class="card-body">
              <h2>Cadastro de Categoria de Produto</h2>
            </div>
        </div>
           
         <form name="form" class="pt-3" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" id="nome">
            </div>

            <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>

            <a class="navbar-brand" href="produtocategoria-listar.php">
                <button type="button" class="btn btn-secondary">Voltar</button>
            </a>
        </form>
    </div>

<?php
    require_once 'layouts/rodape.php';
?>