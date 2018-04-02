<?php
function torre($idTorre){

?><div class="container-full">
                    <div class="product-slider">
                    <form action="index.php" method="post">
                        <div class="item">
                            <div class="product">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                <div class="text">
                                    <h3>♜ | Nome da Torre</h3>
                                    <input type="hidden" name="torre" value="1">
                                    <input type="submit" class="btn btn-sm btn-block btn-default btn-primary" value="Visitar"> </input>
                                </div>
                                <div class="ribbon sale">
                                    <div class="theribbon"><center>fãs<br>1200</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->

                                <div class="ribbon new">
                                    <div class="theribbon"><center>Visitas<br>+300</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->
                            </div>
                            <!-- /.product -->
                        </div>
                    </form>


                    <form action="index.php" method="post">
                        <div class="item">
                            <div class="product">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                                <div class="text">
                                    <h3>♜ | Nome da Torre</h3>
                                    <input type="hidden" name="torre" value="2">
                                    <input type="submit" class="btn btn-sm btn-block btn-default btn-primary" value="Visitar"> </input>
                                </div>
                                <div class="ribbon sale">
                                    <div class="theribbon"><center>fãs<br>1200</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->

                                <div class="ribbon new">
                                    <div class="theribbon"><center>Visitas<br>+300</center></div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <!-- /.ribbon -->
                            </div>
                            <!-- /.product -->
                        </div>
                    </form>

                    </div>
                    <!-- /.product-slider -->
                </div>
<?php
}
 ?>