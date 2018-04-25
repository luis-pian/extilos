<?php
ob_start();
session_start();
//VERIFICA SE USUÁRIO TEM ACESSO A PÁGINA
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['respesposta'] = 'negado';
    header("Location: login.php"); exit;
} 
    //INCLUI AS FUNÇÕES NECESSÁRIAS
	include_once 'functions/validar.php';

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
    <link href="css/meu.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">
</head>

<body>
    <div id="all">
            <div class="container box">
            <h4>Escolha o que deseja publicar</h4>
                                        <div class="box">
                                        		<p>Publicações de conteúdos</p>
                                            	<input  class="btn btn-lg btn-block btn-default btn-warning" value="POSTAGEM SIMPLES">
                                            	<input  class="btn btn-lg btn-block btn-default btn-info" value="NOVO ÁLBUM">
                                    	</div>
                                    	<div class="box">
                                    			<p>Publicações profissionais</p>
                                            	<input  class="btn btn-lg btn-block btn-default btn-danger" value="ADICIONAR PRODUTO">
                                            	<input  class="btn btn-lg btn-block btn-default btn-success" value="FAZER PROPAGANDA">
                                    	</div>

                </div>
            <!-- /.container -->
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