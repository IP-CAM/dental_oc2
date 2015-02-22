<!DOCTYPE HTML>
<?php
if (!isset($_GET["filename"])) {
    $_GET["filename"] = "";
};

$pedidos = "";
$produtos = "";
$clientes = "";

$filename = $_GET["filename"];

if (file_exists($filename)) {
    $lines = file($filename);
    foreach ($lines as $line_num => $line) {

        $pos = strpos($line, ';');
        $sub = substr($line, 0, $pos);

        if ($sub == '150') {
            $campos = explode(";", $line);
            $pedidos .= "<tr>";
            $pedidos .= "<td>".$campos[1]."</td>";
            $pedidos .= "<td>".$campos[5]."</td>";
            $pedidos .= "<td>".$campos[9]."</td>";
            $pedidos .= "<td>".$campos[14]."</td>";
            $pedidos .= "<td>".$campos[18]."</td>";
            $pedidos .= "<td>".$campos[24]."</td>";
            $pedidos .= "<td>".$campos[25]."</td>";
            $pedidos .= "<td>".$campos[28]."</td>";
            $pedidos .= "<td>".$campos[31]."</td>";
            $pedidos .= "<td>".$campos[32]."</td>";
            $pedidos .= "<td>".$campos[33]."</td>";
            $pedidos .= "<td>".$campos[34]."</td>";
            $pedidos .= "<td>".$campos[38]."</td>";
            $pedidos .= "<td>".$campos[39]."</td>";
            $pedidos .= "<td>".$campos[40]."</td>";
            $pedidos .= "<td>".$campos[41]."</td>";
            $pedidos .= "<td>".$campos[42]."</td>";
            $pedidos .= "<td>".$campos[43]."</td>";
            $pedidos .= "<td>".$campos[44]."</td>";
            $pedidos .= "<td>".$campos[45]."</td>";
            $pedidos .= "<td>".$campos[46]."</td>";
            $pedidos .= "</tr>";            
        }

        if ($sub == '151') {
            $campos = explode(";", $line);
            $produtos .= "<tr>";
            $produtos .= "<td>".$campos[1]."</td>";
            $produtos .= "<td>".$campos[2]."</td>";
            $produtos .= "<td>".$campos[5]."</td>";
            $produtos .= "<td>".$campos[7]."</td>";
            $produtos .= "<td>".$campos[9]."</td>";
            $produtos .= "<td>".$campos[10]."</td>";
            $produtos .= "</tr>";   
        }

        if ($sub == '160') {
            $campos = explode(";", $line);
            $clientes .= "<tr>";
            $clientes .= "<td>".$campos[2]."</td>";
            $clientes .= "<td>".$campos[3]."</td>";
            $clientes .= "<td>".$campos[5]."</td>";
            $clientes .= "<td>".$campos[6]."</td>";
            $clientes .= "<td>".$campos[7]."</td>";
            $clientes .= "<td>".$campos[8]."</td>";
            $clientes .= "<td>".$campos[9]."</td>";
            $clientes .= "<td>".$campos[10]."</td>";
            $clientes .= "<td>".$campos[11]."</td>";
            $clientes .= "<td>".$campos[12]."</td>";
            $clientes .= "<td>".$campos[13]."</td>";
            $clientes .= "<td>".$campos[14]."</td>";
            $clientes .= "<td>".$campos[15]."</td>";
            $clientes .= "<td>".$campos[16]."</td>";
            $clientes .= "<td>".$campos[17]."</td>";
            $clientes .= "<td>".$campos[18]."</td>";
            $clientes .= "<td>".$campos[19]."</td>";
            $clientes .= "<td>".$campos[20]."</td>";
            $clientes .= "<td>".$campos[21]."</td>";
            $clientes .= "<td>".$campos[22]."</td>";
            $clientes .= "<td>".$campos[23]."</td>";
            $clientes .= "<td>".$campos[24]."</td>";
            $clientes .= "<td>".$campos[25]."</td>";
            $clientes .= "<td>".$campos[26]."</td>";
            $clientes .= "<td>".$campos[27]."</td>";
            $clientes .= "<td>".$campos[28]."</td>";
            $clientes .= "<td>".$campos[29]."</td>";
            $clientes .= "<td>".$campos[30]."</td>";
            $clientes .= "<td>".$campos[31]."</td>";
            $clientes .= "<td>".$campos[32]."</td>";
            $clientes .= "<td>".$campos[33]."</td>";
            $clientes .= "</tr>";
        }
    }
} else { /* Nenhum Arquivo encontrado - Escreve no Log */
    $mensagem = "Arquivo não encontrado";
}
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
            9: { sorter: false },
            10: { sorter: false },
            11: { sorter: false },
            12: { sorter: false },
            13: { sorter: false },
            14: { sorter: false },
            15: { sorter: false },
            16: { sorter: false },
            17: { sorter: false },
            18: { sorter: false },
            19: { sorter: false },
            20: { sorter: false },
            21: { sorter: false },
            22: { sorter: false },
            23: { sorter: false },
            24: { sorter: false },
            25: { sorter: false },
            26: { sorter: false },
            27: { sorter: false },
            28: { sorter: false },
            29: { sorter: false },
            30: { sorter: false },
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

<br>

<div style="width: 100%; text-align: center;">     

    <table width="90%" style="margin: auto;">
        <tr>
            <td width="150"><a href="index.php?option=sidicom"><img src="images/sidicom.png"/></a></td>
            <td align="center"><?php echo basename($filename); ?></td>
        </tr>
    </table>

<br>

<br>

<div>Pedidos</div>

<div style="width: 95%; height: auto; max-height: 500px; overflow-y: scroll; margin:auto;">
    <table class="tablesorter" id="pedidos">
        <thead>
            <tr>    
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Transportadora</th>
                <th>V. Bruto</th>
                <th>Frete</th>
                <th>OC</th>
                <th>Observação</th>
                <th>Emissão)</th>
                <th>Criação(Data)</th>
                <th>Criação(Hora)</th>
                <th>Final(Data)</th>
                <th>Final(Hora)</th>
                <th>CPF/CNPJ</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Complemento</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>CEP</th>
                <th>País</th>       
            </tr>
        </thead>
        <?php echo $pedidos; ?>
 </table>
</div>

<br>

<div>Produtos</div>

<div style="width: 95%; height: auto; max-height: 500px; overflow-y: scroll; margin:auto;">
    <table class="tablesorter">
        <thead>
            <tr>    
                <th>Pedido</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Tabela</th>
                <th>Preço Venda</th>
                <th>Total</th>
            </tr>
        </thead>
        <?php echo $produtos; ?>
 </table>
</div>

<br>

<div>Clientes</div>

<div style="width: 95%; height: auto; max-height: 500px; overflow-y: scroll; margin:auto;">
    <table class="tablesorter">
        <thead>
            <tr>    
                <th>Cliente</th>
                <th>Nome/Razão</th>
                <th>CPF/CNPJ</th>
                <th>IE/RG</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Comp.</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>CEP</th>
                <th>País</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Site</th>
                <th>Logradouro(C)</th>
                <th>Número(C)</th>
                <th>Comp(C)</th>
                <th>Bairro(C)</th>
                <th>Cidade(C)</th>
                <th>UF(C)</th>
                <th>CEP(C)</th>
                <th>País(C)</th>
                <th>Logradouro(E)</th>
                <th>Número(E)</th>
                <th>Comp(E)</th>
                <th>Bairro(E)</th>
                <th>Cidade(E)</th>
                <th>UF(E)</th>
                <th>CEP(E)</th>
                <th>País(E)</th>
            </tr>
        </thead>
        <?php echo $clientes; ?>
 </table>
</div>

</div>
    
</body>
</html>