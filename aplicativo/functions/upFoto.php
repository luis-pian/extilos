<?php

if(isset($_FILES['files']))
{
	require ('../include/lib/WideImage.php');
	$name  = $_FILES['files']['name']; //Atribui uma array com os nomes dos arquivos à variável
    $tmp_name = $_FILES['files']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
    $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas
    $temp = '../imagem/capa/temp/';
    $grande = '../imagem/capa/grande/';
    $media = '../imagem/capa/media/';
    $mini = '../imagem/capa/mini/';

for($i = 0; $i < count($tmp_name); $i++){ //passa por todos os arquivos
       $ext = strtolower(substr($name[$i],-4));
       //faz o tratamento caso a extesão do arquivo seja jpeg, por causa da quantidade de caracteres
       if ($ext == 'jpeg'){
        $ext = ".jpeg";
       }
         if(in_array($ext, $allowedExts)) //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
         {
         	if ($_FILES['files']['size'][$i] > 0 )
          {
           $new_name = date("YmdHis") .uniqid(). $ext;
           $exif = @exif_read_data($tmp_name[$i]);
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
        	//$image = $image->resize(800, 1000, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
        		//$image = $image->crop('center', 'center', 800, 1000); //Corta a imagem do centro, forçando sua altura e largura
        	//$image->saveToFile($grande.$new_name); //Salva a imagem
            //IMAGEM MÉDIA
            $fundo = $image->crop("center","middle",500,250);
            $fundo = $fundo->addNoise('50', 'color');
            $image = $image->resize(600, 300, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
            $image = $fundo->merge($image,"center","middle");
            //$image = $image->crop('center', 'center', 500, 700); //Corta a imagem do centro, forçando sua altura e largura
            $image->saveToFile($temp.$new_name); //Salva a imagem
            //IMAGEM PEQUENA
            //$image = $image->resize(200, 300, 'inside'); //Redimensiona a imagem para 170 de largura e 180 de altura
            //$image = $image->crop('center', 'center', 200, 300); //Corta a imagem do centro, forçando sua altura e largura
            //$image->saveToFile($mini.$new_name); //Salva a imagem

            //echo $image;
            $str[] = $new_name;
            echo'<img src="imagem/capa/temp/'.$str[$i].'" class="img-responsive">
            <input type="hidden" id="nomeFoto" value="'.$str[$i].'">';
       }

     }
  }
}


