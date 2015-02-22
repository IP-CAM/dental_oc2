<?php
/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Exibir Dados do Arquivo Sidicom e Preparar para Atualizar Ecommerce
 * 
 */

$mensagem = "";
$erro = 0;

  
if (!isset($_POST['Excluir'])) { $_POST['Excluir'] = 0; }
$Excluir = $_POST['Excluir'];

$arquivo = $_GET["filename"];

if ($Excluir == 1) {
    
    $arquivo = $_POST["arquivo"];

    if ($erro == 0) {
        unlink($arquivo);
        
        if (strpos($arquivo, "ecommerce")) {
            /* procura arquivo de log */
            $logfilename = basename($filename, ".txt");
            $logfilename = "ecommerce/log/".$logfilename.".log";

            if (file_exists($logfilename)) { unlink($logfilename); }

            header("location:index.php?option=ecommerce");
        } elseif (strpos($arquivo, "sidicom")) {
            /* procura arquivo de log */
            $logfilename = basename($filename, ".txt");
            $logfilename = "sidicom/log/".$logfilename.".log";
            
            if (file_exists($logfilename)) { unlink($logfilename); }
            
            header("location:index.php?option=sidicom");
        }
    }
} 
?>
<html>
<head>
<title>..::.. Integração SIDICOM <-> O Lojão do Alemão ..::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/estilo.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/dropdown.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen" />
<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
<script>
$(document).ready(function() { 
    $("table") 
    .tablesorter({widthFixed: true, headers:{3:{sorter: false}}, widgets: ['zebra']}) 
    .tablesorterPager({container: $("#pager")}); 
	$(".linkexcluir").click(function(){
		if (!confirm("Tem certeza que deseja excluir?")){
		return false;}
	});
});
</script>
<style type="text/css">
    body { margin: 0px; text-align: center;}   
</style>
</head>
   
<body>
<div id="conteudo" style="margin-top: 30px;">
    <table width="100%">
        <tr><td>
                <table width="100%">
                    <tr>
                        <td valign="middle" align="left"><a href="index.php"><img width="96" height="65" src="images/mtilogo.png"></a></td>
                        <td valign="middle" align="right"><font size="5" face="Oswald">Integração Sidicom/Lojão do Alemão</font></td>
                    </tr>
                </table>
        </td></tr>
       <tr><td>
           <div class="caixa">
               <div class="base">
                    <div class="dados">                     
                        <form method="post" action="excluir.php">        
                        <div style="border: 1px solid #242424; text-align: center; color: #242424;">
                            <br>
                            <h4>Tem certeza que deseja exluir o arquivo?</h4>
                            <br>
                            <div><?php echo $arquivo; ?><br><br>
                                 <button class="grey" style="float: none;">&nbsp;&nbsp;Excluir&nbsp;&nbsp;</button>
                                 <br><br>
                            </div>
                            <div><?php echo $mensagem; ?> </div>
                            <input type="hidden" name="arquivo" value="<?php echo $arquivo; ?>" />
                            <input type="hidden" name="Excluir" value="1" />
                        </div>
                        </form>       
                    </div>
                </div>
            </div>
        </td></tr>
    </table>
</div>
</body>
</html>
