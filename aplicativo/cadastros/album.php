<?php
session_start();
require_once '../conn/init.php';
include_once 'caracteres-especiais.php';

// carrega os dados a serem salvos
$dataAlbum = date("Y-m-d");
$idUsuario = $_SESSION['idLogado'];
$album = isset($_POST['album']) ? $_POST['album'] : null;
$qtd_post = 0;

//limpa a string de caracteres especiais
$idUsuario = sanitizeString($idUsuario);
$album = sanitizeString($album);

// validação (bem simples, só pra evitar dados vazios)
if (empty($album))
{
	$_SESSION['resposta'] = 'alb_nome_negado';
	//$_SESSION['n'] = $_POST['nomeUsuario'];
   	header("Location: albuns.php");
    exit;
}

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO album_usuarios(idUsuario, album, dataAlbum, qtd_post) VALUES(:idUsuario, :album, :dataAlbum, :qtd_post)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->bindParam(':album', $album);
$stmt->bindParam(':dataAlbum', $dataAlbum);
$stmt->bindParam(':qtd_post', $qtd_post);


if ($stmt->execute())
{
	//$_SESSION['e'] = $_POST['emailUsuBasico'];
	$_SESSION['resposta'] = 'alb_nome_criado';
   header('Location: ../album.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}