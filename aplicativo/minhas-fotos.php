<?php
ob_start();
session_start();
//VERIFICA SE USUÁRIO TEM ACESSO A PÁGINA
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resposta'] = 'negado';
    header("Location: login.php"); exit;
}
//VERIFICA SE EXISTE O MÉTODO PASSADO VIA GET
if (isset($_POST['idAlbum'])){
        if (isset($_POST['nomeAlbum'])){
            $idAlbum = $_POST['idAlbum'];
            //$idAlbum = substr($idAlbum, 3,-4);
            $nomeAlbum = $_POST['nomeAlbum'];
        }
        //TRATA OS CONTEÚDOS QUE SÃO PASSADOS VIA GET
        //$idAlbum = sanitizeString($idAlbum);
        //$nomeAlbum = sanitizeString($nomeAlbum);
    }else{
        header("Location: album.php"); exit;
    }
//INCLUI AS FUNÇÕES NECESSÁRIAS
include_once 'functions/validar.php';
include_once 'functions/functions.php';
include_once 'functions/conexoes.php';
include_once 'include/modal.php';
//RETORNA VALOR DO BANCO DE DADOS PARA VALIDAR SE O USUARIO QUE ESTA ACESSANDO O ALBUM TEM PERMISÃO
$albumResposta = banco_album($idLogado, $idAlbum);
// VERIFICA SE O USUÁRIO TEM PERMISÃO PARA ACESSAR O ALBUM.
if ($albumResposta['album']!= $nomeAlbum){
    header("Location: album.php"); exit;
    }
// RETORNA OS VALORES DO BANCO DE FOTOS REFERENTE AO ALBUM SELECIONADO
$albumImagemResposta = banco_imagem($idAlbum);
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
                <div class="container box ">
                <div class="" id="customer-order">
                    <a type="button" class="" data-toggle="modal" data-target="#modal-fotos">
                    <i class="pull-right fa fa-align-justify"></i></a>
                    <h4>Estilo</h4>
                    <!-- CARD DE EXIBIÇÃO -->
                    <div class="col-md-9" id="wishlist">    
                    <hr>
                         <h3 class="text-center"><?php echo $albumResposta['album']?></h3>
                    <hr>
                        <?php while ($fotos = $albumImagemResposta->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                        <!-- INFORMAÇÃOE DO ALBUM -->
                        <div class="box slideshow">
                            <h4><?php echo $fotos['usuTitulo'] ?></h4>
                            <?php
                                $retorno = linkHashtag($fotos['usuMarca']);
                                $idAleatorio = uniqid();
                                $idAleatorio1 = uniqid();
                            ?>
                            <!-- DESCRITIVO DO ALBUM -->
                            <div class="col-md-12">
                                    <?php if ($retorno[3] < 20) { ?>
                                        <p> <?php echo $retorno[0]; ?> </p>
                                    <?php  }else{ ?>
                                        <p id="<?php echo $idAleatorio1 ?>" > <?php echo $retorno[2]; ?>
                                        <a  onclick="
                                            Mudarestado('<?php echo $idAleatorio ?>'); 
                                            Mudarestado1('<?php echo $idAleatorio1 ?>');
                                            this.style.display = 'none'">...mais</a>
                                        </p>
                                        <p id="<?php echo $idAleatorio ?>" style="display:none"><?php echo $retorno[1] ?>
                                        </p>
                                    <?php  } ?>
                            </div>
                            <!-- FOTOS DO ALBUM -->
                            <?php if(isset($fotos['img'])){ ?>
                            <div class="owl-carousel owl-theme product-slider">
                                <?php
                                $foto0 = isset($fotos['img']) ? $fotos['img'] : null;
                                $foto1 = isset($fotos['img1']) ? $fotos['img1'] : null;
                                $foto2 = isset($fotos['img2']) ? $fotos['img2'] : null;
                                $foto3 = isset($fotos['img3']) ? $fotos['img3'] : null;
                                $foto4 = isset($fotos['img4']) ? $fotos['img4'] : null;

                                $quantasFotos = array($foto0, $foto1, $foto2, $foto3, $foto4);
                                $conta = count($quantasFotos);
                                for ($g = 0; $g < $conta; $g++){
                                    if ($quantasFotos[$g]!= 0){
                                        ?>
                                        <div class="">
                                            <a href="#">
                                               <img src="imagem/media/<?php echo $quantasFotos[$g] ?>" alt="" class="img-responsive">
                                           </a>
                                       </div>
                                       <?php
                                   }
                               }
                               ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php
                        if (!isset($conta)){
                            echo '<p class="text-center">Ainda não tem conteúdo neste estilo</p>';
                        }
                    ?>
                    <!-- END CARD EXIBIÇÃO -->
                </div>
                <!-- END CONTAINER -->
            </div>
            <!-- END CONTENT -->
        <!-- RODAPÉ -->
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
