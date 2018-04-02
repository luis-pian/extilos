<?php 
function linkHashtag($textoBanco)
    {
		// criando link das # no descritivo
        preg_match_all ( '/#([\w]+)/' , $textoBanco , $palavra ); //pega as palavras com #
        $palavra = $palavra[0]; //usa apaenas o primeiro indice do resultado
        $hashtag = explode("#", $textoBanco); //explode as palavras que começam com #
        $n_palavras = count($hashtag); // conta em quantas partes foram divididos
        for ($k=1 ; $k<$n_palavras ; $k++) // loop para cada parte
            {
        $separaPalavras[$k] = preg_split('/ /', $hashtag[$k], -1); //sepera as palavras novamente agora separando pelos espaços
        unset($separaPalavras[$k][0]); // elimina a primeira palavra
        $separaPalavras[$k] = implode(' ', $separaPalavras[$k]); //monta o texto novamente com as palavras que sobraram
            }
        for ($p=0 ; $p<=$n_palavras; $p++) //realiza mais um loop para colocar a palavra retirada com um link
            {
        if(isset($palavra[$p])) // se existir palavra 
            {
        $pj= $p+1; //organiza os indices para bater certo com o texto antigo
        $palavra[$p] = '<a href="#">'. $palavra[$p] .' </a>'. $separaPalavras[$pj];//inclui a palavra retirada com um link para busca
            }
            }
        $palavra = $hashtag[0] . implode(' ', $palavra);
        // monta novamente o texto 
        // 10 horas trabalhada nesse pedaço vai tomanocu
        $contaPalavras = explode(" ", $palavra);
        $qtdePalavras = count($contaPalavras);
        if ($qtdePalavras < 20)
            {
        $textoCurto = implode(" ", $contaPalavras);
        $palavraCurta = '';
        $continua = '';
            }
        else
            {
        $textoTela = $contaPalavras[0].' '.$contaPalavras[1].' '.$contaPalavras[2].' '.$contaPalavras[3].' '.$contaPalavras[4].' '.$contaPalavras[5].' '.$contaPalavras[6].' '.$contaPalavras[7].' '.$contaPalavras[8].' '.$contaPalavras[9].' '.$contaPalavras[10].' '.$contaPalavras[11].' '.$contaPalavras[12].' '.$contaPalavras[13].' '.$contaPalavras[14].' '.$contaPalavras[15].' '.$contaPalavras[16].' '.$contaPalavras[17].' '.$contaPalavras[18].' '.$contaPalavras[19].' '.$contaPalavras[20];
        
        $textoCurto = '';
        $palavraCurta = $textoTela;
        $continua = implode(" ", $contaPalavras);
            }
     // return $palavra;
        return array ($textoCurto, $continua, $palavraCurta, $qtdePalavras);
     // return $continua;
     // return $palavraCurta;
     // return $idAleatorio;
     // return $idAleatorio1;
        }
?>
