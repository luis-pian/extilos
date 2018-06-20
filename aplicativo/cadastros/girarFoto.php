<?php
function corrigeOrientacao($filename)
{
    $exif = exif_read_data($filename);

    if (!empty($exif['Orientation'])) {
        $target = imagecreatefromjpeg($filename);

        switch ($exif['Orientation']) {
            case 3:
                $target = imagerotate($target, 180, 0);
                break;

            case 6:
                $target = imagerotate($target, -90, 0);
                break;

            case 8:
                $target = imagerotate($target, 90, 0);
                break;
        }
    }

    imagejpeg($target, $filename);//Salva por cima da imagem original

    imagedestroy($target);
}