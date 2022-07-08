<?php
require_once 'classes/Cliente.php';
require_once 'classes/Erro.php';

if(isset($_POST['salvar'])){

    $nome = $_POST['nome'];
    $cpfcnpj = $_POST['cpfcnpj'];
    $telefone = $_POST['telefone'];
    $observacao = $_POST['observacao'];

    //ATUALIZA O OBJETO
    $cliente = new Cliente();
    $cliente->nome = $nome;
    $cliente->cpfcnpj = $cpfcnpj;
    $cliente->telefone = $telefone;
    $cliente->observacao = $observacao;

    try{
        $cliente->inserir();
    }
    catch(Exception $e){
        Erro::trataErro(($e));
    }
    //Salva o objeto atualizado
    
    //Manda a mensagem para o produto-listar após a alteração bem sucedida
    $msg = "Registro inserido com sucesso.";
    header("location: cliente-listar.php?mensagem={$msg}");
}   
require_once 'layouts/cabecalho.php';

?>
    <title> Cadastro de cliente</title>
</head>
<body>
    <?php 
        require_once 'layouts/menu.php'; 
    ?>

    <div class="container-fluid pt-3">

        <div class="card bg-light" >
                <div class="card-body">
                    <h2 class="card-title">Cadastro de cliente</h2>
                </div>
        </div>
        
        <form name="form" class="pt-3" method="post">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label> 
                <input name="nome" type="text" class="form-control" id="nome">
            </div>
            <div class="mb-3">
                <label for="cpfcnpj" class="form-label">CPF / CNPJ</label>
                <input name="cpfcnpj" type="text" class="form-control" id="cpfcnpj">
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input name="telefone" type="text" class="form-control" id="telefone">
            </div>
            <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <input name="observacao" type="text" class="form-control" id="observacao">
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