<?php
ob_start();
session_start();
require_once '../conn/init.php';
require_once '../cadastros/caracteres-especiais.php';
$retorno = isset($_SESSION['retorno']) ? $_SESSION['retorno'] : 'index.php';
        if(isset($_POST['logar'])){
                    $email_limpo = sanitizeString($_POST['emailUsuario']);
                    $emailUsuario = trim(strip_tags( $email_limpo));
                    $senhaUsuario = trim(strip_tags( $_POST['senhaUsuario']));
                    $senhaUsuario = md5($senhaUsuario);
                    $PDO = db_connect();

                    $select = "SELECT * FROM ext_usuarios WHERE emailUsuario = '$emailUsuario' AND senhaUsuario = '$senhaUsuario'";
                try{    
                    $stmt_count = $PDO->prepare($select);
                    $stmt_count->bindParam(':emailUsuario', $nomeUsuario, PDO::PARAM_STR);
                    $stmt_count->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
                    $stmt_count->execute();
                    $user = $stmt_count->fetch(PDO::FETCH_ASSOC);
                    $contar = $stmt_count->rowCount();
                    if ($contar>0){
                        $emailUsuario = $_POST['emailUsuario'];
                        $senhaUsuario = $_POST['senhaUsuario'];
                        $idlog = $user['idUsuario'];
                        $nomelog = $user['nomeUsuario'];
                        $arroba = $user['usuMarca'];
                        $usuProf = $user['usuProf'];

                        $_SESSION['usuarioLogado'] ='';
                        $_SESSION['senhaLogado'] = '';
                        $_SESSION['idLogado'] = '';
                        $_SESSION['nomeLogado'] = '';
                        $_SESSION['arroba'] = '';
                        $_SESSION['usuProf'] = '';

                        $_SESSION['usuarioLogado'] = $emailUsuario;
                        $_SESSION['senhaLogado'] = $senhaUsuario;
                        $_SESSION['idLogado'] = $idlog;
                        $_SESSION['nomeLogado'] = $nomelog;
                        $_SESSION['arroba'] = $arroba;
                        $_SESSION['usuProf'] = $usuProf;
                        $_SESSION['resposta'] = 'libera_entrada';
                            sleep(2);
                            header("Location: ../".$retorno);

                    }else{
                            
                            $_SESSION['resposta'] = 'login_invalido';
                            sleep(2);
                            header("Location: ../".$retorno);
                        }
                }catch(PDOExeception $e){
                            echo $e;
                        }
        }
    ?>