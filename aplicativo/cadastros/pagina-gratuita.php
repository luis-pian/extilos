<?php
session_start();
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
    $_SESSION['resp'] = 'negado';
    header("Location: login.php"); exit;
} 
require_once '../conn/init.php';

$dataPagina = date("Y-m-d");
$torrePagina = isset($_POST['torrePagina']) ? $_POST['torrePagina'] : null;
$idUsuario = isset($_SESSION['idLogado']) ? $_SESSION['idLogado'] : null;
$nomePagina = isset($_POST['nomePagina']) ? $_POST['nomePagina'] : null;
$descPagina = isset($_POST['descPagina']) ? $_POST['descPagina'] : null;
$estadoPagina = isset($_POST['estadoPagina']) ? $_POST['estadoPagina'] : null;
$cidadePagina = isset($_POST['cidadePagina']) ? $_POST['cidadePagina'] : null;
$emailPagina = isset($_POST['emailPagina']) ? $_POST['emailPagina'] : null;


// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO ext_paginas(dataPagina, torrePagina, idUsuario, nomePagina, descPagina, estadoPagina, cidadePagina, emailPagina) VALUES(:dataPagina, :torrePagina, :idUsuario, :nomePagina, :descPagina, :estadoPagina, :cidadePagina, :emailPagina)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':dataPagina', $dataPagina);
$stmt->bindParam(':torrePagina', $torrePagina);
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->bindParam(':nomePagina', $nomePagina);
$stmt->bindParam(':descPagina', $descPagina);
$stmt->bindParam(':estadoPagina', $estadoPagina);
$stmt->bindParam(':cidadePagina', $cidadePagina);
$stmt->bindParam(':emailPagina', $emailPagina);


if ($stmt->execute())
{
	$_SESSION['resposta'] = 'npg_criada';
    header('Location: ../paginas-usuario.php');
}
else
{
    $_SESSION['resposta'] = 'npg_erro';
    header('Location: ../nova-pg-gratuita.php');
}