<?php

/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Visualizar Arquivo
 * 
 */


if (!isset($_GET['filename'])) { $_GET['filename'] = ''; };

$filename = $_GET['filename'];
$conteudo = "";

if (file_exists($filename)) {
   $lines = file($filename);
   foreach ($lines as $line_num => $line) {
        $conteudo .= htmlspecialchars($line);
    }
} else {
    $conteudo = "$filename não foi encontrado";
}

?>
<html>
<head>
<title>..::.. Integração SIDICOM <-> O Lojão do Alemão ..::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
    body { margin: 0px; text-align: center; font-size: 9pt; font-family: sans-serif;}   
</style>
</head>
   
<body>
    <br>
    <p>Conteúdo do Arquivo: <?php echo $filename; ?></p>
    <div style="width: 100%; text-align:center;">
        <div style="margin: auto; width: 95%; text-align: left;">
            <?php echo $conteudo; ?>
        </div>
    </div>
</body>
</html>
