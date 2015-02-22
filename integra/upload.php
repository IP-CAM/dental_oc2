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

  
if (!isset($_POST['Enviar'])) { $_POST['Enviar'] = 0; };
$Enviar = $_POST['Enviar'];

if ($Enviar == 1) {

    $arquivo = $_FILES["arquivo"];
    $pasta   = "ecommerce/";
    $destino = $pasta.$arquivo['name'];

    if ($erro == 0) {
        if (move_uploaded_file($arquivo['tmp_name'],$destino)) { 
            $mensagem = "Arquivo Gravado com Sucesso!";
        } else {
            $mensagem = "Problema no Upload!".$destino;
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
        
        <tr><td align="left">
                <div class="caixa">
                    <a href="index.php?option=ecommerce"><img width="83" height="40" alt="" src="images/lojaodoalemao.png"/></a>
                </div>
       </td></tr>
       <tr><td>
           <div class="caixa">
               <div class="base">
                    <div class="dados">                     
                        <form method="post" action="upload.php" enctype="multipart/form-data">        
                        <div style="border: 1px solid #242424; text-align: center; color: #242424;">
                            <br>
                            <h4>Selecione o arquivo para Upload</h4>
                            <br>
                            <div><input type="file" name="arquivo"><br><br>
                                 <button class="grey" style="float: none;">&nbsp;&nbsp;Enviar&nbsp;&nbsp;</button>
                            </div>
                            <div><?php echo $mensagem; ?> </div>
                            <br><br>
                            <input type="hidden" name="Enviar" value="1" />
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
