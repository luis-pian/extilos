<?php
$email = 'api.extilos@gmail.com';
$token = '29C2627A1105430F8D015FCA317B4CB3';

$url = 'https://ws.pagseguro.uol.com.br/v2/checkout/?email=' . $email . '&token=' . $token;

$xml = '<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
    <checkout>
        <currency>BRL</currency>
        <redirectURL>http://www.minhaloja.com.br/paginaDeRedirecionamento</redirectURL>
        <items>
            <item>
                <id>0001</id>
                <description>Notebook Prata</description>
                <amount>1.00</amount>
                <quantity>1</quantity>
                <weight>1000</weight>
            </item>
            <item>
                <id>0002</id>
                <description>Notebook Rosa</description>
                <amount>2.00</amount>
                <quantity>2</quantity>
                <weight>750</weight>
            </item>
        </items>
        <reference>REF1234</reference>
        <sender>
            <name>Jose Comprador</name>
            <email>sounoob@comprador.com.br</email>
            <phone>
                <areaCode>11</areaCode>
                <number>55663377</number>
            </phone>
        </sender>
        <redirectURL>http://www.extilos.com/aplicativo/nova-pg-gratuita.php</redirectURL> 
        <shipping>
            <type>1</type>
            <address>
                <street>Rua sem nome</street>
                <number>1384</number>
                <complement>5o andar</complement>
                <district>Jardim Paulistano</district>
                <postalCode>01452002</postalCode>
                <city>Sao Paulo</city>
                <state>SP</state>
                <country>BRA</country>
            </address>
        </shipping>
        <acceptedPaymentMethods>
		    <include>
		        <paymentMethod>
		            <group>BOLETO</group>
		        </paymentMethod>
		    </include>
		</acceptedPaymentMethods>
    </checkout>';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
$xml= curl_exec($curl);

if($xml == 'Unauthorized'){
    echo 'fudeu a porra toda de primeira';

   // header('Location: paginaDeErro.php');
    //exit;//Mantenha essa linha
}
curl_close($curl);
$xml= simplexml_load_string($xml);

if(count($xml -> error) > 0){
    //Insira seu código avisando que o sistema está com problemas, sugiro enviar um e-mail avisando para alguém fazer a manutenção, talvez seja útil enviar os códigos de erros.
	echo 'fudeu a porra toda';
    //header('Location: paginaDeErro.php');
    //exit;
}
echo $xml -> code;
?>