<?php

include_once '../cadastros/caracteres-especiais.php';
include_once '../conn/init.php';
$PDO = db_connect();

			$resultado = $_POST['nomeBusca'];
			$album = $_POST['album'];
			$resultadoUsuario = explode('@', $resultado);
			$resultadoConta = strlen($resultado);
			if (isset($resultadoUsuario[1]))
			{
					if ($resultadoConta > 2)
				{
					$resultado = sanitizestring($resultado);
					$busca2 = "SELECT * FROM ext_usuarios  
					WHERE usuMarca LIKE '%$resultado%'
					ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
					$categoria2 = $PDO->prepare($busca2); //monta os dados
					$categoria2->execute();
					?>
					<?php while ($user2 = $categoria2->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
						<?php if(isset($user2)){ 
							?>
						<small>Usuário : <?php echo $user2['nomeUsuario'] ?></small><br>

						<?php
					}endwhile;
				}
			}
			else
			{
				if ($resultadoConta > 2)
				{
					$resultado = sanitizestring($resultado);
						$busca1 = "SELECT * FROM img_usuarios
						WHERE usuTitulo LIKE '%$resultado%'
						ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
						$categoria1 = $PDO->prepare($busca1); //monta os dados
						$categoria1->execute();

						echo ' <div class="table-responsive">
                                    <table class="table">';
						?>

						<?php while ($user1 = $categoria1->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
							<?php if(isset($user1)){
								$foto = $user1['img'];
								$titulo = $user1['usuTitulo'];
								$texto = $user1['usuMarca'];
								$usuario = $user1['arrobaUsuario'];
								$tamanhoTexto = strlen($texto);
								if ($tamanhoTexto > 200)
								{
									$texto = mb_strimwidth($user1['usuMarca'], 0, 200).'...';
								}else{
									$texto = $user1['usuMarca'];
								}
                                echo '
                                <tbody>'.$album.'
	                                <tr>
	                                <td bgcolor="#4ea8d8">
                                        </td>
	                                	<td style="white-space: initial" bgcolor="#e5e5e5">
	                                	<img src="/extilos/aplicativo/imagem/'.$user1['img'].'" class="img-rounded img-responsive">
                                        </td>
                                        <td style="white-space: initial" bgcolor="#fcfcfc">
                                        <a href="#">'.$user1['usuTitulo'].'</a><br><h6>'.$texto.'<br>By: <a>'.$usuario.'</a></h6>
                                        </td>
                                    </tr>
	                            </tbody> ';  
                               ?>
							<?php
						}endwhile;


						$busca2 = "SELECT * FROM img_usuarios
						WHERE usuEstilo LIKE '%$resultado%'
						ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
						$categoria2 = $PDO->prepare($busca2); //monta os dados
						$categoria2->execute();

						?>
						<?php while ($user2 = $categoria2->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
							<?php if(isset($user2)){
								$foto2 = $user2['img'];
								$titulo2 = $user2['usuTitulo'];
								$texto2 = $user2['usuMarca'];
								$tamanhoTexto2 = strlen($texto2);
								if ($tamanhoTexto2 > 200)
								{
									$texto2 = mb_strimwidth($user2['usuMarca'], 0, 200).'...';
								}else{
									$texto2 = $user2['usuMarca'];
								}

                                echo '
                                <tbody>
	                                <tr>
	                                <td bgcolor="#d84e4e">
                                        </td>
	                                	<td style="white-space: initial" bgcolor="#e5e5e5">
	                                	<img src="/extilos/aplicativo/imagem/'.$foto2.'"  class="img-rounded img-responsive">
                                        </td>
                                        <td style="white-space: initial" bgcolor="#fcfcfc">
                                        <a href="#">'.$titulo2.'</a><br><h6>'.$texto2.'</h6>
                                        </td>                                        
                                    </tr>
	                            </tbody> ';
						}endwhile;


						$busca3 = "SELECT * FROM ext_paginas
						WHERE nomePagina LIKE '%$resultado%'
						ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
						$categoria3 = $PDO->prepare($busca3); //monta os dados
						$categoria3->execute();
						?>
						<?php while ($user3 = $categoria3->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
							<?php if(isset($user3)){
								//$foto3 = $user3['img'];
								$titulo3 = $user3['nomePagina'];
								$texto3 = $user3['descPagina'];
								$tamanhoTexto3 = strlen($texto3);
								if ($tamanhoTexto3 > 200)
								{
									$texto3 = mb_strimwidth($user3['descPagina'], 0, 200).'...';
								}else{
									$texto3 = $user3['descPagina'];
								}
								echo '
                                <tbody>
	                                <tr>
	                                <td bgcolor="#2e9b30">
                                        </td>
	                                	<td>
	                                	</td>
                                        <td style="white-space: initial"><a href="#">'.$titulo3.'</a><br><h6>'.$texto3.'</h6>
                                        </td>
                                    </tr>
	                            </tbody> ';
						}endwhile;

						$busca4 = "SELECT * FROM ext_torre
						WHERE nomeTorre LIKE '%$resultado%'
						ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
	 					$categoria4 = $PDO->prepare($busca4); //monta os dados
						$categoria4->execute();
						?>
						<?php while ($user4 = $categoria4->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
							<?php if(isset($user4)){
								//$foto3 = $user3['img'];
								$titulo4 = $user4['nomeTorre'];
								$texto4 = $user4['descTorre'];
								$tamanhoTexto4 = strlen($texto4);
								if ($tamanhoTexto4 > 200)
								{
									$texto4 = mb_strimwidth($user4['descTorre'], 0, 200).'...';
								}else{
									$texto4 = $user4['descTorre'];
								}
								echo'
								<tbody>
	                                <tr>
	                                <td bgcolor="#d1c821">
                                        </td>
	                                <td>
	                                </td>
                                        <td style="white-space: initial"><a href="#">'.$titulo4.'</a><br><h6>'.$texto4.'</h6>
                                        </td>
                                    </tr>
	                            </tbody> ';
						}endwhile;

						echo '</table>
						</div>';
				}
			}
			?>