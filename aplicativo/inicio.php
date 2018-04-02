<?php
ob_start();
session_start();
//VERIFICA SE USUÁRIO TEM ACESSO A PÁGINA
if(isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    //INCLUI AS FUNÇÕES NECESSÁRIAS
	include_once 'functions/validar.php';
	include_once 'functions/functions.php';
	include_once 'functions/conexoes.php';
	include_once 'include/modal.php';
}else{
   include_once 'functions/iniciar.php';
    include_once 'functions/functions.php';
   include_once 'functions/conexoes.php';
}
//} 
$idTorre = 1;
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
                <div class="container-full box">
                
            <div id="hot">
                <div class="container-full">
                    <div class="product-slider">
                        <div class="item">
                            <div class="product">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                <div class="text">
                                    <h3>♜ | Nome da Torre</h3>
                                    <button type="submit" class="btn btn-sm btn-block btn-default btn-primary">Visitar </button>
                                </div>
                                <div class="ribbon sale">
                                    <div class="theribbon"><center>fãs<br>1200</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->

                                <div class="ribbon new">
                                    <div class="theribbon"><center>Visitas<br>+300</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <div class="item">
                            <div class="product">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                <div class="text">
                                    <h3><a href="detail.html">White Blouse Armani</a></h3>
                                    <p class="price"><del>$280</del> $143.00</p>
                                </div>
                                <!-- /.text -->

                                <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->

                            </div>
                            <!-- /.product -->
                        </div>

                    </div>
                    <!-- /.product-slider -->
                </div>
            </div>
            <hr>
                <div class="luis" id="customer-order">
                    <div class="box" id="contact">
                        <h2 class="text-center">Nome da Torre</h2>
                        <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                        <p class="lead text-center">Descritivo principal da torre</p>
                        <hr>
                        <div class="group">
                        <p class="text-center buttons">
                        <a href="#"  class="btn btn-sm btn-default btn-secondary mesmo-tamanho">120<br>Fãs</a>
                        <a href="#"  class="btn btn-sm btn-default btn-secondary mesmo-tamanho">35<br>Paginas</a>
                        <a href="#"  class="btn btn-sm btn-default btn-secondary mesmo-tamanho">21<br>Lojas</a>
                        <a href="#"  class="btn btn-sm btn-default btn-secondary mesmo-tamanho">30<br>Produtos</a>
                        </p>
                        <a href="#" data-toggle="modal" data-target="#modal-gratuito" class="btn btn-sm btn-block btn-primary ">Ganhou +1 Fã</a>
                        
                        </div>
                        <hr>
                        <p>Ranking da Torre</p>
                        <div class="panel-group" id="accordion">

                            <div class="panel panel-ouro">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#faq1">
                                            1º Lugar | Nome da Página
                                        </a>
                                    </h4>
                                </div>
                                <div id="faq1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Título.</p>
                                        <div class="box slideshow">
                                        <div class="owl-carousel owl-theme product-slider">
                                            <div class="item">
                                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                                            </div>
                                        </div>
                                        </div>
                                        <p>Descritivo do album.</p>
                                        <ul>
                                            <li>Elegancia.</li>
                                            <li>Modernidade.</li>
                                            <li>Visualização.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel -->

                            <div class="panel panel-prata">
                                <div class="panel-heading">
                                    <h4 class="panel-title ">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            2º Lugar | Nome da Página
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Título.</p>
                                        <div class="box slideshow">
                                        <div class="owl-carousel owl-theme product-slider">
                                            <div class="item">
                                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                                            </div>
                                        </div>
                                        </div>
                                        <p>Descritivo do album.</p>
                                        <ul>
                                            <li>Elegancia.</li>
                                            <li>Modernidade.</li>
                                            <li>Visualização.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel -->
                            <div class="panel panel-bronze">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            3º Lugar | Nome da Página
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Título.</p>
                                        <div class="box slideshow">
                                        <div class="owl-carousel owl-theme product-slider">
                                            <div class="item">
                                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                                            </div>
                                            <div class="item">
                                                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                                            </div>
                                        </div>
                                        </div>
                                        <p>Descritivo do album.</p>
                                        <ul>
                                            <li>Elegancia.</li>
                                            <li>Modernidade.</li>
                                            <li>Visualização.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel -->

                        </div>
                        <!-- /.panel-group -->


                    </div>


                </div>
                <!-- BANNER PRINCIPAL -->
                <div class="box">
                    <div id="main-slider">
                        <div class="item">
                            <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
                <div class="box">
                <?php include_once 'include/inicioCarrega.php' ?>
                <button  class="btn btn-sm btn-block btn-primary" onclick="carrega()">Carregar mais...</button>
                <div id="retorno"></div>

                </div>
                <a href="#" class="btn btn-sm btn-success" data-spy="affix" data-offset-top="500">Voltar ao Inicio</a>
                <!-- END CONTAINER -->
            </div>
    </div>



<script type="text/javascript">
        function carrega(){
            $.ajax("include/inicioCarrega2.php").done(function(data) {
                $("#retorno").html(data);
            });
            }
        function carregamais(){
            $.ajax("include/inicioCarrega3.php").done(function(data) {
                $("#retorno").html(data);
            });
            }
        //
</script>


<script src="/extilos/aplicativo/js/jquery-1.11.0.min.js"></script>
<script src="/extilos/aplicativo/js/bootstrap.min.js"></script>
<script src="/extilos/aplicativo/js/jquery.cookie.js"></script>
<script src="/extilos/aplicativo/js/waypoints.min.js"></script>
<script src="/extilos/aplicativo/js/modernizr.js"></script>
<script src="/extilos/aplicativo/js/bootstrap-hover-dropdown.js"></script>
<script src="/extilos/aplicativo/js/front.js"></script>
<script src="/extilos/aplicativo/js/owl.carousel.min.js"></script>


</body>

</html>
