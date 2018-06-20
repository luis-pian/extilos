<?php
session_start();
require_once '../conn/init.php';
require_once '../functions/conexoes.php';

if(isset($_POST['torre'])){
	$torre = $_POST['torre'];
	$pagina = $_POST['pagina'];
	$consulta = verifica_pg_tr($pagina, $torre);
	$idPgTorre = $consulta['idPgTorre'];
	if ($consulta['ativar'] > 0){
		$pgAtivar = "0";
	}else{
		$pgAtivar = "1";
	}
			$PDO = db_connect();
			$sql = "UPDATE ext_pg_tr SET pgAtivar = :pgAtivar WHERE idPgTorre=:idPgTorre";
			$stmt= $PDO->prepare($sql);
			$stmt->bindParam(':pgAtivar', $pgAtivar);
			$stmt->bindParam('idPgTorre', $idPgTorre);
			$stmt->execute();
	
}

if(isset($_POST['idTorre'])){
$idTorre = $_POST['idTorre'];
$idPagina = $_POST['idPagina'];

//CONSULTA PARA VERIFICAR SE JÁ FOI REALIZADA A SOLICITAÇÃO
$consulta = verifica_pg_tr($idPagina, $idTorre);
$idPgTorre = $consulta['idPgTorre'];
	if($consulta['retorno'] == 'livre'){ // 'LIVRE' - É A PRIMEIRA SOLICITAÇÃO DA PÁGINA A TORRE, ENTÃO É FEITO O PRIMEIRO CADASTRO DAS INFORMAÇOES
	//FAZER CONSULTA DAS REQUISIÇÕES DA TORRE NO BANCO DE DADOS
	$resultado = topo_torre($idTorre);
	$tipoTorre = $resultado['publicTorre'];
	$pgPermite = $resultado['permiteTorre'];
	if($tipoTorre > 0){
		$pgSolicita = 1;
		$pgAutorizado = 0;
		$pgNegado = 0;
	}else{
		$pgSolicita = 0;
		$pgAutorizado = 1;
		$pgNegado = 0;
	}
	$pgData = date("Ymd");
	// insere no banco
	$PDO = db_connect();
	$sql = "INSERT INTO ext_pg_tr(idPagina, idTorre, pgSolicita, pgData, pgAutorizado, pgNegado, pgPermite) VALUES(:idPagina, :idTorre, :pgSolicita, :pgData, :pgAutorizado, :pgNegado, :pgPermite)";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':idPagina', $idPagina);
	$stmt->bindParam(':idTorre', $idTorre);
	$stmt->bindParam(':pgSolicita', $pgSolicita);
	$stmt->bindParam(':pgData', $pgData);
	$stmt->bindParam(':pgAutorizado', $pgAutorizado);
	$stmt->bindParam(':pgNegado', $pgNegado);
	$stmt->bindParam(':pgPermite', $pgPermite);
	if ($stmt->execute())
	{
		if($tipoTorre > 0)
			{
				echo 'Solicitação Enviada';
			}
		else
			{
				echo 'Aprovado';
			}
	}
	else
	{
	    echo "Erro ao cadastrar";
	    print_r($stmt->errorInfo());
	}
	}
	if ($consulta['retorno'] == 'aceito'){ //'ACEITO' 	É QUANDO A PÁGINA JÁ FOI ACEITA, ENTÃO A UNICA OPÇÃO É SAIR, ENTÃO ALTERAMOS APENAS O CAMPO pgSair para (1)
			$pgSaiu = "1";
			$PDO = db_connect();
			$sql = "UPDATE ext_pg_tr SET pgSaiu = :pgSaiu WHERE idPgTorre=:idPgTorre";
			$stmt= $PDO->prepare($sql);
			$stmt->bindParam(':pgSaiu', $pgSaiu);
			$stmt->bindParam('idPgTorre', $idPgTorre);

	if ($stmt->execute())
	{
		echo "cadastrado";

	}else{
		echo "Erro ao cadastrar";
	    print_r($stmt->errorInfo());
	}
	}
	if ($consulta['retorno'] == 'sair'){ //'ACEITO' 	É QUANDO A PÁGINA JÁ FOI ACEITA, ENTÃO A UNICA OPÇÃO É SAIR, ENTÃO ALTERAMOS APENAS O CAMPO pgSair para (1)
			$pgSaiu = "0";
			$PDO = db_connect();
			$sql = "UPDATE ext_pg_tr SET pgSaiu = :pgSaiu WHERE idPgTorre=:idPgTorre";
			$stmt= $PDO->prepare($sql);
			$stmt->bindParam(':pgSaiu', $pgSaiu);
			$stmt->bindParam('idPgTorre', $idPgTorre);

	if ($stmt->execute())
	{
		echo "cadastrado";

	}else{
		echo "Erro ao cadastrar";
	    print_r($stmt->errorInfo());
	}
	}

}