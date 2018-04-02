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
$idTorre = 1;
$inicio = 2;
$fim = 7;

//$total = inicio_total($idTorre);

$albumImagemResposta = banco_inicio($idTorre, $inicio, $fim);
?>

<div id="wishlist">
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
                                               <img src="/extilos/aplicativo/imagem/<?php echo $quantasFotos[$g] ?>" alt="" class="img-responsive">
                                           </a>
                                       </div>
                                       <?php
                                   }
                               }
                               ?>
                            </div>
                        </div>
                        <?php endwhile;
                        ?>
                    </div>
                    <button  class="btn btn-sm btn-block btn-primary" onclick="carregamais()">Carregar mais...</button>

<!-- PRECISA DE ATENÇÃO PARA RESOLVER ESSE PROBLEMA -->
<script src="/extilos/aplicativo/js/jquery-1.11.0.min.js"></script>
<script src="/extilos/aplicativo/js/jquery.cookie.js"></script>
<script src="/extilos/aplicativo/js/waypoints.min.js"></script>
<script src="/extilos/aplicativo/js/front.js"></script>
<script src="/extilos/aplicativo/js/owl.carousel.min.js"></script>
<!-- essa parte esta me causando um aleta no console, porque ele esta carregando os scripts dentro do body (precisa resolver isso de uma outra forma)
referencia para estudo https://pt.stackoverflow.com/questions/97354/erro-synchronous-xmlhttprequest-on-the-main-thread-is-deprecated

Console: Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental effects to the end user's experience.
Porque: As tags <script> com atributo src dentro do <body> também podem causar problemas (se estiver dentro do <head> não há problema). O motivo é que no meio do carregamento da página, quando a página já renderizou pela metade, o navegador é obrigado a parar e baixar um script do servidor, ocasionando o mesmo problema do AJAX síncrono.-->