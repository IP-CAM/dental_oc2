<?php
require_once('chaveiro.php');
require_once('functions.php');

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
$data = date("d/m/Y H:m");
$versao = "0026";

$result = "000;"; //Fixo
$result .= "$codempresa;";   // codigo empresa o sidicom
$result .= "$codusuario;";    // codigo de usuario no sidicom
$result .= "$data;";    // data de geracao
$result .= "$versao;"; // versão
$result .= $quebralinha;


//Select do Pedido no Banco de Dados do e-commerce
$sql = "select order_id, customer_id,payment_corop_cnpg,payment_cad_cpf, shipping_code, total, comment, date_added, shipping_address_1, shipping_address_2
        shipping_city, shipping_postcode, shipping_country_id, iso_code_3 
        from " . $db_prefix . "order 
        left join " . $db_prefix . "country on (" . $db_prefix . "order.shipping_country_id = " . $db_prefix . "country.country_id) 
        where ((date_added > '$lastexport')  or (date_modified > '$lastexport')) AND order_status_id <> 0  ";



$sql = mysqli_query($conexao, $sql);

$num_rows = mysqli_num_rows($sql); /* Número de Pedidos Encontrados */
//only for testing
$customer_idd = "";
if ($num_rows > 0) {
    while ($dados = mysqli_fetch_array($sql)) {

        $shipping_cost = get_shipping_totals($dados["order_id"], $db_prefix, $conexao);

        $numpedecom = $dados["order_id"]; //REG 01
        // REG 02 - 04
        $codcliente = $dados["customer_id"]; //REG 05
        $customer_idd = $codcliente;
        //Getting customer information

        $customer_information = get_first_customer($codcliente, $db_prefix, $conexao);

        //No need now
        //customer second information
        //$customer_second_information = get_second_customer($codcliente, $db_prefix, $conexao);
        //
        // REG 06 - 08
        $codtransp = $dados["shipping_code"]; //REG 09
        //fix number
        $coditrapns_fix = "000005";
        // REG 10 - 13
        $vlrtotal = $dados["total"]; //REG 14
        // REG 15 - 17
        $vlrfrete = $shipping_cost; /* Shipping cost */ //REG 18
        // REG 19 - 23
        $numoc = ""; /* campo não identificado no database; */ //REG 24
        $observacao = $dados["comment"]; //REG 25
        //REG 26 - 27
        $dataemi = date("Ymd", strtotime($dados["date_added"])); /* converter AAAAMMDD */ //REG 28
        // REG 29 - 30
        /* repetir duas vezes na linha de registro */
        $datacriini = date("Ymd", strtotime($dados["date_added"])); /* converter AAAAMMDD */ //REG 31 e 33
        $horacriini = date("Hms", strtotime($dados["date_added"])); /* converter HHMMSS */   //REG 32 e 34
        //REG 35 - 37
        $cpfcnpj = ""; /* campo não identificado no database; */ //REG 38
        $logentrega = $dados["shipping_address_1"]; //REG 39
        $numentrega = !empty($dados["shipping_address_2"]) ? $dados["shipping_address_2"] : ""; //REG 40
        $comentrega = ""; /* campo não identificado no database; */ //REG 41
        $baientrega = ""; /* campo não identificado no database; */ //REG 42
        $cidentrega = $dados["shipping_city"]; //REG 43
        $ufentrega = ""; /* campo não identificado no database; */ //REG 44
        $cepentrega = $dados["shipping_postcode"]; //REG 45
        $paisentrega = $dados["iso_code_3"]; //REG 46


        $cpf = $dados["payment_cad_cpf"];
        $cnpj = $dados["payment_corop_cnpg"];
        $cpfcnpj = !empty($cpf) ? $cpf : $cnpj;

        /* ESCREVER REGISTRO 150 */
        $result .= "150;"; // Fixo
        $result .= "$numpedecom;"; //01
        $result .= ";;;"; // 02 - 04 : VAZIOS
        $result .= "$codcliente;"; //05
        $result .= "28;"; // 06 - 08 : VAZIOS

        $result .= ";;"; // 06 - 08 : VAZIOS
        $result .= "$coditrapns_fix;"; //09 (making it fix brian asked 13 june 2016)
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
        // debug statements
//        echo "<pre>";
//        print_r($customer_information);
//        die;

        $logentrega = !empty($customer_information['address_1']) ? utf8_decode($customer_information['address_1']) : ""; //address 1 will be for street address
        $numentrega = !empty($customer_information['payment_numero']) ? $customer_information['payment_numero'] : ""; //Numero will be here
        $comentrega = !empty($customer_information['payment_complemento']) ? $customer_information['payment_complemento'] : ""; //Complemento will be here
        $baientrega = !empty($customer_information['address_2']) ? $customer_information['address_2'] : ""; //Area Bairo
        $cidentrega = !empty($customer_information['city']) ? $customer_information['city'] : ""; //City
        $state = !empty($customer_information['state_name']) ? $customer_information['state_name'] : ""; // State
        $cep = !empty($customer_information['postcode']) ? $customer_information['postcode'] : ""; // Cep or postal code
        $country = !empty($customer_information['country_name']) ? $customer_information['country_name'] : ""; //Country name


        $result .= "$logentrega;"; //39
        $result .= "$numentrega;"; //40
        $result .= "$comentrega;"; //41
        $result .= "$baientrega;"; //42
        $result .= "$cidentrega;"; //43


        $result .= "$state;"; //44 (old $ufentrega)
        $result .= "$cep;"; //45 (old $cepentrega)
        $result .= "$country;"; //46 (old $paisentrega)
        $result .= $quebralinha;

        //Verifica se Cliente já está armazenado, senão armazena
        $key = array_search($codcliente, $reg160);
        if ($key == FALSE) {
            $reg160[] = $codcliente;
        }

        //REGISTRO 151 : PRODUTOS DO PEDIDO
        $sql2 = "select " . $db_prefix . "order_product.order_id, " . $db_prefix . "order_product.product_id, " . $db_prefix . "order_product.quantity, " . $db_prefix . "product.price as p1," . $db_prefix . "product.model as model,
                " . $db_prefix . "order_product.price as p2, total
                from " . $db_prefix . "order_product
                left join " . $db_prefix . "product on (" . $db_prefix . "product.product_id = " . $db_prefix . "order_product.product_id) 
                where " . $db_prefix . "order_product.order_id = $numpedecom";

        $sql2 = mysqli_query($conexao, $sql2);

        $num_rows2 = mysqli_num_rows($sql2); /* Número de Pedidos Encontrados */


        if ($num_rows2 > 0) {
            while ($dados2 = mysqli_fetch_assoc($sql2)) {
                //REG 01 : $numpedecom
                $codproduto = !empty($dados2["model"]) ? $dados2["model"] : $dados2["product_id"]; //REG 02
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
                $result .= "0;"; //06
                $result .= "$precotab;"; //07
                $result .= "0;"; //08
                $result .= "$precoliq;"; //09
                $result .= "$totalitem;"; //10
                $result .= "0;0;0;0;0;0;0;0;0;0;0;"; //11 - 21
                $result .= $quebralinha;
            }
        }

        /* BUSCAR DADOS DE CLIENTES DOS PEDIDOS ADICIONADOS/MODIFICADOS */
        $count = count($reg160);

        if (!empty($customer_idd)) {
            //for ($i = 0; $i < $count; $i++) {
            $sql3 = "SELECT " . $db_prefix . "customer.customer_id, " . $db_prefix . "customer.firstname, " . $db_prefix . "customer.lastname, " . $db_prefix . "address.address_1,
                 " . $db_prefix . "address.address_2, " . $db_prefix . "address.city, " . $db_prefix . "address.payment_numero," . $db_prefix . "address.payment_complemento," . $db_prefix . "address.postcode, telephone, email, " . $db_prefix . "country.iso_code_3 
                 FROM " . $db_prefix . "customer, " . $db_prefix . "address 
                 LEFT JOIN " . $db_prefix . "country on (" . $db_prefix . "country.country_id = " . $db_prefix . "address.country_id) 
                 WHERE (" . $db_prefix . "customer.customer_id = $customer_idd) and (" . $db_prefix . "address.address_id = " . $db_prefix . "customer.address_id)";

            $sql3 = mysqli_query($conexao, $sql3);
            if ($sql3) {
                while ($dados3 = mysqli_fetch_assoc($sql3)) {


                    $customer_information = get_first_customer($dados3['customer_id'], $db_prefix, $conexao);
                    //customer second information
                    $customer_second_information = get_second_customer($dados3['customer_id'], $db_prefix, $conexao);


                    $customer_name = implode(" ", array($dados3["firstname"], $dados3["lastname"]));
                    $customer_company = $customer_information['company'];

                    $customer_cpf = $customer_information["payment_cad_cpf"];
                    $customer_cnpj = $customer_information["payment_corop_cnpg"];
                    $customer_cpf_cnpj = !empty($customer_cpf) ? $customer_cpf : $customer_cpfcnpj;
                    $cusomer_payment_cad_rg = $customer_information['payment_cad_rg'];
                    $cusomer_payment_address1 = $customer_information['address_1'];
                    $cusomer_payment_complemento = $customer_information['payment_complemento'];
                    $cusomer_payment_numero = $customer_information['payment_numero'];

                    $cusomer_address2 = $customer_information['address_2']; //Biro



                    $cusomer_city = $customer_information['city']; //City
                    $cusomer_state = $customer_information['state_name']; //state_name
                    $cusomer_state_code = $customer_information['state_code']; //state code
                    $cusomer_postcode = $customer_information['postcode']; //CEP
                    $cusomer_country_name = $customer_information['country_name']; //Country

                    $cusomer_phone = $dados3['telephone']; //Phone
                    if (substr($cusomer_phone, 0, 1) != "0") {
                        $cusomer_phone = $customer_information['payment_cad_area_code'] . " " . $dados3['telephone']; //Phone
                    }
                    $cusomer_email = $dados3['email']; //Phone
                    $cusomer_website = ""; // not in database;
                    //ESCREVE REGISTRO 160
                    $result .= "160;"; // Fixo //00
                    $result .= "160;"; // Fixo //01


                    $result .= $dados3['customer_id'] . ";"; // 01 - Controle customer_id





                    $result .= $customer_name . ";"; // 03
                    $result .= "$customer_company;"; // 04: Vazio
                    $result .= "$customer_cpf_cnpj;"; // 05: CNPJ/CPF Não identificado no database
                    $result .= "$cusomer_payment_cad_rg;"; // 06: IE/RG Não identificado no database
                    $result .= $cusomer_payment_address1 . ";"; // 07

                    $result .= $cusomer_payment_numero . ";"; // 8: Numero
                    $result .= $cusomer_payment_complemento . ";"; // 09: Complemento - Não identificado no database

                    $result .= $dados3["address_2"] . ";"; //10: Bairro - Não identificado no database

                    $result .= $cusomer_city . ";"; // 11
                    $result .= "$cusomer_state_code;"; // 12: UF - Não identificado no database
                    $result .= $cusomer_postcode . ";"; // 13
                    $result .= $cusomer_country_name . ";"; // 14
                    $result .= $cusomer_phone . ";"; // 15
                    $result .= $cusomer_email . ";"; // 16
                    $result .= ";"; // 17 : site - Não identificado no database

                    if (!empty($customer_second_information) && $customer_second_information['address_id'] != $customer_information['address_id']) {
                        $result .= $customer_second_information['address_1'] . ";"; // shipping_adress
                        $result .= $customer_second_information['payment_complemento'] . ";"; //numero
                        $result .= $customer_second_information['payment_numero'] . ";"; //complemento
                        $result .= $customer_second_information['address_2'] . ";"; //Biro
                        $result .= $customer_second_information['city'] . ";"; //City
                        $result .= $customer_second_information['state_code'] . ";"; //state
                        $result .= $customer_second_information['postcode'] . ";"; //cep
                        $result .= $customer_second_information['country_name'] . ";"; //country        
                    } else {

                        $result .= ";"; // shipping_adress
                        $result .= ";"; //numero
                        $result .= ";"; //complemento
                        $result .= ";"; //Biro
                        $result .= ";"; //City
                        $result .= ";"; //state
                        $result .= ";"; //cep
                        $result .= ";"; //country
                    }

                    // 18 -25: Endereço de Cobrança
                    /*
                     * * ======= Requirment has been changed *********
                      $result .= $dados3["address_1"] . ";"; // 18
                      $result .= $dados3["address_2"] . ";"; // 19
                      $result .= ";"; // 20: Complemento - Não identificado no database
                      $result .= ";"; // 21: Bairro - Não identificado no database
                      $result .= $dados3["city"] . ";"; // 22
                      $result .= ";"; // 23: UF - Não identificado no database
                      $result .= $dados3["postcode"] . ";"; // 24
                      $result .= $dados3["iso_code_3"] . ";"; // 25
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
                     */
                    $result .= $quebralinha;
                }
            }
            //} //end of for loop
        }
    }


    $result .= "999" . $quebralinha;



    //SALVAR ARQUIVO GERADO
    $datahora = date("YmdHms");
    $nomearq = "RET_" . $datahora . ".txt";
    $result2 = mb_convert_encoding($result, "UTF-8");

    $fp = fopen("sidicom/" . $nomearq, "a");

    $escreve = fwrite($fp, $result2);

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

<html>
    <head>
        <title>..::.. Integração SIDICOM <-> ES ..::..</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="css/dropdown.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.4.min.js"></script>
        <script type="text/javascript" src="js/jquery.dropdown.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
    </head>

    <body>
        <div style="width: 100%; text-align: center;">
            <table width="70%" style="alignment-adjust: central; margin: auto;display:none">
                <tr><td>
                        <table width="100%">
                            <tr>
                                <td valign="middle" align="left"><a href="index.php"><img width="96" height="65" src="images/mtilogo.png"></a></td>
                                <td valign="middle" align="right"><font size="5" face="Oswald">Integração Sidicom/ES</font></td>
                            </tr>
                        </table>
                    </td></tr>

                <tr><td align="left">
                        <table width="100%">
                            <tr><td><a href="index.php?option=sidicom"><img src="images/sidicom.png"/></a></td>
                                <td align="center">
                                    <?php echo $mensagem; ?><br> 
                                    Data da ùltima varredura: <?php echo $lastexport; ?>
                                </td>
                            </tr>
                        </table>
                    </td></tr>
            </table>
            <form action="baixatxt.php" method="post">
                <div id="texto1" style="width: 95%; margin: auto;">
                    <textarea name="conteudo" cols="170" rows="30"><?php echo $result; ?></textarea><br><br>
                    Baixe o Arquivo Gerado <input name="submit" type="submit" class="grey" value="Baixar" />
                </div>
                <input type="hidden" name="arquivo" value="<?php echo basename($nomearq); ?>">
            </form>
        </div>    
    </body>
</html>