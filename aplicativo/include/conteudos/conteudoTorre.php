<?php

if (isset($_POST['torre'])){
$idTorre = $_POST['torre'];
$qtd_post = $_POST['qtdpost'];

$inicio = 0;
$fim = $qtd_post;
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
                                               <img src="imagem/<?php echo $quantasFotos[$g] ?>" alt="" class="img-responsive">
                                           </a>
                                       </div>
                                       <?php
                                   }
                               }
                               ?>
                            </div>
                        </div>
                        <?php
                        $contaRegistro = count($fotos);
                        endwhile;
                        ?>
     			</div>
    			<?php
                if (isset($fotos)){
                    if (!isset($contaRegistro)){
                       	echo '<p class="text-center">Esta torre não tem nenhuma postagem.</p>';
                    }else{
                    if ($contaRegistro > $qtd_post){

                ?>
				<button class="btn btn-sm btn-block btn-default" id="ver" onclick="vermais(); this.style.display = 'none';">ver mais</button>
				<div id="retorno"></div>
                <?php 
                $qtd_registro = $contaRegistro;
                $inicio = $fim;
                $final = $qtd_post;
                ?>
                <input type="hidden" id="inicio" name="inicio" value=<?php echo $inicio ?>>
                <input type="hidden" id="final" name="final" value=<?php echo $final ?>>
                <input type="hidden" id="idtorre" name="idtorre" value=<?php echo $idTorre ?>>
                <input type="hidden" id="qtd" name="qtd" value=<?php echo $qtd_registro ?>>
<?php
						      }
                        } //if $fotos
				}// else

			}// if POST['torre']
		else
			{

?>
		<div class="box">
		<p>Selecione a torre que deseja visualizar</p>
		</div>
<?php
	} // else POST['torre']
?>
 <script type="text/javascript">
                function vermais(){
                    var torre = $("#idtorre").val();
                    var inicio = $("#inicio").val();
                    var fim = $("#final").val();
                    var qtd = $("#qtd").val();
                    $.ajax({
                        url: 'include/conteudos/conteudoTorre2.php',
                        type: 'POST',
                        data: {
                        		torre:torre,
                        		inicio:inicio,
                        		fim:fim,
                                qtd:qtd
                        		},
                        beforeSend: function(){
                            $("#retorno").html("Carregando...");
                        },
                        success: function(data)
                        {
                            $("#retorno").html(data);
                        },
                        error: function(){
                            $("#retorno").html("Erro ao enviar...");
                        }
                    })
                }
    </script>




