<?php
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'mysql472.umbler.com'); // ''
define('DB_USER', '_extilos_'); // ''
define('DB_PASS', 'Extilos##251'); // ''
define('DB_NAME', 'banco_extilos'); // ''
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');  
// inclui o arquivo de funçõees
require_once 'conexao.php';