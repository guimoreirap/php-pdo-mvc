<?php
    require_once 'classes/Usuario.php';
    require_once 'classes/Erro.php';

    try{                             
        $usuario = new Usuario();
        $lista = $usuario->listar();
    } catch(Exception $e){
        Erro::trataErro($e);
    }

    //Inicio do head HTML
    require_once 'layouts/cabecalho.php';
?>
    <title>Usuário</title>
</head>
<body>
    <?php
      require_once 'layouts/menu.php';
    ?>     

    <div class="container">
        <div class="card" id="card">
            <div class="card-body">
              <h2>Usuários</h2>
            </div>
        </div>

        <?php if(isset($_GET['mensagem'])): ?> 
            <div class ="alert alert-success" role="alert">
                <?= $_GET['mensagem'] ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th> <!-- NOME DO FUNCIONARIO/USUARIO -->
                <th scope="col">E-mail</th> <!-- E-MAIL PARA ENTRAR NO SISTEMA -->
                <th scope="col">Ação</th>

            </tr>
            </thead>

            <tbody>
                <?php foreach($lista as $key => $linha){ ?>
                    <tr>
                        <td><?= $linha['id']?></td>
                        <td><?= $linha['nome']?></td>
                        <td><?= $linha['email']?></td>

                        <td  class="d-flex">
                            <form action="usuario-alterar.php" method="post">
                                <input type="hidden" name="id" value="<?= $linha['id'] ?>">

                                <button href="" type="submit" name="alterar" value="alterar" class="btn btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                </button>
                            </form>
                            <form action="usuario-excluir.php" method="post" onsubmit="return confirm('Tem certeza que quer excluir o registro?')">          
                                <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                                
                                <button type="submit" id="excluir" name="excluir" value="excluir" class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php }?>
            </tbody>
        </table>
        <a class="navbar-brand" href="usuario-cadastrar.php">
          <button type="button" class="btn btn-primary">Cadastrar</button>
        </a>

        <br>
    </div>


<?php
    require_once 'layouts/rodape.php';
?>