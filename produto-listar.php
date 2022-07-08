<?php 

require_once 'autoload.php'; 


    try{                             
        $produto = new Produto();
        $lista = $produto->listar();
    } catch(Exception $e){
        Erro::trataErro($e);
    }

//Chama o cabeçalho do HTML
require_once 'layouts/cabecalho.php';
?>

    <title>Produto</title>
</head>
<body>
    <?php 
        require_once 'layouts/menu.php';
    ?>
    
    <div class="container"> 
        <div class="card" id="card">
            <div class="card-body">
                <h2>Produtos</h2>
            </div>
        </div>

        <?php if(isset($_GET['mensagem'])): ?> 
            <div class ="alert alert-success" role="alert">
                <?= $_GET['mensagem'] ?>
            </div>
        <?php endif; ?>

    <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Data de cadastro</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        foreach($lista as $key => $linha){
                        // puxa todos os valores de cada row/linha 
                        ?>
                            <tr>                            
                                <td> <?= $linha['id'] ?></td>
                                <td> <?= $linha['nome'] ?></td>
                                <td> <?= $linha['descricao'] ?></td>
                                <td> <?= date('d/m/Y', strtotime($linha['data'])) ?></td>
                                <td> <?= $linha['status'] ?></td>
                                <td  class="d-flex">
                                        <form action="produto-alterar.php" method="post">
                                            <input type="hidden" name="id" value="<?= $linha['id'] ?>">

                                            <button href="" type="submit" name="alterar" value="alterar" class="btn btn-warning btn-sm">
                                                    <i class="far fa-edit"></i>
                                            </button>
                                        </form>

                                        <form action="produto-excluir.php" method="post" onsubmit="return confirm('Tem certeza que quer excluir o registro?')">          
                                            <input type="hidden" name="id" value="   <?= $linha['id'] ?>">
                                            <button type="submit" id="excluir" name="excluir" value="excluir" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                </td>
                            </tr>
                    <?php } ?>
                   </tbody>

        </table>
        <a href="produto-cadastrar.php">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>Cadastrar
                </button>
        </a>
    </div>
<?php 
    require_once 'layouts/rodape.php';
?>