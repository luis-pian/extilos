<?php
ob_start();
session_start();

include_once 'functions/iniciar.php';
include_once 'functions/functions.php';
include_once 'functions/conexoes.php';
include'include/conteudos/topoHtml.php';

?>
<div id="all">
            <div id="content">
                <div class="container-full box">
<?php

if(isset($_SESSION['idLogado']) && (isset($_POST['emailUsuario']))){
// USUÁRIOS LOGADOS VAI CARREGAR CONTEÚDO DE ACORDO COM AS SUAS PREFERENCIAS

}else{
// USUÁRIOS VISITANTES

include'include/conteudos/listaTorres.php';
include_once 'include/conteudos/topoTorre.php';
include_once 'include/conteudos/bannerTorre.php';
include_once 'include/conteudos/conteudoTorre.php';
?>
				</div>
                <a href="#" class="btn btn-sm btn-default btn-block btn-secundary" data-spy="affix" data-offset-top="500">♜| Nome da Torre - <b>Voltar ao Inicio</b></a>
                <!-- END CONTAINER -->
        </div>
</div>

<?php
include_once 'include/conteudos/fimHtml.php';
}



?>
