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
include_once 'conexoes.php';

$PDO = db_connect();
if(!empty($_POST["keyword"])) {
	$pesquisa = $_POST["keyword"];
	$idPagina = $_POST["idPagina"];
	$pesquisa = sanitizeStringlight($pesquisa);
	$busca = "SELECT * FROM ext_torre WHERE nomeTorre LIKE '%$pesquisa%' LIMIT 5 "; //busca no banco de dados se existe a página
	$categoria = $PDO->prepare($busca); //monta os dados
	$categoria->execute();
	?>
	<div class="veja">

	<?php while ($user = $categoria->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
			<?php if($user>""){
				$nomeTorre = $user['nomeTorre'];
				$cidadeTorre = $user['cidadeTorre'];
				$estadoTorre = $user['estadoTorre'];
				$idTorre = $user['idTorre'];
				$tipoTorre = $user['publicTorre'];

				$consulta = verifica_pg_tr($idPagina, $idTorre);
			?>
			<div class="container-full box torre">
			<img src="img/<?php echo $user['torreImg'] ?>">
				<p><b><?php echo (palavraCurta($nomeTorre)); ?></b></p>
				<?php if($tipoTorre > 0) { //se é 0 a torre é publica, se 1 é privada ?>
					<small>
					<i class="fa fa-map-marker"></i> <?php echo (palavraCurta($cidadeTorre)); echo "-".$estadoTorre; ?> | 
					<i class="fa fa-users"></i> 400 | <i class="fa fa-eye"></i> 400 | 
					<i class="fa fa-unlock"></i>
					</small>
						<?php 
						if($consulta['retorno'] == 'aguarde'){ ?>
						<p>Aguardando aprovação do administrador.</p>
						<?php }
						if($consulta['retorno'] == 'aceito'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="sair" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'livre'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="Participar" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'sair'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="Voltar" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'negado'){ ?>
						<b>Sua página não foi aceita nesta torre.</b>
						<?php }?>

					<label id="torre<?php echo $idTorre ?>"></label>
				<?php }else{ ?>
					<small>
					<i class="fa fa-map-marker"></i> <?php echo $cidadeTorre; echo "-".$estadoTorre; ?> | 
					<i class="fa fa-users"></i> 400 |
					<i class="fa fa-eye"></i> 400 |
					<i class="fa fa-lock"></i>
					</small>
						<?php 
						if($consulta['retorno'] == 'aguarde'){ ?>
						<p>Aguardando aprovação do administrador.</p>
						<?php }
						if($consulta['retorno'] == 'aceito'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="sair" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'livre'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="Participar" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'sair'){ ?>
						<input onclick="addTorre(<?php echo $idTorre ?>)" class="btn btn-sm btn-block btn-default" value="Voltar" id="<?php echo $idTorre ?>">
						<?php }
						if($consulta['retorno'] == 'negado'){ ?>
						<b>Sua página não foi aceita nesta torre.</b>
						<?php }?>

					<label id="torre<?php echo $idTorre ?>"></label>
				<?php } ?>
			</div>
	<?php
		}endwhile;
	}?>
	</div>

