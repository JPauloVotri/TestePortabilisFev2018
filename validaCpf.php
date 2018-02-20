<?php

function validaCpf($cpf = false) {
  if (!function_exists('calcDigitosPosicoes')) {
    function calcDigitosPosicoes($digitos, $posicoes = 10) {
      $somaDigitos = 0;

      for ($i = 0; $i < strlen($digitos); $i++) {
        $somaDigitos += $digitos[$i]*$posicoes;
        $posicoes--;
      }

      $somaDigitos %= 11;

      if ($somaDigitos < 2)
        $somaDigitos = 0;
      else
        $somaDigitos = 11 - $somaDigitos;

      $cpf = $digitos.$somaDigitos;

      return $cpf;
    }
  }

  if (!$cpf)
    return false;
  
  if (strlen($cpf) != 11)
    return false;
    
  $digitos = substr($cpf, 0, 9);
  $novoCpf = calcDigitosPosicoes($digitos);
  $novoCpf = calcDigitosPosicoes($novoCpf, 11);

  if ($novoCpf === $cpf)
    return true;
  else
    return false;
}

?>