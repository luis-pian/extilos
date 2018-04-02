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
    <!-- *** TOPBAR ***
 _________________________________________________________ -->


    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container box">
            	<div class="navbar-header">
                <a class="navbar-brand home" href="index.html" data-animate-hover="bounce">
                    <img src="imagem/extilos_preto.png" alt="eXtilos.com" class="img-responsive">

                    <div class="navbar-buttons">
                        <div class="col-md-6" data-animate="fadeInDown">
                            <a type="button" class="navbar-toggle" data-toggle="modal" data-target="#login-modal">
                                <span class="sr-only">Toggle navigation</span>
                                <i class="fa fa-align-justify"></i>
                            </a>
                        </div>
                        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                            <div class="modal-dialog modal-sm">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="Login">Painel de Acessos</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php include 'include/painel-fotos.php'  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-9" id="customer-order">
                    <div class="">
                        <h3>Página de Postagens</h3>
                        <p class="text-muted">Lista de páginas que você participa e administra. </p>
                        <?php
                                  if(isset($_SESSION['resp']))
                                    {
                                     if($_SESSION['resp'] == 'sucesso')
                                         {
                                            echo '
                                            <div class="alert">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <p class="text-muted" ><b><font color="00691c">Legal!</b> Sua página foi criada.</font></p>
                                           </div>
                                           ';
                                           unset($_SESSION['resp']);

                                        }
                                    elseif($_SESSION['resp'] == 'alerta')
                                        {
                                            echo '
                                            <div class="alert">
                                             <button type="button" class="close" data-dismiss="alert">×</button>
                                             <p class="text-muted" ><b><font color="00691c">Atenção!</b> Publicamos seu eXtilo, porém deixamos de carregar alguma(s) foto(s) por causa do tamanho do arquivo. <a>Saiba Mais</a></font></p>
                                         </div>
                                         ';
                                         unset($_SESSION['resp']);
                                        }
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
                                        <a href="editar-pagina.php/<?php echo $urlPagina ?>">
                                        Editar</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


                <!-- *** FOOTER ***
        _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>extilos.com</h4>
                        <ul>
                            <li><a href="text.html">Termos de uso</a>
                            </li>
                            <li><a href="text.html">Sobre nós</a>
                            </li>
                            <li><a href="faq.html">Dicas e Sugestõs</a>
                            </li>
                            <li><a href="contact.html">Contato</a>
                            </li>
                        </ul>
                        <hr class="hidden-md hidden-lg hidden-sm">
                    </div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-12">
                        <h4>Visite também</h4>
                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>
                    <!-- /.col-md-3 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->
        <!-- *** FOOTER END *** -->
        <!-- *** COPYRIGHT ***
        _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left">© 2018 eXtilos.com</p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->
    </div>

    <!-- *** SCRIPTS TO INCLUDE ***
     <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total já faturado nas postagens.</th>
                                        <th>$446.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Quantidade de propagandas realizadas</th>
                                        <th>25</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Custo médio da publicidade em sua página. (por dia)</th>
                                        <th>R$0,55</th>
                                    </tr>
                                </tfoot>
 _________________________________________________________ -->
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
