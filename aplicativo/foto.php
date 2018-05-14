<?php
ob_start();
session_start();
//verifica se usuario está logado para acessar a página
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['respesposta'] = 'negado';
    $_SESSION['retorno'] = 'foto.php';
    header("Location: login.php"); exit;
} 
//abre a conexão com banco de dados
require_once 'conn/init.php';
require_once 'functions/conexoes.php';
$PDO = db_connect();
//puxa da session o id do usuario
$idLogado = $_SESSION['idLogado'];
//carrega as informações necessárias do banco para a páginas
$usuarioAlbum = usuario_album($idLogado);
//carrega as informações necessárias do banco para a página
$usuarioPagina = usuario_pagina($idLogado);

$corBotao = 2;

if ($corBotao == 1){
	$corBotao = 'css/style.blue.css';
}else{
	$corBotao = 'css/style.mono.css';
}
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
    <link href="css/meu.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">
</head>

<body>
    <div id="all">
        <div id="content">
            <div class="container box">
            <!-- CONTEÚDO DA PÁGINA -->
            <div class="" id="customer-order">
            <a type="button" class="" data-toggle="modal" data-target="#modal-fotos">
              <i class="pull-right fa fa-align-justify"></i></a>
              <h4>Publicar contúdo</h4>
              <p class="text-muted">Carregue até 5 fotos.</p>
              <?php
              if(isset($_SESSION['imagem'])){
                include_once 'include/resposta.php';
            }
            ?>
            <form action="cadastros/upload-fotos.php" method="post" enctype="multipart/form-data">
                <div class='input-wrapper'>
                    <div class="form-group">
                        <label for="subject">Título</label>
                        <input type="text" class="form-control" name="usuTitulo" id="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="marca">Descrição </label>
                        <textarea type="text" class="form-control" name="usuMarca" id="marcacao" placeholder="Marcação: #paginas | @pessoas" rows="5"></textarea>
                        <div id="resultadohashPag"></div>
                    </div>
                    <label for='upload_file' class="upload">Selecionar fotos</label>
                    <input type="file" id="upload_file" name="imagem[]" onchange="preview_image();" multiple size="5" class="upload_file" accept="image/jpeg, image/png, image/jpg,"/>
                    <input id='upload_file' type='file' value='' />
                    <span id='file-name'></span>
                    <div class="foto" id="qtde_preview"></div>
                    <hr>
                    <?php if(isset($_SESSION['usuProf'])){
                        if($_SESSION['usuProf'] == 'sim'){
                            ?>
                    <div class="form-group">
                     <input data-toggle="collapse" class="btn btn-sm btn-block btn-default" data-parent="#accordion" href="#faq1" value="Adicionar preços e condições">
                     </div>
                    <div id="faq1" class="panel-collapse collapse">
                        <label for="subject">Preço Normal</label>
                        <input type="text" class="form-control" name="precPro" >
                        <label for="subject">Preço com Desconto</label>
                        <input type="text" class="form-control" name="descPro" >
                        <label for="subject">Forma de Pagamento</label>
                        <select class="form-control" name="formaPro">
                        <option value="0">Selecione</option>
                        <option value="1" >Dinheiro</option>
                        <option value="2" >Dinheiro / Débito</option>
                        <option value="3" >Dinheiro / Débito / Crédito</option>
                        <option value="4" >Dinheiro / Débito / Crédito / Boleto</option>
                        <option value="5" >A combinar</option>
                        </select>
                        <label for="subject">Informação complementar</label>
                        <textarea type="text" class="form-control" name="infoPro" id="subject" rows="2" ></textarea>
                    </div>
                    <hr>
                    <?php }
                    } ?>
                    <label class="text-center">Look</label>
                    <div class="switch__container">
                    <p>Masculino</p>
                    <input id="masculino" class="switch switch--shadow" name="masculino" type="checkbox" value="1" >
                    <label for="masculino"></label>
                    </div>
                    <div class="switch__container">
                    <p>Feminino</p>
                    <input id="feminino" class="switch switch--shadow" name="feminino" type="checkbox" value="1" >
                    <label for="feminino"></label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="name">Qual estilo?</label>
                        <select class="form-control" name="usuEstilo" id="estilo" required>
                            <?php while ($user = $usuarioAlbum->fetch(PDO::FETCH_ASSOC)): //LISTA NOME DOS ALBUNS ?>
                                <?php $nomeAlbum = $user['album']; $idAlbum = $user['idAlbum'];?>
                                <option value="<?php echo $nomeAlbum ?>"><?php echo $nomeAlbum ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="marca">Publicar em qual página? </label>
                        <?php while ($pagina = $usuarioPagina->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                            <?php   $nomePagina = $pagina['nomePagina']; 
                            $idPagina = $pagina['idPagina'];
                            ?>
                            <div class="form-group">
                                <div class="switch__container">
                                    <p><?php echo $nomePagina ?></p>
                                    <input id="<?php echo $nomePagina ?>" class="switch switch--shadow" name="check_list[]" type="checkbox" value="paginaPHP">
                                    <label for="<?php echo $nomePagina ?>"></label>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="form-group">
                        <label for="marca">Publicar na torre? </label>
                        <div class="switch__container">
                            <p>Nome da torre</p>
                            <input id="torre" class="switch switch--shadow" name="torre" type="checkbox" value="1">
                            <label for="torre"></label>
                        </div>
                    </div>
                    <hr>
                    <input type="submit" class="btn btn-lg btn-block btn-primary" name='submit_image' value="PUBLICAR">
                    <hr>
                    <div class="foto" id="image_preview"><font color="cccccc">Nenhuma foto foi selecionada </font></div>
                </div>
            </form>
        </div>
        <!-- CONTEÚDO DA PÁGINA -->

    </div>
</div>
</div>

<!-- *** COPYRIGHT END *** -->
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
<script src="script/enviar-fotos.js"></script>


</body>

</html>
