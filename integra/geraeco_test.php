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

$test_names = array();
$test_models = array();

for ($i = 0; $i < $count; $i++) {
    
    $campos = explode(";", $reg300[$i]);
    $proddes = mysql_escape_string(utf8_encode($campos[9]));  /* ida_product_description */
    $unique_name = $proddes;

    $product_model = '';
    if (isset($campos[2])) {
        $product_model = mysql_escape_string($campos[2]);        
    }


    $test_names[$proddes] = $proddes;
    $test_models[$product_model] = $product_model;
   
    
}
echo "<br/>";
echo "============--------[]--------===============";
echo count($test_names);
echo "============--------[]--------===============";
echo "<br/>";
echo "============--------[]--------===============";
echo count($test_models);
echo "============--------[]--------===============";

?>