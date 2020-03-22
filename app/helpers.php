<?php

function formata_numero($numero, $casas = 0) {
    return $numero ? number_format($numero, $casas, ',', '.') : 0;
}

function so_numero($string) {
    return !is_null($string) ? preg_replace('/[^0-9]/', '', $string) : '';
}

function valida_cpf($value)
{
    // REMOVE FORMATACAO
    $value = so_numero($value);

    // VERIFICA SE POSSUI TODOS OS DIGITOS E SE NAO SAO TODOS IGUAIS
    if (strlen($value) !== 11 || preg_match('/(\d)\1{10}/', $value)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $value{$c} * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;

        if ($value{$c} != $d) {
            return false;
        }
    }

    return true;
}

function formata_cpf_cnpj($cpf_cnpj)
{
    $cpf_cnpj = preg_replace("#[' '-./ t]#", '', $cpf_cnpj);
    $tamanho = (strlen($cpf_cnpj) - 2);

    if ($tamanho != 9 && $tamanho != 12) {
        return '';
    }

    $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

    $indice = -1;
    for ($i = 0; $i < strlen($mascara); $i++) {
        if ($mascara[$i] == '#') {
            $mascara[$i] = $cpf_cnpj[++$indice];
        }
    }

    return $mascara;
}

function formata_telefone($telefone)
{
    $telefone = str_replace(array('(', ')', '[', ']', ' ', '.', '-', ',', '/'), '', $telefone);
    $tam = strlen($telefone);

    if ($tam > 11) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '.' . substr($telefone, 7, 4);
    } else if ($tam == 11 && substr($telefone, 0, 4) == '0800') {
        $telefone = substr($telefone, 0, 4) . '-' . substr($telefone, 4, 3) . '-' . substr($telefone, 7, 4);
    } else if ($tam == 11) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '.' . substr($telefone, 7, 4);
    } else if ($tam == 10) {
        $telefone = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '.' . substr($telefone, 6, 4);
    } else if ($tam == 9) {
        $telefone = substr($telefone, 0, 1) . '-' . substr($telefone, 1, 4) . '.' . substr($telefone, 5, 4);
    } else if ($tam == 8) {
        $telefone = substr($telefone, 0, 4) . '.' . substr($telefone, 4, 4);
    } else {
        $telefone = '';
    }

    return $telefone;
}
