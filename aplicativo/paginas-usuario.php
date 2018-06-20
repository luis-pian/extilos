<?php
ob_start();
session_start();
//verifica se usuario está logado para acessar a página
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resp'] = 'negado';
    header("Location: login.php"); exit;
}
//abre a conexão com banco de dados
require_once 'conn/init.php';
$PDO = db_connect();
//puxa da session o id do usuario
$idLogado = $_SESSION['idLogado'];
$idTorre = 1;
//contar os registros / PAGINA DE PUBLICAÇÃO
$sql_count = "SELECT COUNT(*) AS total FROM ext_paginas where idUsuario = $idLogado OR idUsuario2 = $idLogado OR idUsuario3 = $idLogado ORDER BY nomePagina ASC";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
//carrega as informações necessárias do banco para a página
$sql = "SELECT * FROM ext_paginas where idUsuario = $idLogado OR idUsuario2 = $idLogado OR idUsuario3 = $idLogado order by nomePagina asc";
$stmt = $PDO->prepare($sql);
$stmt->execute();

$corBotao = 1;

if ($corBotao == 1){
    $corBotao = 'css/style.blue.css';
}else{
    $corBotao = 'css/style.pink.css';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head> 
    <meta charset="utf-8">
    <meta name="robots" content="all,follow,extilos,moda">
    <meta name="googlebot" content="index,follow,snippet,archive,moda,extilos">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Extilos - Mostre a sua moda">
    <meta name="author" content="APP Extilos | vempublicar.com">
    <meta name="keywords" content="">
    <title>
        eXtilos | Painel
    </title>
    <meta name="keywords" content="">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <!-- theme stylesheet -->
    <link href=<?php echo $corBotao ?> rel="stylesheet" id="theme-stylesheet">
    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">
</head>

<body>
    <div id="all">
        <div id="content">
            <div class="container box">
                <div class="" id="customer-order">
                        <a type="button" class="" data-toggle="modal" data-target="#modal-cadastro">
                        <i class="pull-right fa fa-align-justify"></i></a>
                        <h4>Novo Blog</h4>
                        <p class="text-muted">Cadastro básico.</p>
                        <?php
                        if (isset($_SESSION['resposta'])){
                          include "include/resposta.php";
                      }
                      ?>
                        <hr>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Páginas <?php echo $total;?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                                    <tr>
                                        <td>
                                           <img src="img/detailsquare.jpg" alt="White Blouse Armani">
                                        </td>
                                            <?php
                                            $nomePagina = $user['nomePagina']; // carrega informações do album
                                            $idPagina = $user['idPagina'];
                                            $idCrip = rand(100,999).$idPagina.rand(1000,9999); //cria um numero randomico para esconder o id do album
                                            $urlPagina = "?id=".$idCrip."&pg=".$nomePagina // cria uma nova id para a url

                                            ?>
                                        <td>
                                        <?php echo $nomePagina ?>
                                        </td>
                                        <td align="center">
                                        <a href="pagina.php">
                                        Editar</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>



</body>

</html>
