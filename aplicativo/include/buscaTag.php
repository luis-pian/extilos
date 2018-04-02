<?php
ob_start();
session_start();
//verifica se usuario está logado para acessar a página
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resp'] = 'negado';
    header("Location: login.php"); exit;
} 
include_once '../conn/init.php';
include_once '../cadastros/caracteres-especiais.php';
$PDO = db_connect();
// recebe informação do enviar-fotos.js para mostrar as opçoes de # e @.
// Precisa implementar o autopreenchimento !
	$resultadoPost = isset($_POST['marcacao']) ? $_POST['marcacao'] : "0" ; //pega conteúdo enviado	
//opção de consulta por #
	$resultado = explode("#", $resultadoPost);
			if (isset($resultado[1])){
								$n_palavras = count($resultado);
								for ($k=1 ; $k<$n_palavras ; $k++)
								{
									$separaPalavras[$k] = preg_split('/ /', $resultado[$k], -1);
								}

								$contaPalavra = count($separaPalavras);
								for ($v=1; $v<=$contaPalavra; $v++)
								{
									$novaHashtag[$v] = "#".sanitizeString($separaPalavras[$v][0]);
								}
								$ultimo = end($novaHashtag);

							$busca = "SELECT DISTINCT nomeTag FROM ext_tag WHERE nomeTag LIKE '$ultimo%' ORDER BY idTag LIMIT 5 "; //busca no banco de dados se existe a página
							$categoria = $PDO->prepare($busca); //monta os dados
							$categoria->execute();
							?>

							<?php while ($user = $categoria->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
								<?php if($_POST>""){ ?>
								<small><?php echo $user['nomeTag']?></small>
								<?php
							}endwhile;
						}

// opção de consulta por @
	$resultado2 = explode("@", $resultadoPost);
	$idUsuario = $_SESSION['idLogado'];
	$meuArroba = $_SESSION['arroba'];
	if (isset($resultado2[1]))
			{
				$n_palavras2 = count($resultado2);

				for ($k2=1 ; $k2<$n_palavras2 ; $k2++)
				{
					$separaPalavras2[$k2] = preg_split('/ /', $resultado2[$k2], -1);
				}

				$contaPalavra2 = count($separaPalavras2);
				for ($v2=1; $v2<=$contaPalavra2; $v2++)
				{
					$novaHashtag2[$v2] = "@".sanitizeString($separaPalavras2[$v2][0]);
					
				}

				$ultimo2 = end($novaHashtag2);

				$busca2 = "SELECT nomeArroba1, nomeArroba2 FROM ext_amigos  
				WHERE ((nomeArroba1 LIKE '$ultimo2%') or (nomeArroba2 LIKE '$ultimo2%')) 
				AND (idUsuario1 = $idUsuario or idUsuario2 = $idUsuario) 
				ORDER BY RAND() LIMIT 5 "; //busca no banco de dados se existe a página
				$categoria2 = $PDO->prepare($busca2); //monta os dados
				$categoria2->execute();
				?>

				<?php while ($user2 = $categoria2->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
					<?php if($_POST>""){ 
						//resultado na primeira condição
						if ($user2['nomeArroba1'] != $meuArroba){
							$imprime1 = $user2['nomeArroba1'];
							$imprime1 = substr($imprime1, 0,-1);
						}
						else{$imprime1 = '';}
						//resultado na segunda condição
						if ($user2['nomeArroba2'] != $meuArroba){
							$imprime2 = $user2['nomeArroba2'];
							$imprime2 = substr($imprime2, 0,-1);
						}
						else{$imprime2 = '';}
						?>
					<small><?php echo $imprime1 ?></small>
					<small><?php echo $imprime2 ?></small>
					<?php
				}endwhile;
			}
?>

