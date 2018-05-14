<?php
function sanitizeString($string) {

    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','(',')',',',';',':','|','!','"','$','%','&','/','=','?','~','^','>','<','ª','º','#','-','[',']','$','*','+' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_', );

    // devolver a string
    $retorno = str_replace($what, $by, $string);
    $retorno = preg_replace('/[[:^print:]]/','a', $retorno);
    return $retorno;
}

function sanitizeStringlight($string) {

    // matriz de entrada
    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','(',')',';',':','|','!','"','$','%','&','/','=','?','~','^','>','<','ª','º','[',']','$','*','+' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_', );

    // devolver a string
    $retorno = str_replace($what, $by, $string);
    $separaPalavras = preg_split('/ /', $retorno, -1);
    $contaPalavras = count($separaPalavras);
    for ($r=0 ; $r<$contaPalavras ; $r++ ){
        $contaLetras = strlen($separaPalavras[$r]);
            if($contaLetras > 20){
                $separaPalavras[$r] = mb_strimwidth($separaPalavras[$r], 0, 20).'...';
            }
    }
    $retorno = implode(" ", $separaPalavras);
    return $retorno;
}


?>