<?php
ob_start();
session_start();

include_once '../conn/init.php';
include_once '../cadastros/caracteres-especiais.php';
include_once 'conexoes.php';
//recebe informação da página e o usuário desejado
if (isset($_POST['adm'])){
	$usuario = $_POST['adm'];
	$idPagina = $_POST['idPagina'];

	$PDO = db_connect();
	$busca = "SELECT * FROM ext_fans WHERE idPagina = $idPagina and arrobaUsuario LIKE '%$usuario%' LIMIT 5 ";
	$usuario = $PDO->prepare($busca); //monta os dados
	$usuario->execute();
	?>
	<div class="box pesquisa">
	<?php	while ($user = $usuario->fetch(PDO::FETCH_ASSOC)): ?>
		<input onclick="permitir('<?php echo $idPagina ?>','<?php echo $user['idUsuario'] ?>')" class="form-control" value="<?php echo $user['arrobaUsuario'] ?>">
	<?php endwhile; ?>
	</div>
<?php } ?>
<?php
if(isset($_POST['user'])){
	$idUsuario = $_POST['user'];
	$idPagina = $_POST['pagina'];
	$tipoPagina = $_POST['tipoPagina'];
	if($tipoPagina > 0){
		$limitAdm = '50';
	}else{
		$limitAdm = '3';
	}
	$quantAdm = adm_total($idPagina);
	$PDO = db_connect();
	$sql = "SELECT * FROM ext_usuarios WHERE idUsuario = $idUsuario";
	$stmt = $PDO->prepare($sql);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$nome = $user['nomeUsuario'];
	$arroba = $user['usuMarca'];
	$usuCadastrado = usuarioAdm($idPagina, $idUsuario);
	if($usuCadastrado > ''){
		if($usuCadastrado['pm_post']>0){$post = '1.';$checkPost = 'checked';}else{$checkPost = '';$post = '';}
                              if($usuCadastrado['pm_editar']>0){$editar = '2.';$checkEditar = 'checked';}else{$checkEditar = '';$editar = '';}
                              if($usuCadastrado['pm_excluir']>0){$excluir = '3.';$checkExcluir = 'checked';}else{$checkExcluir = '';$excluir = '';}
                              if($usuCadastrado['pm_cadastro']>0){$cadastro = '4.';$checkCadastro = 'checked';}else{$checkCadastro = '';$cadastro = '';}
                              if($usuCadastrado['pm_financeiro']>0){$financeiro = '5.';$checkFinanceiro = 'checked';}else{$checkFinanceiro = '';$financeiro = '';}
		$nivel = ($post.$editar.$excluir.$cadastro.$financeiro);
		?>
		<div id="respostaUser">
		<label for="city">Permisões do usuário</label>
		<p><?php echo $arroba ?><label for="city"> (Adm nível: <?php echo $nivel ?>)</label></p>
		<a onclick="permisoes()" class="btn btn-sm btn-block btn-default">Editar Permisões</a>
		</div>
		<div id="permitir" style="display:none">
                      <div class="form-group">
                          <input type="hidden" name="codigoAdm" id="codigoAdm" value="2">
						  <input type="hidden" id="nomeUser" name="nomeUser" value="<?php echo $idUsuario ?>">
                          <input type="hidden" name="idPagina" id="idPagina" value="<?php echo $idPagina ?>">
                          <input type="hidden" name="idPermite" id="idPermite" value="<?php echo $usuCadastrado['idPermite'] ?>">
                          <p>Você permite este adm a realizar quais tarefas nesta página:</p>
                          <div class="switch__container">
                          <small>Postar Fotos e Contúdos.</small>
                          <input id="post" class="switch switch--shadow" name="post" type="checkbox" value="1" <?php echo $checkPost ?>>
                          <label for="post"></label>
                          </div>
                          <div class="switch__container">
                          <small>Editar configurações da página.</small>
                          <input id="editar" class="switch switch--shadow" name="editar" type="checkbox" value="1" <?php echo $checkEditar?>>
                          <label for="editar"></label>
                          </div>
                          <div class="switch__container">
                          <small>Excluir postagens, fãs e conteúdos.</small>
                          <input id="excluir" class="switch switch--shadow" name="excluir" type="checkbox" value="1" <?php echo $checkExcluir?>>
                          <label for="excluir"></label></div>
                          <div class="switch__container">
                          <small>Cadastrar em Torres e Publicidades.</small>
                          <input id="cadastro" class="switch switch--shadow" name="cadastro" type="checkbox" value="1" <?php echo $checkCadastro ?>>
                          <label for="cadastro"></label></div>
                          <div class="switch__container">
                          <small>Administrar assuntos financeiros.</small>
                          <input id="financeiro" class="switch switch--shadow" name="financeiro" type="checkbox" value="1" <?php echo $checkFinanceiro?>>
                          <label for="financeiro"></label>
                          </div>
                      </div>
                    </div>
                     <div class="col-sm-12 text-center torre" id="permitirBotao" style="display:none">
                      <a onclick="cancelaUser()" class="btn btn-sm btn-block btn-default">Cancelar</a>
                      <input onclick="cadastrarUser()" class="btn btn-sm btn-block upload" value="Atualizar">
                      <div id="atualizado"></div>
                </div>
	<?php }else{ ?>
		<div id="respostaUser">
		<?php if($quantAdm >= $limitAdm){ ?>
		<p>Ops! O limite de administradores foi atingido</p>
		<label for="city">É permitido no máximo 03 administradores para o blog gratuíto e 20 para o blog profissinal. </label>
        <a onclick="cancelaUser()" class="btn btn-sm btn-block btn-default">Voltar</a>
		<?php }else{ ?>
		<label for="city">Permisões do usuário</label>
		<p><?php echo $arroba ?></p>
		<a onclick="permisoes()" class="btn btn-sm btn-block btn-default">Add Permisões</a>
		</div>
		<div id="permitir" style="display:none">
                      <div class="form-group">
                          <input type="hidden" name="codigoAdm" id="codigoAdm" value="1">
						  <input type="hidden" id="nomeUser" name="nomeUser" value="<?php echo $idUsuario ?>">
                          <input type="hidden" name="idPagina" id="codigoAdm" value="<?php echo $idPagina ?>">
                          <p>Você permite este adm a realizar quais tarefas nesta página:</p>
                          <div class="switch__container">
                          <small>Postar Fotos e Contúdos.</small>
                          <input id="post" class="switch switch--shadow" name="post" type="checkbox" value="1" >
                          <label for="post"></label>
                          </div>
                          <div class="switch__container">
                          <small>Editar configurações da página.</small>
                          <input id="editar" class="switch switch--shadow" name="editar" type="checkbox" value="1" >
                          <label for="editar"></label>
                          </div>
                          <div class="switch__container">
                          <small>Excluir postagens, fãs e conteúdos.</small>
                          <input id="excluir" class="switch switch--shadow" name="excluir" type="checkbox" value="1" >
                          <label for="excluir"></label></div>
                          <div class="switch__container">
                          <small>Cadastrar em Torres e Publicidades.</small>
                          <input id="cadastro" class="switch switch--shadow" name="cadastro" type="checkbox" value="1" >
                          <label for="cadastro"></label></div>
                          <div class="switch__container">
                          <small>Administrar assuntos financeiros.</small>
                          <input id="financeiro" class="switch switch--shadow" name="financeiro" type="checkbox" value="1" >
                          <label for="financeiro"></label>
                          </div>
                      </div>
                    </div>
                     <div class="col-sm-12 text-center torre" id="permitirBotao" style="display:none">
                      <a onclick="cancelaUser()" class="btn btn-sm btn-block btn-default">Cancelar</a>
                      <input onclick="cadastrarUser()" class="btn btn-sm btn-block upload" value="Cadastrar">
                      <div id="atualizado"></div>
                </div>
		<?php
		}
	}
	}
?>