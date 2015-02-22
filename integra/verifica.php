<?php

/* tempo de expiração da sessão em segundos */
define('TEMPOEX', 30*60);
/* modificando os parâmetros do PHP para sessão */
ini_set('session.gc_probability', 100);
ini_set('session.gc_maxlifetime', TEMPOEX);
ini_set('session.cookie_lifetime', TEMPOEX);
ini_set('session.cache_expire', TEMPOEX);
/* inicia a sessão */
session_start(); 
/* verifica se a sessão existe */
if( (isset($_SESSION['usuario_sistema'])) ) {
  /* modifica o código da sessão */
  session_regenerate_id();
} else {
  /* apaga e destrói a sessão */
  unset($_SESSION['usuario_sistema']); 
  session_destroy(); 
}
/* Imprime o código da sessão e o nome para teste */
/* echo session_id(); */
/* echo session_name(); */