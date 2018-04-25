<?php

include_once '../conn/init.php';
$PDO = db_connect();

	$resultado = $_POST['urlParaMontar']; //pega conteúdo enviado
	if (filter_var($resultado, FILTER_VALIDATE_EMAIL)){
		$busca = "SELECT * FROM ext_usuarios where  emailUsuario = '$resultado'"; //busca no banco de dados se existe a página
	$categoria = $PDO->query($busca); //monta os dados
	foreach($categoria->fetchAll() as $user): // passa os dados para user
	endforeach; // temina a montagem 
	?>                                                 

	<?php 


// cria condição para página se ela existir ou não

	if(isset($user)){
		
		echo '
		<div class="span4">
			Email:
			<b style="color:#ff9d00">'.$resultado.' | ✘ Email já cadastrado.</b>
			<script>document.getElementById("cadastroLogin").disabled = true;</script>
		</div>

		';

	}else{
		
		echo '
		<div class="span4">
			Email:
			<b style="color:#228B22">'.$resultado.' | ✔</b>
			<input type=hidden name="valida" id="valida" value="1">
			<input type=hidden name="emailUsuario" value="'.$resultado.'">
			<script>document.getElementById("cadastroLogin").disabled = false;</script>
			<script>document.getElementById("emailUsuario").value="'.$resultado.'";</script>
		</div>
		';

	}

}else{
	echo '
		<div class="span4">
			Email:
			<b style="color:#e8091f">'.$resultado.' | ✘</b>
			<script>document.getElementById("cadastroLogin").disabled = true;</script>
		</div>
		';
}

?>	
