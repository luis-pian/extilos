<?php
session_start();
if (!isset($_POST['captcha'])){
$codigoCaptcha = substr(md5(time().'%SJDIMAPS2615**&%$%+)))_411893jisjdifu') ,1,8);
$codigoCaptcha = strtoupper($codigoCaptcha);

$_SESSION['captcha'] = $codigoCaptcha;
/* SELECIONA AS IMAGENS DE FORMA ALEATÓRIA PARA GERAR UM CÓDIGO CAPCHA */
$img = rand(1,8);

if ($img == 1){$imagem = 'arq/1.png'; $cor1 = 199; $cor2 = 90; $cor3 = 61;	}
if ($img == 2){$imagem = 'arq/2.png'; $cor1 = 0; $cor2 = 0; $cor3 = 2;	}
if ($img == 3){$imagem = 'arq/3.png'; $cor1 = 90; $cor2 = 199; $cor3 = 128;	}
if ($img == 4){$imagem = 'arq/4.png'; $cor1 = 105; $cor2 = 105; $cor3 = 105;	}
if ($img == 5){$imagem = 'arq/5.png'; $cor1 = 220; $cor2 = 20; $cor3 = 61;	}
if ($img == 6){$imagem = 'arq/6.png'; $cor1 = 199; $cor2 = 21; $cor3 = 199;	}
if ($img == 7){$imagem = 'arq/7.png'; $cor1 = 90; $cor2 = 128; $cor3 = 90;	}
if ($img == 8){$imagem = 'arq/8.png'; $cor1 = 199; $cor2 = 90; $cor3 = 61;	}

	$imagemCaptcha = imagecreatefrompng($imagem);
  	$fonteCaptcha = imageloadfont("arq/anonymous.gdf");
  	$corCaptcha = imagecolorallocate($imagemCaptcha,$cor1,$cor2,$cor3);
  	imagestring($imagemCaptcha,$fonteCaptcha,5,10,$codigoCaptcha,$corCaptcha);
  	header("Content-type: image/png");
  	imagepng($imagemCaptcha);
  	imagedestroy($imagemCaptcha);

  }else{
  	// validação que vem por parte do usuário
  	
  	$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : null;
  	$captcha = strtoupper($captcha);
  	
  	if ($_SESSION['captcha'] == $captcha){
  			echo'
  			<div class="span4">
  				Verificando:
  				<b style="color:#228B22">'.$captcha.' | ✔</b>
  				<script>document.getElementById("cadastroLogin").disabled = false;</script>
  			</div>
  			';
  		}else{
  			
  			echo '<div class="span4">
  				Verificando:
  				<b style="color:#e8091f">'.$captcha.' | ✘</b>
  				<script>document.getElementById("cadastroLogin").disabled = true;</script>
  			</div>';
  		}
  		//unset($_SESSION['captcha']);
  	}
?> 