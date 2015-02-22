<?php

  $arquivo  = $_POST['arquivo'];
  $conteudo = $_POST['conteudo'];
  $conteudo = mb_convert_encoding($conteudo, "UTF-8");
  
  // Determina que o arquivo é uma planilha do Excel
   header("Content-type: application/text; charset: UTF-8");   

   // Força o download do arquivo
   header("Content-type: application/force-download");  

   // Seta o nome do arquivo
   header("Content-Disposition: attachment; filename=".$arquivo);

   header("Pragma: no-cache");

   // Imprime o conteúdo da nossa tabela no arquivo que será gerado
   echo $conteudo;
?>