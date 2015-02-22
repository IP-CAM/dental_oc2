<?php
/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Página principal com Opções:
 *  - Listar Arquivos Sidicom
 *  - Listar Arquivos E-commerce
 *  - Configurações
 * 
 */

require_once('verifica.php');

$usuario = $_SESSION['usuario_sistema'];

if ($usuario == "") {
    header("Location:login.php");
}


if (!isset($_GET['option'])) { $_GET['option'] = 'index'; };

$option = $_GET['option'];

//Ler arquivo de Configuração
$pastasidicom = "sidicom/";
$pastaecommerce = "ecommerce/";

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
<div id="conteudo">
    <table width="100%">
        <tr><td>
                <table width="100%">
                    <tr>
                        <td valign="middle" align="left">
                            <a href="index.php"><img width="96" height="65" src="images/mtilogo.png"></a><br>
                        </td>
                        <td valign="middle" align="right"><font size="5" face="Oswald">Integração Sidicom/Lojão do Alemão</font></td>
                    </tr>
                </table>
        </td></tr>
        
        <tr><td align="left">
                <div class="caixa">
                 <?php if ($option == 'ecommerce') {  ?>
                    <img width="83" height="40" src="images/lojaodoalemao.png"/>
                 <?php } ?>
                 <?php if ($option == 'sidicom') {  ?>
                    <img src="images/sidicom.png"/>
                 <?php } ?>
                </div>
       </td></tr>
       <?php if (($option == 'sidicom') or ($option == 'ecommerce')) {  ?>
        <tr><td style="padding-left: 25px; padding-right: 27px;">
                <div class="busca">		
                <?php $arquivo = trim($_GET['arquivo']); ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    Arquivo: <input type="text" name="arquivo" id="arquivo" class="buscacampo" value="<?php echo $arquivo; ?>" size="50" />&nbsp;
                    <input type="submit" value=" Localizar " class="buscabotao" />
                </form>
                </div>
        </td></tr>
        <?php } ?>
       <tr><td>
           <div class="caixa">
                <div class="barra">
                    <?php if ($option == 'ecommerce') {  ?>
                    <h1><img src="images/cadastro.gif" border="0" align="absmiddle" />&nbsp;<a href="upload.php" title="Upload File">Carregar Arquivo do Sidicom</a></h1>
                    <?php } ?>
                    <?php if ($option == 'sidicom') {  ?>
                    <h1><img src="images/cadastro.gif" border="0" align="absmiddle" />&nbsp;<a href="gerasidicom.php" title="Gera Sidicom">Gerar Arquivo para o Sidicom</a></h1>
                    <?php } ?>
                </div>
               <div class="base">
                    <div class="dados">
                     <?php if ($option == 'index') {  ?>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center"><a href="index.php?option=ecommerce"><img src="images/lojaodoalemao.png"/></a></td>
                            <td width="50%" align="center"><a href="index.php?option=sidicom"><img src="images/sidicom.png"/></a></td>
                        </tr>
                    </table>
                    <?php } ?>
                        
                    <?php if (($option == 'sidicom') or ($option == 'ecommerce')) {  ?>
                        <div class="paginacao_navegacao">
                            <div id="pager" class="pager">
                                <form>
                                    <img src="images/tablesorter/first.png" class="first" alt="Primeira" />
                                    <img src="images/tablesorter/prev.png" class="prev" alt="Anterior" />
                                    <input type="text" size="10" class="pagedisplay"/>
                                    <img src="images/tablesorter/next.png" class="next" alt="Próxima" />
                                    <img src="images/tablesorter/last.png" class="last" alt="Última" />
                                    &nbsp;Exibir:&nbsp;
                                    <select class="pagesize">
                                            <option selected="selected"  value="10">10&nbsp;</option>
                                            <option value="20">20&nbsp;</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <table class="tablesorter">
                        <thead> 
                            <tr> 
                                <th width='380'>Arquivo</th> 
                                <th width='90' align='center'>Modificado</th> 
                                <th width='90' align='center'>Situação</th>
                                <th width='90' align='center'>Opções</th>
                            </tr> 
                        </thead>
                        <?php } ?>
                        <tbody>
                        <?php 
                        if ($option == 'sidicom') { //Lista Arquivos na Pasta que foram exportados pelo Sidicom  
                            if(is_dir($pastasidicom)) {
                                // atribuição a variável $dir
                                $dir = new DirectoryIterator($pastasidicom);
                                // atribui o valor de $dir para $file em loop 
                                foreach($dir as $file )
                                {
                                  // verifica se o valor de $file é diferente de '.' ou '..'
                                  // e é um diretório (isDir)
                                  
                                  if ((!$file->isDot()) and (!$file->isDir()))
                                  {
                                    // atribuição a variável $dname
                                    $dname = $file->getFilename();
                                    $updtime = $file->getCTime();
                                    $filename = $file->getRealPath();
                                    
                                    $logfilename = basename($filename, ".txt");
                                    $logfilename = "sidicom/log/".$logfilename.".log";
                                    
                                    if (file_exists($logfilename)) {
                                        $situacao = "Importado";
                                        $loglink = "<a href='view.php?filename=$logfilename' target='_blank'><img src='images/editar.jpg' alt='Ver Log' title='Ver Log'></a>";
                                    } else {
                                        $situacao = "";
                                        $loglink = "";
                                    }
                                    
                                    
                        ?>
                                    <tr> 
                                        <td width='380'><a href="viewecotosid.php?filename=<?php echo $filename; ?>"><?php echo $dname; ?></a></td> 
                                        <td width='100' align='center'><?php echo date("d-m-Y H:i:s", $updtime); ?></td> 
                                        <td width='90' align='center'><?php echo $situacao; ?></td>
                                        <td width='90' align='center'><a href="view.php?filename=<?php echo $filename; ?>" target="_blank"><img src="images/analisar.png" alt="Visualizar" title="Visualizar"></a>&nbsp;&nbsp;<?php echo $loglink; ?>&nbsp;&nbsp;<a href="excluir.php?filename=<?php echo $filename; ?>" target="_self"><img src="images/excluir.jpg" alt="Excluir" title="Excluir"></a></td>
                                    </tr> 
                        <?php
                                  }
                                }
                            } else { echo "<script>alert('Não foi possível encontrar a pasta SIDICOM.');</script>"; }
                        }
                        ?>
                        <?php
                        if ($option == 'ecommerce') { //Lista Arquivos na Pasta que foram exportados pelo E-commerce
                            if(is_dir($pastaecommerce)) {
                                // atribuição a variável $dir
                                $dir = new DirectoryIterator($pastaecommerce);
                                // atribui o valor de $dir para $file em loop 
                                foreach($dir as $file )
                                {
                                  // verifica se o valor de $file é diferente de '.' ou '..'
                                  // e é um diretório (isDir)
                                  
                                  if ((!$file->isDot()) and (!$file->isDir()))
                                  {
                                    // atribuição a variável $dname
                                    $dname = $file->getFilename();
                                    $updtime = $file->getCTime();
                                    $filename = $file->getRealPath();
                                    
                                    $logfilename = basename($filename, ".txt");
                                    $logfilename = "ecommerce/log/".$logfilename.".log";
                                    
                                    if (file_exists($logfilename)) {
                                        $situacao = "Importado";
                                        $loglink = "<a href='view.php?filename=$logfilename' target='_blank'><img src='images/editar.jpg' alt='Ver Log' title='Ver Log'></a>";
                                    } else {
                                        $situacao = "";
                                        $loglink = "";
                                    }
                        ?>
                                    <tr> 
                                        <td width='380'><a href="sidtoeco.php?filename=<?php echo $dname; ?>"><?php echo $dname; ?></a></td>
                                        <td width='100' align='center'><?php echo date("d-m-Y H:i:s", $updtime); ?></td> 
                                        <td width='90' align='center'><?php echo $situacao; ?></td>
                                        <td width='90' align='center'><a href="view.php?filename=<?php echo $filename; ?>" target="_blank"><img src="images/analisar.png" alt="Visualizar" title="Visualizar"></a>&nbsp;&nbsp;<?php echo $loglink; ?>&nbsp;&nbsp;<a href="excluir.php?filename=<?php echo $filename; ?>" target="_self"><img src="images/excluir.jpg" alt="Excluir" title="Excluir"></a></td>
                                    </tr> 
                        <?php
                                  }
                                }
                            } else { echo "<script>alert('Não foi possível encontrar a pasta SIDICOM.');</script>"; }
                        }
                        ?>
                        
                        </tbody> 
                        </table>
                        <?php if (($option == 'sidicom') or ($option == 'ecommerce')) {  ?>
                        <div>Total de Arquivos: <strong><?php echo count($dir); ?></strong></div>
                        <?php } ?>
                    </div>
                </div>
               <br>
               <p style="font-size: 8pt;"><a href="logout.php">Sair</a></p>
            </div>
        </td></tr>
    </table>
</div>

    
</body>
</html>
        