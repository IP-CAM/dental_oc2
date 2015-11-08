<?php
/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Exibir Dados do Arquivo Sidicom e Preparar para Atualizar Ecommerce
 * 
 */

/*
 *  300 - Produto
 *  308 - Produto Estoque
 *  310 - Produto Preço 
 */

$reg300 = array();
$reg308 = array();
$reg310 = array();

$mensagem = "";

$filename = $_GET["filename"];


/* procura arquivo de log */
$logfilename = basename($filename, ".txt");
$logfilename = "ecommerce/log/".$logfilename.".log";

if (file_exists($logfilename)) {
    $situacao = "Importado";
    $loglink = "<a href='view.php?filename=$logfilename' target='_blank'>Ver Log</a>";
    $runlink = "<a href='geraeco.php?filename=$filename&showlog=1' target='_blank'>Importar Novamente</a>";
} else {
    $situacao = "Não Importado";
    $loglink = "";
    $runlink = "<a href='geraeco.php?filename=$filename&showlog=1' target='_blank'>Importar Todos</a>";
}

$filename = 'ecommerce/'.$filename;



if (file_exists($filename)) {
   $lines = file($filename);
   foreach ($lines as $line_num => $line) {
       $pos = strpos($line, ';');
       $sub = substr($line, 0, $pos);
       
       if ($sub == '300') {
           $reg300[] = $line;
       }
       
       if ($sub == '308') {
           $reg308[] = $line;
       }
       
       if ($sub == '310') {
           $reg310[] = $line;
       }
    }
    
}
//echo "<pre>";
//    print_r($reg300);
//    print_r($reg308);
//    print_r($reg310);
//echo "</pre>";
//die;
//echo count($lines);
//die;
?>
<html>
<head>
<title>..::.. Integração SIDICOM <-> O Lojão do Alemão ..::..</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/estilo.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/dropdown.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/carregador.css">
<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
<script language="JavaScript" src="js/carregador.js"></script>
<script>
$(function(){
$('.tablesorter').tablesorter({
    	headers: {
            3: { sorter: false },
            4: { sorter: false },
            5: { sorter: false },
            6: { sorter: false },
            7: { sorter: false },
            8: { sorter: false },
        }
    });
});

</script>

<style type="text/css">
    body { margin: 0px; text-align: center;}   
</style>

</head>
   
<body onload="__loadEsconde();">
<div id="carregador_pai">
<div id="carregador">
<div align="center">Aguarde carregando ...</div>
<div id="carregador_fundo"><div id="barra_progresso"> </div></div>
</div>
</div>

<div style="width: 100%; text-align: center;">     

<br>  
    
<div style="width: 50%; margin: auto;">
    <table class="tabela">
        <tr><td colspan="2" align="center">Totais do Arquivo -> <?php echo basename($filename); ?></td></tr>
        <tr>
            <td><a href="#produtos">Total de Registros 300 - Produtos</a></td>
            <td><?php  if (count($reg300) > 2000) {
                            $mensagem = "  (exibindo 2000 registros)";
                        }
                            else { $mensagem = ""; }
                            
                        echo count($reg300); echo $mensagem; ?>
            </td>
        </tr>
        <tr>
            <td><a href="#estoque">Total de Registros 308 - Estoque</a></td>
            <td><?php  if (count($reg308) > 2000) {
                            $mensagem = "  (exibindo 2000 registros)";
                        }
                            else { $mensagem = ""; }
            
                        echo count($reg308); echo $mensagem; ?></td>
        </tr>
        <tr>
            <td><a href="#estoque">Total de Registros 310 - Preço</a></td>
            <td><?php   if (count($reg300) > 2000) {
                            $mensagem = "  (exibindo 2000 registros)";
                        }
                            else { $mensagem = ""; }
            
                        echo count($reg310); echo $mensagem; ?></td>
        </tr>
        <tr>
            <td>
                Situação: <?php echo $situacao; ?>
            </td>
            <td align="center">
                <?php echo $loglink; ?>
                &nbsp;&nbsp;
                <?php echo $runlink; ?>
                &nbsp;&nbsp;
                <a href="javascript: history.back();">Voltar</a>
            </td>
        </tr>
    </table>
    
</div>

<br>

<div>Produtos</div>

<div style="width: 95%; height: auto; max-height: 500px; overflow-y: scroll; margin:auto;" id="produtos">
    <table class="tablesorter">
        <thead>
            <tr>    
                <th>Código</th>
                <th>Status</th>
                <th>Descrição</th>
                <th>P. Bruto</th>
                <th>P. Líquido</th>
                <th>Largura</th>
                <th>Comprimento</th>
                <th>Altura</th>
                <th>Cubagem(m3)</th>
                <th>Área(m2)</th>
                <th>Nome Genérico</th>
            </tr>
        </thead>
        
        <!-- VARRER REGISTROS -->
        
        <?php
            $count = count($reg300);
            if ($count > 5000) { $count = 5000;}
            for($i=0;$i<$count;$i++)
            {
              $campos = explode(";", $reg300[$i]);
              $prodcod = $campos[2];
              $prodsit = $campos[8];
              $proddes = $campos[9];
              $prodpbr = $campos[17];
              $prodpli = $campos[18];
              $prodlar = $campos[28];
              $prodcom = $campos[29];
              $prodalt = $campos[30];
              $prodcub = $campos[31];
              $prodare = $campos[32];
              $prodgen = $campos[33];
        ?>
        
        <tr>
            <td align="right"><?php echo $prodcod; ?></td>
            <td align="center"><?php echo $prodsit; ?></td>
            <td><?php echo mb_convert_encoding($proddes, 'UTF-8'); ?></td>
            <td align="right"><?php echo $prodpbr; ?></td>
            <td align="right"><?php echo $prodpli; ?></td>
            <td align="right"><?php echo $prodlar; ?></td>
            <td align="right"><?php echo $prodcom; ?></td>
            <td align="right"><?php echo $prodalt; ?></td>
            <td align="right"><?php echo $prodcub; ?></td>
            <td align="right"><?php echo $prodare; ?></td>
            <td align="right"><?php echo mb_convert_encoding($prodgen, 'UTF-8'); ?></td>
        </tr>
        <?php  }  ?>
    </table>
</div>

<br>
<br>

<div style="width: 95%; height: 30px; margin: auto; border-top: 2px solid #486CAE;"></div>

<div style="width: 95%; margin:auto;" id="estoque">
    
    <table width="100%">
        <tr>
            <td width="48%" valign="top" align="center">
                
                <div>Estoque</div>
                
                <div style="width: 100%; height: auto; max-height: 500px; overflow-y: scroll; text-align: center;">

                    <table class="tablesorter">
                        <thead>
                            <tr>    
                                <th>Código</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>

                        <!-- VARRER REGISTROS -->

                        <?php
                            $count = count($reg308);
                            if ($count > 5000) { $count = 5000; }
                            for($i=0;$i<$count;$i++)
                            {
                              $campos = explode(";", $reg308[$i]);
                              $prodcod = $campos[3];
                              $prodsal = $campos[4];
                        ?>

                        <tr>
                            <td align="right"><?php echo $prodcod; ?></td>
                            <td align="right"><?php echo $prodsal; ?></td>
                        </tr>
                        <?php  }  ?>
                    </table>
                </div>
            </td>
            <td width="4%"></td>
            <td width="48%" valign="top" align="center">
                <div>Preços</div>
                <div style="width: 100%; height: auto; max-height: 500px; overflow-y: scroll; text-align: center;">

                    <table class="tablesorter">
                        <thead>
                            <tr>    
                                <th width="33%">Código</th>
                                <th width="33%">Preço s/ Desc</th>
                                <th width="33%">Preço c/ Desc</th>
                            </tr>
                        </thead>

                        <!-- VARRER REGISTROS -->

                        <?php
                            $count = count($reg310);
                            if ($count > 5000) { $count = 5000; }
                            for($i=0;$i<$count;$i++)
                            {
                              $campos = explode(";", $reg310[$i]);
                              $prodcod = $campos[2];
                              $prodpsd = $campos[4];
                              $prodpcd = $campos[6];
                        ?>

                        <tr>
                            <td align="right"><?php echo $prodcod; ?></td>
                            <td align="right"><?php echo $prodpsd; ?></td>
                            <td align="right"><?php echo $prodpcd; ?></td>
                        </tr>
                        <?php  }  ?>
                    </table>
                </div>
            </td>
            
        </tr>
        
    </table>
    
</div>

</div>
    
</body>
</html>

