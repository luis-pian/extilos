<?php
function torre($preferencia){
$torre = busca_torre($preferencia);
?><div class="container-full">
                    <div class="product-slider">
                    <?php while ($resultado_torre = $torre->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                        <form action="index.php" method="post">
                                <div class="item">
                                    <div class="product">
                                        <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                        <div class="">
                                            <h3>♜ | <?php echo $resultado_torre['nomeTorre'] ?></h3>
                                            <input type="submit" class="btn btn-sm btn-block btn-default btn-primary" value="Visitar">
                                            <input type="hidden" name="torre" value="1">
                                        </div>
                                        <div class="ribbon sale">
                                            <div class="theribbon"><center>fãs<br>1200</center></div>
                                            <div class="ribbon-background"></div>
                                        </div>
                                        <!-- /.ribbon -->

                                        <div class="ribbon new">
                                            <div class="theribbon"><center>Visitas<br>+3000</center></div>
                                            <div class="ribbon-background"></div>
                                        </div>
                                        <!-- /.ribbon -->
                                    </div>
                                <!-- /.product -->
                                </div>
                        </form>
                      <?php endwhile ?>

                    </div>
                    <!-- /.product-slider -->
                </div>

<?php
}
 ?>