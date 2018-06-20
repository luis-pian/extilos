<?php
ob_start();
session_start();
//VERIFICA SE USUÁRIO TEM ACESSO A PÁGINA
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resposta'] = 'negado';
    header("Location: login.php"); exit;
} 
//INCLUI AS FUNÇÕES NECESSÁRIAS
include_once 'functions/validar.php';
include_once 'functions/functions.php';
include_once 'functions/conexoes.php';
include_once 'include/modal.php';
// RETORNA OS VALORES QUE SERÃO USADOS NA PÁGINA
$total = album_total($idLogado);
$while = album_while($idLogado);
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
                <div class="col-md-9" id="customer-order">
                    <a type="button" class="" data-toggle="modal" data-target="#modal-fotos">
                        <i class="pull-right fa fa-align-justify"></i></a>
                        <h4>Álbuns de fotos</h4>
                        <p class="text-muted">Seus álbuns e postagens são organizadas por estilo.</p>
                        <?php
                        if(isset($_SESSION['resposta'])){
                            include_once 'include/resposta.php';
                        }
                        ?>
                        <div class="col-sm-6 box">
                            <form action="cadastros/album.php" method="post" >
                                <div class="form-group">
                                    <label for="album">Novo estilo.</label>
                                    <input type="text" class="form-control" name="album" id="album" size="50">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-block btn-primary"> Criar</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th colspan="1">Post</th>
                                    <th colspan="1">Estilos</th>
                                    <th colspan="1">total: <?php echo $total;?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($user = $while->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                                    <form action="minhas-fotos.php" method="post">
                                    <?php
                                            $nomeAlbum = mb_strimwidth($user['album'], 0, 13,"..."); // carrega informações do album
                                            $idAlbum = $user['idAlbum'];
                                            $total_post = conta_album($idAlbum);
                                            $qtdPost = $total_post;
                                        ?>
                                        <tr>
                                            <td>
                                             ( <?php echo $qtdPost ?> )
                                           </td>

                                        <td>
                                            <?php echo $nomeAlbum ?>

                                        </td>
                                        <td>
                                            <input type="hidden" name="nomeAlbum" value=<?php echo $nomeAlbum ?>>
                                            <input type="hidden" name="idAlbum" value=<?php echo $idAlbum ?>>
                                            <input type="submit" class="btn btn-sm btn-block btn-default btn-primary" value="Editar"> </input>
                                        </td>
                                    </tr>
                                    </form>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left">© 2018 eXtilos.com</p>
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
