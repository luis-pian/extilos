<?php
require_once 'conn/init.php';
include_once 'cadastros/caracteres-especiais.php';
// PEGA OS DADOS DO USUARIO NA SESSION
$idLogado = $_SESSION['idLogado'];
$idTorre = 1;






//VERIFICA SE EXISTE O MÉTODO PASSADO VIA GET
if (isset($_GET['id'])){
	if (isset($_GET['alb'])){
		$idAlbum = $_GET['id'];
		$idAlbum = substr($idAlbum, 3,-4);
		$nomeAlbum = $_GET['alb'];
	}
	//TRATA OS CONTEÚDOS QUE SÃO PASSADOS VIA GET
	$idAlbum = sanitizeString($idAlbum);
	$nomeAlbum = sanitizeString($nomeAlbum);
}





//DETERMINA AS CORES DO BOTÃO DE ACORDO COM A OPÇÃO DO USUÁRIO
if ($corBotao = 0){
    $corBotao = '/extilos/aplicativo/css/style.blue.css';
}else{
    $corBotao = '/extilos/aplicativo/css/style.pink.css';
}
?> 