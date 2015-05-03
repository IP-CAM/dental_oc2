<!DOCTYPE HTML>
<?php
/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Importa os dados do Arquivo SIDICOM no ECOMMERCE 
 */
$test_s = "CER S-BASE SBA1 (10G)";

function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}
$testk = '(01010034) CZR DENTINA A4B (10G)';

include_once('chaveiro.php');

$reg300 = array();
$reg308cod = array();
$reg308sal = array();
$reg310cod = array();
$reg310psd = array();
$reg310pcd = array();

$quebralinha = "\r\n";

if (!isset($_GET["filename"])) {
    $_GET["filename"] = "";
};

$filename = $_GET["filename"];
$sidicom_file = $filename;

if ($filename == "") {
    /* Busca pelo arquivo mais recente sem LOG */
    $pasta = './ecommerce/';

    if (is_dir($pasta)) {
        $diretorio = dir($pasta);

        while ($arquivo = $diretorio->read()) {
            if ($arquivo != '..' && $arquivo != '.') {
                #Cria um Arrquivo com todos os Arquivos encontrados
                $arrayArquivos[date("Y/m/d H:i:s", filemtime($pasta . $arquivo))] = $pasta . $arquivo;
            }
        }
        $diretorio->close();
    }

    #Classificar os arquivos para a Ordem Decrescente
    krsort($arrayArquivos, SORT_STRING);

    #Checa qual mais recente não tem LOG
    foreach ($arrayArquivos as $valorArquivos) {
        //echo '<a href='.$pasta.$valorArquivos.'>'.$valorArquivos.'</a><br />';
        /* procura arquivo de log */
        $logfilename = basename($valorArquivos, ".txt");
        $logfilename = "ecommerce/log/" . $logfilename . ".log";

        if (Is_Dir($valorArquivos) == FALSE) {
            if (file_exists($logfilename) == FALSE) {
                $filename = $valorArquivos;
                break;
            }
        }
    }
} else {
    $filename = 'ecommerce/' . $filename;
}

/* ABRE LOG  Com data de Início */
if (!isset($_GET["showlog"])) {
    $_GET["showlog"] = "";
}

$showlog = $_GET["showlog"];

$logfilename = basename($filename, ".txt");
$logfilename = "ecommerce/log/" . $logfilename . ".log";

$logfile = fopen($logfilename, 'a');

$linha = "0000;" . date('Y-m-d H:i:s') . ";" . basename($filename) . ";" . $quebralinha;
fwrite($logfile, $linha);





if (file_exists($filename)) {
    $lines = file($filename);
    foreach ($lines as $line_num => $line) {

        $pos = strpos($line, ';');
        $sub = substr($line, 0, $pos);

        if ($sub == '300') {
            $reg300[] = $line;
        }

        if ($sub == '308') {
            $campos = explode(";", $line);
            $reg308cod[] = $campos[3];
            $reg308sal[] = $campos[4];
        }

        if ($sub == '310') {
            $campos = explode(";", $line);
            $reg310cod[] = $campos[2];
            $reg310psd[] = $campos[4];
            $reg310pcd[] = $campos[6];
        }
    }
} else { /* Nenhum Arquivo encontrado - Escreve no Log */
    $linha = "000E;" . "Nenhum Arquivo Encontrado;" . $quebralinha;
    fwrite($logfile, $linha);
}


/* ATUALIZAR DADOS DOS PRODUTOS, PREÇOS E QUANTIDADES */
$count = count($reg300);
/* Escreve Log */
$linha = "300T;" . $count . ";" . $quebralinha;
fwrite($logfile, $linha);
$linha = "308T;" . count($reg308cod) . ";" . $quebralinha;
fwrite($logfile, $linha);
$linha = "310T;" . count($reg310cod) . ";" . $quebralinha;
fwrite($logfile, $linha);

$atualizados = 0;
$inseridos = 0;

$test = array();

for ($i = 0; $i < $count; $i++) {
    $linha = "";
    $campos = explode(";", $reg300[$i]);

    $prodcod = $campos[2];

    if ($campos[8] = 'A') {
        $prodsit = '1';
    }
    if ($campos[8] = 'I') {
        $prodsit = '0';
    }
    //$prodsit = $campos[8];
    $proddes = mysql_escape_string(utf8_encode($campos[9]));  /* ida_product_description */
    $unique_name = $proddes;

    $product_name = $proddes;
    $group_name = $proddes;
    echo $proddes;
    echo "<br/>";
    echo substr($proddes, strlen($proddes) - 1, strlen($proddes));
    echo "<br/>";

    preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $proddes, $out);
    echo "<pre>";
    print_r($out[0]);
    echo "</pre>";
    echo "<br/>";
    
    if(!empty($out) && $out[0]){
       $product_name = str_replace_first($out[0][0],"",$proddes); 
       if(!empty($out[0][1])){
           $product_name = str_replace_first($out[0][1],"",$product_name); 
           $product_arr = explode(' ',$product_name);
//           $product_arr = array_filter($product_arr);
           unset($product_arr[count($product_arr)-1]);
           $product_name = implode(" ",$product_arr);
           $group_name = substr($product_name,0,strlen($product_name)-1);
           $group_name = trim($group_name);
       }
       else {
           $group_split = explode(" ",$proddes);
           if (count($group_split) == 8) {
                unset($group_split[7]);
                unset($group_split[6]);
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else if (count($group_split) == 7) {
                unset($group_split[6]);
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else if (count($group_split) == 6) {
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else {
                $group_name = substr($product_name, 0, strlen($product_name) - 1);
            }
            
            $group_name = str_replace_first($out[0][0], "", $group_name);
            $group_name = trim($group_name);
       }
    }
    //implementing new algo
//    if (substr($proddes, strlen($proddes) - 1, 1) == ")") {
//        $product_arr = explode(" ", $proddes);
//        $product_arr = array_filter($product_arr);
//        echo "<pre>";
//        print_r($product_arr);
//        echo "</pre>";
//        unset($product_arr[count($product_arr) - 1]);
//        unset($product_arr[count($product_arr) - 1]);
//        unset($product_arr[0]);
//        $product_name = implode(" ", $product_arr);
//    } else if (substr($proddes, 0, 1) == '(') {
//        $product_arr = explode(" ", $proddes);
//        $product_arr = array_filter($product_arr);
//        echo "<pre>";
//        print_r($product_arr);
//        echo "</pre>";
//        unset($product_arr[0]);
//        $product_name = implode(" ", $product_arr);
//    }
    echo "---------product-----------";
    echo "<br/>";
    $prodpbr = $campos[17];
    $prodpli = $campos[18]; /* weight_net */
    $prodlar = $campos[28];
    $prodcom = $campos[29];
    $prodalt = $campos[30];
    $prodcub = $campos[31]; /* cubage */
    $prodare = $campos[32]; /* square_meters */
    $prodgen = mysql_escape_string($campos[33]); /* ida_product_description */

    $product_model = '';
    if (isset($campos[9])) {
        $product_model = mysql_escape_string($campos[9]);
        $product_model = explode(")", $product_model);
        $product_model = substr($product_model[0], 1, strlen($product_model[0]));
    }


    $test[$proddes] = $proddes;
    ;


    /* outros campos advindos necessários */
    $prodstk = 7;

    /* Busca Por Estoque do Produto e Soma */
    $keyvet = array_keys($reg308cod, $prodcod);
    $count2 = count($keyvet);
    $prodsal = 0;
    for ($j = 0; $j < $count2; $j++) {
        $prodsal += $reg308sal[$keyvet[$j]];
    }
    /* Fim Busca Estoque */

    /* Busca Por Preço do Produto */
    $key = array_search($prodcod, $reg310cod);
    if ($key != FALSE) {
        $prodpsd = $reg310psd[$key];
        $prodpcd = $reg310pcd[$key];
    }
    /* Fim Busca Preço */

    /* Procura por Produto */
    echo "<br/>";
    $sql = "SELECT * FROM  " . $db_prefix . "product where unique_name = '$proddes'";
    echo $sql;
    echo "<br/>";
    $sql_res = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($sql_res) > 0) {
        $row = mysqli_fetch_assoc($sql_res);
        $product_id_get = $row['product_id'];
        /* Realiza Update no Banco de Dados E-Commerce */
        echo $sql = "UPDATE " . $db_prefix . "product SET model = '$product_model',sku = '$product_model', status = $prodsit, quantity = $prodsal, price = $prodpsd, date_modified = Now()"
        . " WHERE product_id = $product_id_get";
        if ($sql = mysqli_query($conexao, $sql)) {
            echo "<br/>";
            echo "-------success----------";
            echo "<br/>";
        } else {
            echo "<br/>";
            echo "-------faeilure----------";
            echo "<br/>";
        }

        $atualizados++;
    } else {
        //get maximum id

        echo $sql_max = "SELECT MAX(product_id) as max_id FROM " . $db_prefix . "product";
        echo "<br/>";
        $res_max = mysqli_query($conexao, $sql_max);
        $_max = mysqli_fetch_array($res_max, MYSQLI_NUM);

        $product_cus_id = $_max[0] + 1;

        //find reference_id 

        echo $ref_sql = "SELECT product_id FROM " . $db_prefix . "product_description WHERE name = '$product_name' AND product_id <> $product_cus_id order by product_id ASC limit 1";
        echo "<br/>";
        $ref_data = mysqli_query($conexao, $ref_sql);
        $_ref_data = mysqli_fetch_array($ref_data, MYSQLI_NUM);
        $reference_id = NULL;
        echo "<pre>";
        print_r($_ref_data);
        echo "</pre>";


        /* Realiza Inserção no Banco de Dados */
        echo $sql = "INSERT INTO " . $db_prefix . "product (product_id,unique_name,group_name,model,sku, status, weight, weight_net, width, length, height, cubage, square_meters, quantity, price, date_added, stock_status_id, date_available,sidicom_file,total_count)"
        . " VALUES($product_cus_id,'$unique_name','$group_name','$product_model','$product_model', $prodsit, $prodpbr, $prodpli, $prodlar, $prodcom, $prodalt, $prodcub, $prodare, $prodsal, $prodpsd, Now(), $prodstk, date(Now()),'$sidicom_file','$count')";

        if ($res = mysqli_query($conexao, $sql)) {
            echo "<br/>";
            echo "-------success----------";
            echo "<br/>";
            if (!empty($_ref_data)) {
                $reference_id = $_ref_data[0];
                echo "<br/>";
                echo $updat_ref_sql = "UPDATE " . $db_prefix . "product SET reference_id = $reference_id";
                echo "<br/>";
                mysqli_query($conexao, $updat_ref_sql);
            }
        } else {
            echo "<br/>";
            echo "-------faeilure----------";
            echo "<br/>";
        }

        if (mysqli_affected_rows($conexao) > 0) {
            /* Insere o detalhamento */


            echo $sql = "INSERT INTO " . $db_prefix . "product_description (product_id, language_id, name, description, meta_description, meta_keyword, tag)"
            . " VALUES ($product_cus_id, 2, '$product_name', '$prodgen', '', '', '')";
            if ($sql = mysqli_query($conexao, $sql)) {

                echo "<br/>";
                echo "-------success----------";
                echo "<br/>";
            } else {
                echo "<br/>";
                echo "-------faeilure----------";
                echo "<br/>";
            }
            /* Insere no store */
            echo $sql = "INSERT INTO " . $db_prefix . "product_to_store (product_id, store_id) VALUES ($product_cus_id ,0)";
            if ($sql = mysqli_query($conexao, $sql)) {
                echo "<br/>";
                echo "-------success----------";
                echo "<br/>";
            } else {
                echo "<br/>";
                echo "-------faeilure----------";
                echo "<br/>";
            }
            $inseridos++;
        } else {
            $linha = "300E;" . $prodcod . ";" . $quebralinha;
            fwrite($logfile, $linha);
        }
    }
    echo "<br/>";
    echo "============----------------===============";
    echo $i;
    echo "============----------------===============";
}
echo "<br/>";
echo "============--------[]--------===============";
echo count($test);
echo "============--------[]--------===============";
/* Finaliza Dados */
$linha = "999I" . $inseridos . ";" . $quebralinha;
fwrite($logfile, $linha);
$linha = "999U" . $atualizados . ";" . $quebralinha;
fwrite($logfile, $linha);

/* Finaliza Arquivo */
$linha = "9999;" . date('Y-m-d H:i:s') . ";" . basename($filename) . ";" . $quebralinha;
fclose($logfile);

/* Verificar se log vai ser exibido */
if ($showlog == "1") {
    $loglines = file($logfilename);
    foreach ($loglines as $logline_num => $logline) {
        echo $logline;
        echo "<br>";
    }
}
?>