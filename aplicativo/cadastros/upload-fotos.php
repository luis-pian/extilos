<?php
ob_start();
session_start();
//if(!isset($_SESSION['usuariolog']) && (!isset($_SESSION['senhalog']))){
    //header("Location: login.php?acao=negado"); exit;
//} 
include_once '../conn/init.php';
include_once 'caracteres-especiais.php';
//carrega informação da session
$idUsuario = $_SESSION['idLogado'];
$idTorre = isset($_SESSION['idTorre']) ? $_SESSION['idTorre'] : null;
// informações do formulário
$usuEstilo = 	    isset($_POST['usuEstilo']) 	? $_POST['usuEstilo']   : null;
$usuTitulo= 	    isset($_POST['usuTitulo']) 	? $_POST['usuTitulo']   : null;
$usuMarca = 	    isset($_POST['usuMarca']) 	? $_POST['usuMarca']    : null;
$publicarTorre =  isset($_POST['torre'])      ? $_POST['torre']       : null;
$precPro =        isset($_POST['precPro'])    ? $_POST['precPro']     : null;
$descPro =        isset($_POST['descPro'])    ? $_POST['descPro']     : null;
$formaPro =       isset($_POST['formaPro'])   ? $_POST['formaPro']    : null;
$infoPro =        isset($_POST['infoPro'])    ? $_POST['infoPro']     : null;
//limpa as strings passadas via post
$usuEstilo =  sanitizeString($usuEstilo);
$usuTitulo=   sanitizeString($usuTitulo);
$usuMarca =   sanitizeStringlight($usuMarca);
$publicarTorre =  sanitizeString($publicarTorre);
$precPro = sanitizeStringlight($precPro);
$descPro = sanitizeStringlight($descPro);
$formaPro = sanitizeString($formaPro);
$infoPro = sanitizeStringlight($infoPro);
// validação (bem simples, só pra evitar dados vazios)
if (empty($usuEstilo) || empty($usuTitulo) )
{
	echo "Preencha os campos obrigatórios.";
	exit;
}

//print_r($_FILES['imagem']['error']);
if(isset($_FILES['imagem']))
{
      require ('../include/lib/WideImage.php'); //Inclui classe WideImage à página
      date_default_timezone_set("Brazil/East");
      //$maxSize	= 1024 * 1024 * 10;
      	$name  = $_FILES['imagem']['name']; //Atribui uma array com os nomes dos arquivos à variável
      	$tmp_name = $_FILES['imagem']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
      	//$tamanho = $_FILES['imagem']['size'];
        //$exif = exif_read_data($_FILES['imagem']['tmp_name']);
//print_r($tmp_name);
      $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas
      $grande = '../imagem/grande/';
      $media = '../imagem/media/';
      $mini = '../imagem/mini/';
      for($i = 0; $i < count($tmp_name); $i++){ //passa por todos os arquivos
       $ext = strtolower(substr($name[$i],-4));
       //faz o tratamento caso a extesão do arquivo seja jpeg, por causa da quantidade de caracteres
       if ($ext == 'jpeg'){
        $ext = ".jpeg";
       }
         if(in_array($ext, $allowedExts)) //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
         {
         	if ($_FILES['imagem']['size'][$i] > 0 )
          {
           $new_name = date("YmdHis") .uniqid(). $ext;
           $exif = exif_read_data($tmp_name[$i]);
           $orientation = (isset($exif['Orientation'])) ? $exif['Orientation'] : null;


        		$image = WideImage::load($tmp_name[$i]); //Carrega a imagem utilizando a WideImage

            if($orientation == 6){
              $image = $image->rotate(90,0);
            }
            if($orientation == 3){
              $image = $image->rotate(180,0);
            }
            if($orientation == 8){
              $image = $image->rotate(270,0);
            }
            //IMAGEM GRANDE
        		$image = $image->resize(800, 1000, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
        		//$image = $image->crop('center', 'center', 800, 1000); //Corta a imagem do centro, forçando sua altura e largura
        		$image->saveToFile($grande.$new_name); //Salva a imagem
            //IMAGEM GRANDE
            $image = $image->resize(500, 700, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
            //$image = $image->crop('center', 'center', 500, 700); //Corta a imagem do centro, forçando sua altura e largura
            $image->saveToFile($media.$new_name); //Salva a imagem
            //IMAGEM GRANDE
            $image = $image->resize(200, 300, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
            //$image = $image->crop('center', 'center', 200, 300); //Corta a imagem do centro, forçando sua altura e largura
            $image->saveToFile($mini.$new_name); //Salva a imagem

            //echo $image;
            $str[] = $new_name;

            $_SESSION['resposta'] = 'alb_publicado';

          }
          else
          {
           $_SESSION['resposta'] = 'alb_alerta';
         }

       }

     }
  }

   $img =   isset($str[0]) 	? $str[0] : null;
   $img1 =  isset($str[1]) 	? $str[1] : null;
   $img2 =  isset($str[2]) 	? $str[2] : null;
   $img3 =  isset($str[3]) 	? $str[3] : null;
   $img4 =  isset($str[4]) 	? $str[4] : null;

// insere no banco
                      $PDO = db_connect();
                      $sql = "INSERT INTO img_usuarios(idUsuario, usuEstilo, usuTitulo, usuMarca, img, img1, img2, img3, img4, publicarTorre, idTorre, precPro, descPro, formaPro, infoPro) VALUES(:idUsuario, :usuEstilo, :usuTitulo, :usuMarca, :img, :img1, :img2, :img3, :img4, :publicarTorre, :idTorre, :precPro, :descPro, :formaPro, :infoPro)";
                      $stmt = $PDO->prepare($sql);

                      $stmt->bindParam(':idUsuario', $idUsuario);
                      $stmt->bindParam(':usuEstilo', $usuEstilo);
                      $stmt->bindParam(':usuTitulo', $usuTitulo);
                      $stmt->bindParam(':usuMarca', $usuMarca);
                      $stmt->bindParam(':img', $img);
                      $stmt->bindParam(':img1', $img1);
                      $stmt->bindParam(':img2', $img2);
                      $stmt->bindParam(':img3', $img3);
                      $stmt->bindParam(':img4', $img4);
                      $stmt->bindParam(':publicarTorre', $publicarTorre);
                      $stmt->bindParam(':idTorre', $idTorre);
                      $stmt->bindParam(':precPro', $precPro);
                      $stmt->bindParam(':descPro', $descPro);
                      $stmt->bindParam(':formaPro', $formaPro);
                      $stmt->bindParam(':infoPro', $infoPro);

                      if ($stmt->execute())
                      {
        //DEPOIS DE EXECUTAR A INSERÇÃO DE DADADOS
        //Tratamento para as hashtag
                       $hashtag = explode("#", $usuMarca);
                       $n_palavras = count($hashtag);
                       for ($k=1 ; $k<$n_palavras ; $k++)
                       {
                        $separaPalavras[$k] = preg_split('/ /', $hashtag[$k], -1);
                      }
                      $contaPalavra = isset($separaPalavras) ? count($separaPalavras) : 0 ; //verifica se exite
                      for ($v=1; $v<=$contaPalavra; $v++)
                      {
                        $novaHashtag[$v] = "#".sanitizeString($separaPalavras[$v][0]);
                      }
          /* EXEMPLO DE FUNCIONAMENTO
            Usuário _POST: #minhaloja a melhor loja da cidade #cidade #compra_aqui é barato
            Sistema:  (explode) tudo que começa com #
                      (resultado) Array[0]=>minhaloja a melhor loja da cidade [1]=>cidade [2]=>compra_aqui é barato
                      (count) conta a quandidade de palavras
                      (resultado) 3 seguimentos
                      (loop) cria regra para cada seguimento
                      (preg_split) separa cada palavra onde tem espaço criando array multidimencional
                      (resultado) Array=>[1] Array=[0]minhaloja [1]a [2]melhor... Array=>[2] Array=>[0]cidade ..
                      (count) conta a quantidade de Array primario
                      (resultado) 3 Array
                      (loop)cira um loop para cada array
                      (finaliza) pega o reslutado de cada array na matriz [0]onde contem a primeira palavra escrita com a # e descarta o restante do texto. Adiciona #novamente na frete da palavra. SanitizeString substitui caracteres invalidos.
                      (resultado) Array([1]=>#minhaloja [2]=>#cidade [3]=>#comprar_aqui)
          */
          //Tratamento para as @ arroba
                      $arroba = explode("@", $usuMarca);
                      $n_arroba = count($arroba);

                      for ($a=1 ; $a<$n_arroba ; $a++)
                      {
                        $separaArroba[$a] = preg_split('/ /', $arroba[$a], -1);
                      }
                       $contaArroba = isset($separaArroba) ? count($separaArroba) : 0 ; //verifica se exite
                      for ($b=1; $b<=$contaArroba; $b++)
                      {
                        $novaArroba[$b] = "@".sanitizeString($separaArroba[$b][0]);
                      }
        // Consulta para saber o ultimo post do usuário, para recuperar o valor de IDdo Post
                        $sqlConsulta = "SELECT MAX(IdImg) as ultimo FROM img_usuarios where idUsuario = $idUsuario";
                        $sqlExecuta = $PDO->prepare($sqlConsulta);
                        $sqlExecuta -> execute();
                        $ultimoNum = $sqlExecuta -> fetch(PDO::FETCH_ASSOC);
                        $ultimo = $ultimoNum['ultimo'];

        //prepara o conteudo para ser inserido
                        $qtdePalavras = isset($novaHashtag) ? count($novaHashtag) : 0 ; //verifica se exite
        //Cadastro de Hashtag no banco de dados com Loop
                        for ($s=1 ; $s<=$qtdePalavras; $s++)
                        {
                          $hash = $novaHashtag[$s];
                          $sqlTag = "INSERT INTO ext_tag(nomeTag, idUsuario, idAlbum) VALUES(:hash, :idUsuario, :ultimo)";
                          $stmtTag = $PDO->prepare($sqlTag);
                          $stmtTag->bindParam(':hash', $hash);
                          $stmtTag->bindParam(':idUsuario', $idUsuario);
                          $stmtTag->bindParam(':ultimo', $ultimo);
        //  header('Location: ../enviar-fotos.php');
                          if($stmtTag ->execute())
                          {
                          }else{
                            $_SESSION['resposta'] = 'alb_erro_hash';
                            header('Location: foto.php');
                            exit;
                          }
                        }
        //prepara o conteudo para ser inserido
                        $qtdeArrobas = isset($novaArroba) ? count($novaArroba) : 0 ; //verifica se exite
        //Cadastro de Arrobas no banco de dados com Loop
                        for ($s=1 ; $s<=$qtdeArrobas; $s++)
                        {
                          $arroba = $novaArroba[$s];
                          $sqlArr = "INSERT INTO ext_marca(usuMarcado, idUsuario, idAlbum) VALUES(:arroba, :idUsuario, :ultimo)";
                          $stmtArr = $PDO->prepare($sqlArr);
                          $stmtArr->bindParam(':arroba', $arroba);
                          $stmtArr->bindParam(':idUsuario', $idUsuario);
                          $stmtArr->bindParam(':ultimo', $ultimo);

                          if($stmtArr ->execute())
                          {
                          }else{
                            $_SESSION['resposta'] = 'alb_erro_arroba';
                            header('Location: ../foto.php');
                            exit;
                          }
                        }
                       header('Location: ../foto.php');
                      }
                      else
                      {
                       $_SESSION['resposta'] = 'alb_erro';
                       // header('Location: ../foto.php');
                     }