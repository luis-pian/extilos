<?php
ob_start();
session_start();

include_once 'functions/iniciar.php';
include_once 'functions/functions.php';
include_once 'functions/conexoes.php';
include_once 'cadastros/caracteres-especiais.php';
include'include/conteudos/topoHtml.php';

?>
<div id="all">
    <div id="content">
        <div class="container-full box">
<!-- SELECIONE A TORRE QUE DESEJA EXIBIR -->
				<?php
				if(isset($_SESSION['idLogado']) && (isset($_POST['emailUsuario']))){
				// Se usuário estiver logado, carregar torres com base em sua preferência
				}else{
				// Se usuário é visitante, carregar aleatóriamente ou o que ele selecionar na busca.
				$preferencia = "Moderno";
				$torre = busca_torre($preferencia);
				?>
				<div id="hot">
				<div class="container-full">
                    <div class="product-slider">
                    <?php while ($resultado_torre = $torre->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
	                    <form action="index.php" method="post">
	                        	<div class="item">
		                            <div class="product">
		                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
		                                <div class="text">
		                                    <h4>♜ | <?php $result = palavracurta($resultado_torre['nomeTorre']); echo $result ?></h4>
		                                    <input type="submit" class="btn btn-sm btn-block btn-default btn-primary" value="Visitar">
		                                    <input type="hidden" name="torre" value=<?php echo $resultado_torre['idTorre'] ?>>
		                                    <input type="hidden" name="qtdpost" value="20">
		                                </div>
		                                <div class="ribbon sale">
		                                    <div class="theribbon"><center>fãs<br>1200</center></div>
		                                    <div class="ribbon-background"></div>
		                                </div>
		                                <div class="ribbon new">
		                                    <div class="theribbon"><center>Visitas<br>+300</center></div>
		                                    <div class="ribbon-background"></div>
		                                </div>
		                            </div>
	                            </div>
	                    </form>
	                  <?php endwhile ?>
                    </div>
                </div>
			</div>
			<?php
			if (isset($_POST['torre'])){
				$topoTorre = $_POST['torre'];
				$topoTorre = topo_torre($topoTorre);
			?>
			<div class="luis" id="customer-order">
                    <div class="box" id="contact">
                        <h2 class="text-center"><?php echo $topoTorre['nomeTorre'] ?></h2>
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

                        <!-- /.panel-group -->
                    </div>
            </div>
			<?php } ?>
<!-- CONTEÚDO DAS TORRES SELECIONADAS ACIMA -->

<?php
//include'include/conteudos/listaTorres.php';
//include_once 'include/conteudos/topoTorre.php';
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
