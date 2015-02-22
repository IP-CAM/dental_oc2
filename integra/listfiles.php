<?php 

#Obter a listagem dos Arquivos do diretório

$pasta = 'ecommerce/';

if(is_dir($pasta))
{
    $diretorio = dir($pasta);

    while($arquivo = $diretorio->read()) {
        if($arquivo != '..' && $arquivo != '.') {
            #Cria um Arrquivo com todos os Arquivos encontrados
            $arrayArquivos[date("Y/m/d H:i:s", filemtime($pasta.$arquivo))] = $pasta.$arquivo;
    }
}
    $diretorio->close();
}
    #Classificar os arquivos para a Ordem Crescente
    //ksort($arrayArquivos, SORT_STRING);

    #Classificar os arquivos para a Ordem Decrescente
    krsort($arrayArquivos, SORT_STRING);
    
    #Mostra a listagem dos Arquivos
    foreach($arrayArquivos as $valorArquivos)
    {
        echo '<a href='.$valorArquivos.'>'.$valorArquivos.'</a><br />';
    }
?>