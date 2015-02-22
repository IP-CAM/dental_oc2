<?php
global $erro, $errousuario, $errosenha, $usuario; 
if (!isset($_POST['login_sistema'])) { $_POST['login_sistema'] = 0; }
$login = $_POST['login_sistema'];

# Verifica se o formulário foi postado
 if ($login == 1) {
  # Carrega os dados postado e verifica
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  
  //echo $usuario;
  
  # Faz as validaçoes
  if ($usuario == '') {
    $errousuario = 'Informe seu login de acesso';
  } else {		
    # Verificando se o codigo esta cadastrado
    $filename = 'access.txt';

    if (file_exists($filename)) {
       $lines = file($filename);
       foreach ($lines as $line_num => $line) {
           $pos = strpos($line, ';');
           $sub = substr($line, 0, $pos);
           //echo $sub;
           
           if ($sub == $usuario) {
               #verifica a senha
               $sub2 = substr($line, $pos+1, strlen($line));
               //echo $sub2;
               
               if ($sub2 == $senha) {
                  
                  session_start();
                  $_SESSION['usuario_sistema'] = $usuario;
                  header("Location: index.php");
                  
               } else { $errosenha = 'Senha Incorreta'; }
           } else { $errousuario = 'Login de Acesso Incorreto'; } 
        }
    }
  }
 }
?>
<html>
<head>
<title>..::.. Integração SIDICOM <-> O Lojão do Alemão ..::..</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/estilo.css" type="text/css" media="all">
<style type="text/css">
    body { margin: 0px; text-align: center;}   
</style>

</head>
   
<body>
   
<div style="width: 100%; text-align: center;">     

    <br>
    
<table style="width: 50%; margin: auto;">
    <tr>
        <td valign="middle" align="left"><a href="index.php"><img width="96" height="65" src="images/mtilogo.png"></a></td>
        <td valign="middle" align="right"><font size="5" face="Oswald">Integração Sidicom/Lojão do Alemão</font></td>
    </tr>
</table>
    
<br>  
    
<div style="width: 50%; margin: auto;">
<form method="post" action="login.php">
    <table class="tabela">
        <thead><td colspan="2" align="center">Acesso ao Integra</td></thead>
        <tr>
            <td>Login</td>
            <td><input type="text" name="usuario" value="<?php echo $usuario; ?>">
                <?php echo $errousuario; ?>
            </td>
        </tr>
        <tr>
            <td>Senha</td>
            <td><input type="password" name="senha" value="">
                <?php echo $errosenha; ?>
            </td>
        </tr>
        <tr>
            <td>  </td>
            <td align="center">
                <button class="grey" style="float: none;">&nbsp;&nbsp;Login&nbsp;&nbsp;</button>
            </td>
        </tr>
    </table>
    <input name="login_sistema" type="hidden" value="1" />
</form>    
</div>

</div>
</body>
</html>