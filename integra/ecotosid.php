<?php

require_once('chaveiro.php');

/* Procurar por Arquivo de Log com dado da última exportação */
$logfilename = "sidicom/log/ecotosid.log";
if (file_exists($logfilename)) {
    $lines = file($logfilename);
    foreach ($lines as $line_num => $line) {
        $pos = strpos($line, ';');
        $sub = substr($line, 0, $pos);
        $lastexport = $sub;        
    }
} else {
    $lastexport = "2014-01-01 00:00:00"; //Caso não encontre arquivo de log com dado de última exportação
}

$quebralinha = "\r\n";
$nomearq = "";

$reg160 = array();

//REGISTRO 000: ABERTURA DO ARQUIVO DIGITAL

$codempresa = 0;
$codusuario = 0;
$data       = date("d/m/Y H:m");
$versao     = "0026";

$result = "000;"; //Fixo
$result .= "$codempresa;";   // codigo empresa o sidicom
$result .= "$codusuario;";    // codigo de usuario no sidicom
$result .= "$data;";    // data de geracao
$result .= "$versao;"; // versão
$result .= $quebralinha;


//Select do Pedido no Banco de Dados do e-commerce
$sql = "select order_id, customer_id, shipping_code, total, comment, date_added, shipping_address_1, shipping_address_2
        shipping_city, shipping_postcode, shipping_country_id, iso_code_3 
        from eworxes_order 
        left join eworxes_country on (eworxes_order.shipping_country_id = eworxes_country.country_id) 
        where (date_added > '$lastexport')  or (date_modified > '$lastexport')";
$sql = mysqli_query($conexao, $sql);

$num_rows = mysqli_num_rows($sql); /* Número de Pedidos Encontrados */

if ($num_rows > 0 ) {
    while ($dados = mysql_fetch_array($sql))  {
       $numpedecom = $dados["order_id"]; //REG 01
       // REG 02 - 04
       $codcliente = $dados["customer_id"]; //REG 05
       // REG 06 - 08
       $codtransp  = $dados["shipping_code"]; //REG 09
       // REG 10 - 13
       $vlrtotal   = $dados["total"]; //REG 14
       // REG 15 - 17
       $vlrfrete   = "0"; /* campo não identificado no database; */ //REG 18
       // REG 19 - 23
       $numoc      = ""; /* campo não identificado no database; */ //REG 24
       $observacao = $dados["comment"]; //REG 25
       //REG 26 - 27
       $dataemi = date("Ymd", strtotime($dados["date_added"])); /* converter AAAAMMDD */ //REG 28
       // REG 29 - 30
       /* repetir duas vezes na linha de registro */
       $datacriini = date("Ymd", strtotime($dados["date_added"])); /* converter AAAAMMDD */ //REG 31 e 33
       $horacriini = date("Hms", strtotime($dados["date_added"])); /* converter HHMMSS */   //REG 32 e 34
       //REG 35 - 37
       $cpfcnpj    = ""; /* campo não identificado no database; */ //REG 38
       $logentrega = $dados["shipping_address_1"]; //REG 39
       $numentrega = $dados["shipping_address_2"]; //REG 40
       $comentrega = ""; /* campo não identificado no database; */ //REG 41
       $baientrega = ""; /* campo não identificado no database; */ //REG 42
       $cidentrega = $dados["shipping_city"]; //REG 43
       $ufentrega = ""; /* campo não identificado no database; */ //REG 44
       $cepentrega = $dados["shipping_postcode"]; //REG 45
       $paisentrega = $dados["iso_code_3"]; //REG 46
       
       /* ESCREVER REGISTRO 150 */
       $result .= "150;"; // Fixo
       $result .= "$numpedecom;"; //01
       $result .= ";;;"; // 02 - 04 : VAZIOS
       $result .= "$codcliente;"; //05
       $result .= ";;;"; // 06 - 08 : VAZIOS
       $result .= "$codtransp;"; //09
       $result .= ";;;;"; // 10 - 13 : VAZIOS
       $result .= "$vlrtotal;"; //14
       $result .= "0;0;0;"; // 15 - 17 : 0
       $result .= "$vlrfrete;"; //18
       $result .= "0;0;0;0;0;"; // 19 - 23 : 0
       $result .= "$numoc;"; //24
       $result .= "$observacao;"; //25
       $result .= ";0;"; //26 - 27
       $result .= "$dataemi;"; //28
       $result .= ";;"; // 29 - 30 : VAZIOS
       $result .= "$datacriini;"; //31
       $result .= "$horacriini;"; //32
       $result .= "$datacriini;"; //33
       $result .= "$horacriini;"; //34
       $result .= "0;0;0;"; // 35 - 37 : 0
       $result .= "$cpfcnpj;"; //38
       $result .= "$logentrega;"; //39
       $result .= "$numentrega;"; //40
       $result .= "$comentrega;"; //41
       $result .= "$baientrega;"; //42
       $result .= "$cidentrega;"; //43
       $result .= "$ufentrega;"; //44
       $result .= "$cepentrega;"; //45
       $result .= "$paisentrega;"; //46
       $result .= $quebralinha;
       
       //Verifica se Cliente já está armazenado, senão armazena
       $key = array_search($codcliente, $reg160);
       if ($key == FALSE) {
            $reg160[] = $codcliente;
       }
       
       //REGISTRO 151 : PRODUTOS DO PEDIDO
       $sql2 = "select eworxes_order_product.order_id, eworxes_order_product.product_id, quantity, eworxes_product.price as p1,
                eworxes_order_product.price as p2, total
                from eworxes_order_product
                left join eworxes_product on (eworxes_product.product_id = eworxes_order_product.product_id) 
                where eworxes_order_product.order_id = $numpedecom";
       $sql2 = mysqli_query($conexao, $sql2);
       
       $num_rows2 = mysqli_num_rows($sql2); /* Número de Pedidos Encontrados */
       
       if ($num_rows2 > 0) {
            while ($dados2 = mysql_fetch_array($sql2)) {
                //REG 01 : $numpedecom
                $codproduto = $dados2["product_id"]; //REG 02
                //REG 03 - 04: 0 E 1
                $quantidade = $dados2["quantity"]; //REG 05
                //REG 06: VAZIO
                $precotab = $dados2["p1"]; //REG 07
                //REG 08: 0
                $precoliq = $dados2["p2"]; //REG 09
                $totalitem = $dados2["total"]; //REG 10
                //REG 11 - 21: 0
                
                // ESCREVER REGISTRO 151
                $result .= "151;"; // Fixo
                $result .= "$numpedecom;"; //01
                $result .= "$codproduto;"; //02
                $result .= "0;1;"; //03 E 04 
                $result .= "$quantidade;"; //05
                $result .= ";"; //06
                $result .= "$precotab;"; //07
                $result .= "0;"; //08
                $result .= "$precoliq;"; //09
                $result .= "$totalitem;"; //10
                $result .= "0;0;0;0;0;0;0;0;0;0;0;"; //11 - 21
                $result .= $quebralinha;
            }
       }      
    }
    /* BUSCAR DADOS DE CLIENTES DOS PEDIDOS ADICIONADOS/MODIFICADOS */
    $count = count($reg160);
    for($i=0;$i<$count;$i++) {
        $sql3 = "SELECT eworxes_customer.customer_id, eworxes_customer.firstname, eworxes_customer.lastname, eworxes_address.address_1,
                 eworxes_address.address_2, eworxes_address.city, eworxes_address.postcode, telephone, email, eworxes_country.iso_code_3 
                 FROM eworxes_customer, eworxes_address
                 LEFT JOIN eworxes_country on (eworxes_country.country_id = eworxes_address.country_id) 
                 WHERE (eworxes_customer.customer_id = $reg160[$i]) and (eworxes_address.address_id = eworxes_customer.address_id)";
        $sql3 = mysqli_query($conexao, $sql3);
        if ($sql3) {
            while ($dados3 = mysql_fetch_array($sql3)) {
                //ESCREVE REGISTRO 160
                $result .= "160;"; // Fixo
                $result .= "0;"; // 01 - Controle
                $result .= $dados3["customer_id"].";"; // 02 
                $result .= $dados3["firstname"]." ".$dados3["lastname"].";"; // 03
                $result .= ";"; // 04: Vazio
                $result .= ";"; // 05: CNPJ/CPF Não identificado no database
                $result .= ";"; // 06: IE/RG Não identificado no database
                $result .= $dados3["address_1"].";"; // 07
                $result .= $dados3["address_2"].";"; // 08
                $result .= ";"; // 09: Complemento - Não identificado no database
                $result .= ";"; // 10: Bairro - Não identificado no database
                $result .= $dados3["city"].";"; // 11
                $result .= ";"; // 12: UF - Não identificado no database
                $result .= $dados3["postcode"].";"; // 13
                $result .= $dados3["iso_code_3"].";"; // 14
                $result .= $dados3["telephone"].";"; // 15
                $result .= $dados3["email"].";"; // 16
                $result .= ";"; // 17 : site - Não identificado no database
                
                // 18 -25: Endereço de Cobrança
                $result .= $dados3["address_1"].";"; // 18
                $result .= $dados3["address_2"].";"; // 19
                $result .= ";"; // 20: Complemento - Não identificado no database
                $result .= ";"; // 21: Bairro - Não identificado no database
                $result .= $dados3["city"].";"; // 22
                $result .= ";"; // 23: UF - Não identificado no database
                $result .= $dados3["postcode"].";"; // 24
                $result .= $dados3["iso_code_3"].";"; // 25
                
                //26 - 33: Endereço de Entrega
                $result .= ";"; // 26
                $result .= ";"; // 27
                $result .= ";"; // 28: Complemento - Não identificado no database
                $result .= ";"; // 29: Bairro - Não identificado no database
                $result .= ";"; // 30
                $result .= ";"; // 31: UF - Não identificado no database
                $result .= ";"; // 32
                $result .= ";"; // 33
                
                $result .= ";"; // 34 Vazio - Código região do cliente
                $result .= ";"; // 35 Vazio - Código sub-região do cliente
                
                $result .= $quebralinha; 
            } 
        }        
    }
    
    $result .= "999".$quebralinha; 
    
    //SALVAR ARQUIVO GERADO
    $datahora = date("YmdHms");
    $nomearq = "RET_".$datahora.".txt";
    $result2 = mb_convert_encoding($result, "UTF-8");

    $fp = fopen("sidicom/".$nomearq, "a");

    $escreve = fwrite($fp, $result2 );

    fclose($fp);
    //FIM SALVAR ARQUIVO GERADO
    
} else {
    $mensagem = "Não foram encontrados pedidos novos ou atualizados. Nenhum arquivo gerado";
}

//SALVA LOG DE ÚLTIMA EXECUÇÃO
$logfile = fopen($logfilename, 'a');
$linha = date('Y-m-d H:i:s') . ";" . $num_rows . ";" . $nomearq . ";" . $quebralinha;
fwrite($logfile, $linha);
fclose($logfile);

?>