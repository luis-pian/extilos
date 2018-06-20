<?php
ob_start();
session_start();
include_once '../conn/init.php';
include_once '../cadastros/caracteres-especiais.php';
require_once '../functions/conexoes.php';
require_once '../include/lib/WideImage.php';

//ATUALIZA A APRESETAÇÃO DA EMPRESA
if(isset($_POST['descritivo'])){
	$idUsuario = $_SESSION['idLogado'];
	$idPagina = $_POST['idPagina'];
	$conteudo = $_POST['apresenta'];
	$conteudo = sanitizeStringTexto($conteudo);
	// fazer a verificação se usuário tem autorização para alterar conteúdo da página
	$PDO = db_connect();
			$sql = "UPDATE ext_paginas SET descPagina = :conteudo WHERE idPagina=:idPagina";
			$stmt= $PDO->prepare($sql);
			$stmt->bindParam(':idPagina', $idPagina);
			$stmt->bindParam(':conteudo', $conteudo);

if ($stmt->execute()){
	?>
	<h5 for="apresenta">Apresentação do blog</h5>
	<textarea type="textarea" class="form-control"><?php echo $conteudo ?></textarea><small>Atualizado</small>
	<?php
}else{
	?>
	<textarea type="textarea" class="form-control"><?php echo $conteudo ?></textarea><small>Ocorreu um erro ao tentar atualizar!</small>;
	<?php
}
}
//ATUALIZA A CAPA DA EMPRESA
if(isset($_FILES['files'])){
	//$idUsuario = $_SESSION['idLogado'];
	$idPagina = $_POST['idPagina'];
	$name = $_FILES['files']['name'][0];
	$tmp_name = $_FILES['files']['tmp_name'][0]; //Atribui uma array com os nomes temporários dos arquivos à variável
    $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas
    $temp = '../imagem/capa/temp/';
    $grande = '../imagem/capa/grande/';
    $media = '../imagem/capa/media/';
    $mini = '../imagem/capa/mini/';
    $ext = strtolower(substr($name,-4));
    if ($ext == 'jpeg'){
        $ext = ".jpeg";
       }
    if ($_FILES['files']['size'][0] > 0 )
          	{
           	$new_name = date("YmdHis") .uniqid(). $ext;
           	$exif = @exif_read_data($tmp_name);
           	$orientation = (isset($exif['Orientation'])) ? $exif['Orientation'] : null;
        	$image = WideImage::load($tmp_name); //Carrega a imagem utilizando a WideImage
            if($orientation == 6){
              $image = $image->rotate(90,0);
            }
            if($orientation == 3){
              $image = $image->rotate(180,0);
            }
            if($orientation == 8){
              $image = $image->rotate(270,0);
            }
            $pgCapa = $new_name;
			$PDO = db_connect();
        	$sql = "UPDATE ext_paginas SET pgCapa = :pgCapa WHERE idPagina = :idPagina";
        	$stmt = $PDO->prepare($sql);
        	$stmt->bindParam(':pgCapa', $pgCapa);
        	$stmt->bindParam(':idPagina', $idPagina);

        	if ($stmt->execute()){ //se salvar no banco, gravar as imagens nas pastas
            
            //IMAGEM GRANDE
            $fundoG = $image->crop("center","middle",1200,500);
            $fundoG = $fundoG->addNoise('50', 'color');
        	$imageG = $image->resize(1200, 500, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
        	$imageG = $fundoG->merge($imageG,"center","middle");
        	//$imageG = $image->crop("center","center",1200,500);
        	$imageG->saveToFile($grande.$new_name); //Salva a imagem
            //IMAGEM MÉDIA
            $fundoM = $image->crop("center","middle",600,250);
            $fundoM = $fundoM->addNoise('50', 'color');
            $imageM = $image->resize(600, 350, 'inside'); //Redimensiona a imagem 
            $imageM = $fundoM->merge($imageM,"center","middle");
            //$imageM = $image->crop('center', 'center', 400, 250); //Corta a imagem do centro, forçando sua altura e largura
            $imageM->saveToFile($media.$new_name); //Salva a imagem

            echo '<div class="alert">
    			<button type="button" class="close" data-dismiss="alert">×</button>
          		<p class="text-muted" ><b><font color="0da314">Atualizado!</b></font></p>
      			</div>';
        	}
       		}
       		

    }
//CADASTRA UM NOVO ADMINISTRADOR PARA A PÁGINA
if (isset($_POST['codigoAdm'])){
	if($_POST['codigoAdm'] == 1){
		$idUsuario = $_POST['nomeUser'];
		$idPagina = $_POST['idPagina'];
		$post = isset($_POST['post']) ? $_POST['post'] : 0;
		$editar = isset($_POST['editar']) ? $_POST['editar'] : 0;
		$excluir = isset($_POST['excluir']) ? $_POST['excluir'] : 0;
		$cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : 0;
		$financeiro = isset($_POST['financeiro']) ? $_POST['financeiro'] : 0;
					$PDO = db_connect();
                      $sql = "INSERT INTO ext_permite(idPagina, idUsuario, pm_post, pm_editar, pm_excluir, pm_cadastro, pm_financeiro) VALUES(:idPagina, :idUsuario, :post, :editar, :excluir, :cadastro, :financeiro)";
                      $stmt = $PDO->prepare($sql);

                      $stmt->bindParam(':idUsuario', $idUsuario);
                      $stmt->bindParam(':idPagina', $idPagina);
                      $stmt->bindParam(':post', $post);
                      $stmt->bindParam(':editar', $editar);
                      $stmt->bindParam(':excluir', $excluir);
                      $stmt->bindParam(':cadastro', $cadastro);
                      $stmt->bindParam(':financeiro', $financeiro);

                      if ($stmt->execute()){
                      	echo '<div class="alert">
        						<button type="button" class="close" data-dismiss="alert">×</button>
          						<p class="text-muted" ><b><font color="0da314">Cadastrado!</b></font></p>
      						</div>';
                      }

	}
}
//ATUALIZA AS PERMISÕES DO ADMINISTRADOR
if (isset($_POST['codigoAdm'])){
	if($_POST['codigoAdm'] == 2){
		$idPermite = $_POST['idPermite'];
		$idUsuario = $_POST['nomeUser'];
		$idPagina = $_POST['idPagina'];
		$post = isset($_POST['post']) ? $_POST['post'] : 0;
		$editar = isset($_POST['editar']) ? $_POST['editar'] : 0;
		$excluir = isset($_POST['excluir']) ? $_POST['excluir'] : 0;
		$cadastro = isset($_POST['cadastro']) ? $_POST['cadastro'] : 0;
		$financeiro = isset($_POST['financeiro']) ? $_POST['financeiro'] : 0;
					$PDO = db_connect();
					//$sql = "UPDATE ext_permite SET(idPagina, idUsuario, pm_post, pm_editar, pm_excluir, pm_cadastro, pm_financeiro) VALUES(:idPagina, :idUsuario, :post, :editar, :excluir, :cadastro, :financeiro) WHERE idPermite = :idPermite ";
                       $sql = "UPDATE ext_permite SET idPagina = :idPagina, idUsuario = :idUsuario, pm_post = :post, pm_editar = :editar, pm_excluir = :excluir, pm_cadastro = :cadastro, pm_financeiro = :financeiro WHERE idPermite = :idPermite";
                      $stmt = $PDO->prepare($sql);
                      $stmt->bindParam(':idPermite', $idPermite);
                      $stmt->bindParam(':idUsuario', $idUsuario);
                      $stmt->bindParam(':idPagina', $idPagina);
                      $stmt->bindParam(':post', $post);
                      $stmt->bindParam(':editar', $editar);
                      $stmt->bindParam(':excluir', $excluir);
                      $stmt->bindParam(':cadastro', $cadastro);
                      $stmt->bindParam(':financeiro', $financeiro);

                      if ($stmt->execute()){
                      	echo '<div class="alert">
        						<button type="button" class="close" data-dismiss="alert">×</button>
          						<p class="text-muted" ><b><font color="0da314">Atualizado!</b></font></p>
      						</div>';
                      }
                      //if($stmt->execute() === false){
						//    echo "<pre>";
						//    print_r($stmt->errorInfo());
						//}

	}
}
