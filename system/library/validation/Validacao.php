<?php

/* * ********************************************************************************************************
  Data de cria��o : 18/08/2009
  Autor           : Daniel Flores Bastos
  Proposta        : Validar CPF e CNPJ. Em caso de erro
  retorna em qual digito verificador ocorreu
  o erro.
 * ********************************************************************************************************** */

class Validacao {

    public $erroCPF = '';
    public $erroCNPJ = '';
    private $pArray_cpf = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
    private $sArray_cpf = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
    private $pArray_cnpj = array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
    private $sArray_cpj = array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);

    function validaCPF($valor) {
        $somador_cpf = 0;
        for ($i = 0; $i < (strlen($valor) - 2); $i++) {
            $somador_cpf = $somador_cpf + ($valor[$i] * $this->pArray_cpf[$i]);
        }

        $auxiliar = $somador_cpf % 11;
        $p_digito_verificador = 11 - $auxiliar;

        if ($p_digito_verificador < 2)
            $p_digito_verificador = 0;

        if (isset($valor[9]) && $p_digito_verificador == $valor[9]) {

            $somador_cpf = 0;
            for ($i = 0; $i < (strlen($valor) - 1); $i++) {
                $somador_cpf = $somador_cpf + ($valor[$i] * $this->sArray_cpf[$i]);
            }

            $auxiliar = $somador_cpf % 11;
            $s_digito_verificador = 11 - $auxiliar;

            if ($s_digito_verificador < 2)
                $s_digito_verificador = 0;

            if ($s_digito_verificador == $valor[10]) {
                return true;
            } else {
                $this->erroCPF = 2; // Erro no segundo digito verificador
                return false;
            }
        } else {
            $this->erroCPF = 1; // Erro no primeiro digito verificador
            return false;
        }
    }

    function validaCNPJ($valor) {
        $somador_cnpj = 0;
        //$pArray_cnpj = array(5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);

        for ($i = 0; $i < (strlen($valor) - 2); $i++) {
            $somador_cnpj = $somador_cnpj + ($valor[$i] * $this->pArray_cnpj[$i]);
        }

        $auxiliar = $somador_cnpj % 11;
        $p_digito_verificador = 11 - $auxiliar;

        if ($p_digito_verificador < 2)
            $p_digito_verificador = 0;

        if ($p_digito_verificador == $valor[12]) {

            //$sArray_cpj = array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
            $somador_cnpj = 0;

            for ($i = 0; $i < (strlen($valor) - 1); $i++) {
                $somador_cnpj = $somador_cnpj + ($valor[$i] * $this->sArray_cpj[$i]);
            }

            $auxiliar = $somador_cnpj % 11;
            $s_digito_verificador = 11 - $auxiliar;

            if ($s_digito_verificador < 2)
                $s_digito_verificador = 0;

            if ($s_digito_verificador == $valor[13]) {
                return true;
            } else {
                $this->erroCNPJ = 2; // Erro no segundo digito verificador
                return false;
            }
        } else {
            $this->erroCNPJ = 1; // Erro no primeiro digito verificador
            return false;
        }
    }

}

?>
