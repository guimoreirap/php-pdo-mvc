<?php 

require_once 'autoload.php'; 


//Chama o cabeçalho do HTML
require_once 'layouts/cabecalho.php';
?>
    <title> Página inicial </title>
</head>
<body>
    <?php 
        require_once 'layouts/menu.php'; 
    ?>

    <div>
        <h1>Bem vindo!</h1>
        <h2>Tela inicial do sistema</h2>
    </div>
    
<?php 
    require_once 'layouts/rodape.php';
?>