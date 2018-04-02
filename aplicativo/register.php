<?php
ob_start();
session_start();
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
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
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
                                        <?php include 'include/painel-login.php'  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <div id="all">
        <div id="content">
            <div class="container box">
                <div class="col-md-6">
                    <div class="">
                        <h3>Inscreva-se</h3>
                        <p class="lead">Siga, curta, seja, mostre a sua moda e seu <font face="segoe Print">e<b>X</b>tilo.</font> </p>
                        
                        <hr>
                        <?php
                        //retorna o que foi preenchido caso ocorra algum erro no cadastro
                            if(isset($_SESSION['resposta'])){
                                if ($_SESSION['resposta'] != 'captcha'){
                                    include_once 'include/resposta.php';
                                }
                            }
                            if(isset($_SESSION['n'])){

                                $nome = $_SESSION['n'];
                                unset($_SESSION['n']);
                            }else{
                                $nome = null;
                            }
                            if(isset($_SESSION['e']))
                            {
                                $email = $_SESSION['e'];
                                unset($_SESSION['e']);
                            }else{
                                $email = null;
                            }
                        ?>
                        <form action="cadastros/addUsuario.php" method="post">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" name="nomeUsuario" id="nomeUsuario" value="<?php echo $nome ?>">
                            </div>
                            <div class="form-group">
                                 <div id="resultado">Email</div> <!-- RESPONDE CASO O EMAIL NÃO FOR VÁLIDO  -->
                                <input type="email" class="form-control" name="" id="informaemail" value="<?php echo $email ?>">
                                <input type="hidden" id="emailUsuario" name="emailUsuario" value="<?php echo $email ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" name="senhaUsuario" id="password">
                            </div>
                            <div class="form-group">
                                <label for="password">Repita a senha</label>
                                <input type="password" class="form-control" name="" id="confirm_password">
                            </div>
                            <div class="form-group">
                                    <img class="img-responsive" src="include/captcha.php" alt="captcha">
                                    <div id="captchaResultado">Digite o código acima</div> <!-- RESPONDE CASO O CAPTCHA NÃO FOR VÁLIDO  -->
                                    <input class="form-control" type="text" name="captcha" id="captcha" required>
                            </div>
                            <label class="small">Ao se cadastrar estará concordando com os <a href="text.html">Termos de uso</a> do site.</label>
                            <div class="text-center">
                                <button type="submit" id="cadastroLogin" disabled="true" class="btn btn-lg btn-block btn-primary"> Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
            <!-- /.container -->
        </div>

        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left">© 2018 eXtilos.com</p>
                </div>
                
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->
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
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <?php include_once 'functions/functions.php'; ?>
    <script type="text/javascript">
          $(document).ready(function(){
                //faz verificação de página no banco de dados
                $("#informaemail").on('keyup focusout',function(){
                    var url = $("#informaemail").val();

                    $.ajax({
                        url: 'include/buscalogin.php',
                        type: 'POST',
                        data: {urlParaMontar:url},
                        beforeSend: function(){
                            $("#resultado").html("");
                        },
                        success: function(data)
                        {
                            $("#resultado").html(data);

                        },
                        error: function(){
                            $("#resultado").html("Erro ao enviar...");
                        }
                    })
                });

            });
    </script>
    <script type="text/javascript">
                         $(document).ready(function(){
                //faz verificação de página no banco de dados
                $("#captcha").on('keyup focusout',function(){
                    var url = $("#captcha").val();

                    $.ajax({
                        url: 'include/captcha.php',
                        type: 'POST',
                        data: {captcha:url},
                        beforeSend: function(){
                            $("#captchaResultado").html("");
                        },
                        success: function(data)
                        {
                            $("#captchaResultado").html(data);

                        },
                        error: function(){
                            $("#captchaResultado").html("Erro ao enviar...");
                        }
                    })
                });

            });
    </script>
    <script type="text/javascript">
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");
        
        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Senhas diferentes!");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
    </script>

</body>
</html>
