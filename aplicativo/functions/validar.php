<?php
require_once 'conn/init.php';
include_once 'cadastros/caracteres-especiais.php';
// PEGA OS DADOS DO USUARIO NA SESSION
$idLogado = $_SESSION['idLogado'];
$idTorre = 1;


//DETERMINA AS CORES DO BOTÃO DE ACORDO COM A OPÇÃO DO USUÁRIO
if ($corBotao = 0){
    $corBotao = 'css/style.blue.css';
}else{
    $corBotao = 'css/style.pink.css';
}
?> 