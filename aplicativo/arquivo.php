o arquivo.php recebe os valores em post ficando assim:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>
<?php
$longitude = $_POST["longitude"];
$latitude = $_POST["latitude"];
echo 'Longitude = ' .$longitude;
echo '<p>';
echo 'Latidude = ' .$latitude;
?>
<body>
</body>
</html>