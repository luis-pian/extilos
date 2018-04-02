<?php
ob_start();
session_start();
require_once 'conn/init.php';
if(isset($_SESSION['idLogado'])){
    header("Location: index.php"); exit;
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
    <link href="css/style.blue.css" rel="stylesheet" id="theme-stylesheet">
    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">
</head>
<body>
    <div id="all">
        <div id="content">
            <div class="container box">
                <?php
                if(isset($_SESSION['resposta'])){
                   include_once "include/resposta.php";
               }
               ?>
               <div id="load" style="display: none" >
                  <p><i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Verificando</p>
               </div>
               <div class="box">
                <h3>Login</h3>
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                $hr = date(" H ");
                if($hr >= 12 && $hr<18) {
                    $resp = "Olá, Boa tarde! <br> Entre com seu email e senha.";}
                    else if ($hr >= 0 && $hr <12 ){
                        $resp = "Olá, Bom dia! <br> Entre com seu email e senha.";}
                        else {
                            $resp = "Olá, Boa noite! <br> Entre com seu email e senha.";}
                            ?>
                            <p class="lead"><?php echo "$resp"; ?></p>
                            <hr>

                            <form action="functions/logar.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="emailUsuario" id="inputEmail">
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" name="senhaUsuario" id="inputPassword">
                                </div>
                                <div class="text-center">

                                    <input type="submit" name="logar" value="Entrar" class="btn btn-lg btn-block btn-success" onclick="load('load')">

                                    <label class="small">Ops! <a href="text.html">Esqueci a senha</a>.</label>
                                </div>
                            </form>

                <a href="register.php" class="btn btn-lg btn-block btn-default btn-secondary">Cadastre-se</a>
                </div>
                </div>
                    <!-- /.container -->
            </div>
                <!-- /.content -->
    </div>
            <!-- /#all -->
    <!-- *** SCRIPTS TO INCLUDE ***
    _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script type="text/javascript">
        function load(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';
    }
    </script>
</body>
</html>
