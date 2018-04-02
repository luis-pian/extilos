<?php
ob_start();
session_start();
//verifica se usuario está logado para acessar a página
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resposta'] = 'registrar';
    header("Location: register.php"); exit;
}
//INCLUI AS FUNÇÕES NECESSÁRIAS
include_once 'functions/validar.php';
include_once 'functions/conexoes.php';
include_once 'include/modal.php';

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
                <!-- CONTEÚDO DA PÁGINA -->
                <div class="" id="customer-order">
                    <a type="button" class="" data-toggle="modal" data-target="#modal-cadastro">
                        <i class="pull-right fa fa-align-justify"></i></a>
                        <h4>Cadastro básico</h4>
                        <p class="text-muted">Página de postagens gratuíta.</p>
                        <?php
                        if (isset($_SESSION['resposta'])){
                          include "include/resposta.php";
                      }
                      ?>
                      <form action="cadastros/pagina-gratuita.php" method="post" enctype="multipart/form-data">
                        <div class='input-wrapper'>
                            <hr>
                            <div class="form-group">
                                <div id="resultado">Nome da Página</div> 
                                <input type="text" class="form-control" name="pagina" id="pagina" placeholder="Ex: minha_pagina" pattern="[a-z\s]+$" required>
                            </div>

                            <div class="form-group">
                                <label for="marca">Sobre a Página </label>
                                <textarea type="text" class="form-control" name="descPagina" id="descPagina" placeholder="" rows="3"></textarea>
                            </div>
                            <div class ="form-group">
                                <label for="estado">Estado</label>
                                <select name="estadoPagina" id="estados" class="form-control" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class ="form-group">
                                <label for="cidade">Cidade</label>
                                <select name="cidadePagina" id="cidades" class="form-control" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="emailPagina" id="emailPagina" required>
                            </div>
                            <hr>
                            <input type="submit" class="btn btn-lg btn-block btn-primary" name='criarPagina' id="criarPagina" value="CRIAR PÁGINA" disabled="true">
                            <hr>
                        </div>
                    </form>
                </div>
                <button type="button" id="pagSeguro" disabled="true" class="btn btn-lg btn-block btn-primary" onclick="pagseguro()">PAGAR</button>

                <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                <form id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
                    <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                    <input type="hidden" name="code" id="code" value="" />

                </form>
                <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
                <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->

            </div>
        </div>
        <?php include_once 'include/rodape.php' ?>
    </div>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script src="js/jquery.textcomplete.js"></script>
    <script type="text/javascript">
       function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';

    }
    function Mudarestado1(el) {
        var display = document.getElementById(el).style.display;
        if(display == "block")
            document.getElementById(el).style.display = 'none';
        else
            document.getElementById(el).style.display = 'none';

    }
    function pagseguro(){
     $.post("pagseguro2.php",'',function(data){
                                        //$('#code').val(data);
                                        //$('#comprar').submit();
                                        window.location.href = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='+data;
                                    })
 }
</script>
    <script type="text/javascript">
         $(document).ready(function(){
                //faz verificação de página no banco de dados
                $("#pagina").on('keyup focusout',function(){
                    var pagina = $("#pagina").val();
                    $.ajax({
                        url: 'functions/consulta-pagina.php',
                        type: 'POST',
                        data: {nomePagina:pagina},
                        beforeSend: function(){
                            $("#resultado").html("Carregando...");
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
        $(document).ready(function () {
        
            $.getJSON('/extilos/aplicativo/script/estados_cidades.json', function (data) {
                var items = [];
                var options = '<option value="">escolha um estado</option>';    
                $.each(data, function (key, val) {
                    options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
                });                 
                $("#estados").html(options);                
                
                $("#estados").change(function () {              
                
                    var options_cidades = '';
                    var str = "";                   
                    
                    $("#estados option:selected").each(function () {
                        str += $(this).text();
                    });
                    
                    $.each(data, function (key, val) {
                        if(val.sigla == str) {                           
                            $.each(val.cidades, function (key_city, val_city) {
                                options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                            });                         
                        }
                    });
                    $("#cidades").html(options_cidades);
                    
                }).change();        
            
            });
        
        });
    </script>

</body>
</html>
