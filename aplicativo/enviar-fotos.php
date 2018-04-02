<?php
ob_start();
session_start();
//verifica se usuario está logado para acessar a página
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['respesposta'] = 'negado';
    header("Location: login.php"); exit;
} 
//abre a conexão com banco de dados
require_once 'conn/init.php';
$PDO = db_connect();
//puxa da session o id do usuario
$idLogado = $_SESSION['idLogado'];
//carrega as informações necessárias do banco para a página
$sql = "SELECT idAlbum, album FROM album_usuarios where idUsuario = $idLogado order by RAND() asc";
$stmt = $PDO->prepare($sql);
$stmt->execute();

//carrega as informações necessárias do banco para a página
$sql_pagina = "SELECT * FROM ext_paginas where idUsuario = $idLogado OR idUsuario2 = $idLogado OR idUsuario3 = $idLogado order by nomePagina asc";
$stmt_pagina = $PDO->prepare($sql_pagina);
$stmt_pagina->execute();

$corBotao = 2;

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
              <!-- TOPO DA ÁREA DO APLICATIVO -->
              <div class="navbar-header">
                <a class="navbar-brand home" href="index.html" data-animate-hover="bounce">
                    <img src="imagem/extilos_preto.png" alt="eXtilos.com" class="img-responsive">
                    <div class="navbar-buttons">
                        <div class="col-md-6" data-animate="fadeInDown">
                            <a type="button" class="navbar-toggle" data-toggle="modal" data-target="#login-modal">
                             <span class="sr-only">Nav</span>
                             <i class="fa fa-align-justify"></i>
                         </a>
                     </div>
                     <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="Login">Painel de Imagens</h4>
                                </div>
                                <div class="modal-body">
                                    <?php include 'include/painel-fotos.php'  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TOPO DA ÁREA DO APLICATIVO -->
            <hr>
            <!-- CONTEÚDO DA PÁGINA -->
            <div class="" id="customer-order">
              <h4>Postar fotos</h4>
              <p class="text-muted">Carregue até 5 fotos para cada extilo.</p>
              <?php
              if(isset($_SESSION['imagem'])){
                include_once 'include/resposta.php';
            }
            ?>
            <form action="cadastros/upload-fotos.php" method="post" enctype="multipart/form-data">
                <div class='input-wrapper'>
                    <label for='upload_file' class="upload">Selecionar fotos &#187;</label>
                    <input type="file" id="upload_file" name="imagem[]" onchange="preview_image();" multiple size="5" class="upload_file" accept="image/jpeg, image/png, image/jpg," />
                    <input id='upload_file' type='file' value='' />
                    <span id='file-name'></span>
                    <div class="foto" id="qtde_preview"></div>
                    <hr>
                    <div class="form-group">
                        <label for="name">Álbum</label>
                        <select class="form-control" name="usuEstilo" id="estilo" required>
                            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): //LISTA NOME DOS ALBUNS ?>
                                <?php $nomeAlbum = $user['album']; $idAlbum = $user['idAlbum'];?>
                                <option value="<?php echo $nomeAlbum ?>"><?php echo $nomeAlbum ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Título</label>
                        <input type="text" class="form-control" name="usuTitulo" id="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="marca">Descrição </label>
                        <textarea type="text" class="form-control" name="usuMarca" id="marcacao" placeholder="Marcação: #paginas | @pessoas" rows="5"></textarea>
                        <div id="resultadohashPag"></div>
                    </div>

                    <div class="form-group">
                        <label for="marca">Publicar em qual página? </label>
                        <?php while ($pagina = $stmt_pagina->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
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
<div id="copyright">
   <div class="container">
      <div class="col-md-12">
         <p class="pull-left">© 2018 eXtilos.com</p>
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
