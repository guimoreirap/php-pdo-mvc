<?php
require_once 'autoload.php'; 

if(isset($_POST['salvar'])){

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpfcnpj = $_POST['cpfcnpj'];
    $telefone = $_POST['telefone'];
    $observacao = $_POST['observacao'];

    //ATUALIZA O OBJETO
    $cliente = new Cliente($id);
    $cliente->nome = $nome;
    $cliente->cpfcnpj = $cpfcnpj;
    $cliente->telefone = $telefone;
    $cliente->observacao = $observacao;

    try{
        $cliente->atualizar();
    }
    catch(Exception $e){
        Erro::trataErro(($e));
    }
    //Salva o objeto atualizado
    
    //Manda a mensagem para o produto-listar após a alteração bem sucedida
    $msg = "Registro alterado com sucesso.";
    header("location: cliente-listar.php?mensagem={$msg}");
}   

    //Chamada do cabecalho do HTML
    require_once 'layouts/cabecalho.php';
?>
    <!-- Mask para telefone e CPF-->
    <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.mask.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpfcnpj").mask("000.000.000-00");
            $("#telefone").mask("(00) 00000-0000");
        })
    </script>
    
    <title> Produto alterar</title>
</head>
<body>
    <?php 
        require_once 'layouts/menu.php'; 
    ?>

    <div class="container-fluid pt-3">

        <div class="card bg-light" >
                <div class="card-body">
                    <h2 class="card-title">Produto alterar</h2>
                </div>
        </div>

        <?php
            $id = $_POST['id'];
            $cliente = new Cliente($id);
        ?>
        
    <form name="form" class="pt-3" method="post">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">

        <div class="mb-3">
                <label for="nome" class="form-label">Nome</label> 
                <input name="nome" type="text" class="form-control" id="nome" value="<?= $cliente->nome ?>">
        </div>
        <div class="mb-3">
                <label for="cpfcnpj" class="form-label">CPF / CNPJ</label>
                <input name="cpfcnpj" type="text" class="form-control" id="cpfcnpj" value="<?= $cliente->cpfcnpj ?>">
        </div>
        <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input name="telefone" type="text" class="form-control" id="telefone" value="<?= $cliente->telefone ?>">
        </div>
        <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <input name="observacao" type="text" class="form-control" id="observacao" value="<?= $cliente->observacao ?>">
        </div>
        
            <button name="salvar" type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>  Salvar
            </button>

                <button type="button" class="btn btn-dark">
                    <a href="cliente-listar.php">
                        <i class="fas fa-undo"></i> Voltar
                    </a>
                </button>
    </form>

    </div>
    
<?php 
    require_once 'layouts/rodape.php';
?>