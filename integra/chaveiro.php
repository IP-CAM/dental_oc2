<?php

/*
 * Esta página foi desenvolvida por Miwana Tecnologia da Informação Ltda.
 * www.miwana.com.br
 * miwana@miwana.com.br
 * 
 * Conexão com Banco de Dados do E-commerce
 */

$bdservidor = "localhost"; 
$bancodedados = "dental";
$bdusuario = "root";
$bdsenha = "admin"; 
$db_prefix = 'oc_';
$db_prefix = 'eworxes_';

$conexao = mysqli_connect($bdservidor, $bdusuario, $bdsenha, $bancodedados) or die("Não foi possível se conectar ao Servidor!");

mysqli_query($conexao, "SET NAMES 'utf8'");

?>
