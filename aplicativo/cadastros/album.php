<?php
session_start();
require_once '../conn/init.php';
include_once 'caracteres-especiais.php';

// carrega os dados a serem salvos
$dataAlbum = date("Y-m-d");
$idUsuario = $_SESSION['idLogado'];
$album = isset($_POST['album']) ? $_POST['album'] : null;

//limpa a string de caracteres especiais
$idUsuario = sanitizeString($idUsuario);
$album = sanitizeString($album);

// validação (bem simples, só pra evitar dados vazios)
if (empty($album))
{
	$_SESSION['resposta'] = 'alb_nome_negado';
	//$_SESSION['n'] = $_POST['nomeUsuario'];
   	header("Location: ../albuns-foto.php");
    exit;
}

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO album_usuarios(idUsuario, album, dataAlbum) VALUES(:idUsuario, :album, :dataAlbum)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->bindParam(':album', $album);
$stmt->bindParam(':dataAlbum', $dataAlbum);



 
 
if ($stmt->execute())
{
	//$_SESSION['e'] = $_POST['emailUsuBasico'];
	$_SESSION['resp'] = 'alb_nome_criado';
   header('Location: ../albuns-foto.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}