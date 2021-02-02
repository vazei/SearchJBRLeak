<?php

function validaCPF($cpf) {
    // Extrai somente os números
    //$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}


$descriptions = [
    "00 -",
    "01 - Básico",
    "02 - Email",
    "03 - Telefone",
    "04 - Endereço",
    "05 - Mosaic",
    "06 - Ocupação",
    "07 - Score de Crédito",
    "08 - Registro Geral",
    "09 - Título de Eleitor",
    "10 - Escolaridade",
    "11 - Empresarial",
    "12 - Receita Federal",
    "13 - Classe Social",
    "14 - Estado Civil",
    "15 - Emprego",
    "16 - Afinidade",
    "17 - Modelo Analítico",
    "18 - Poder Aquisitivo",
    "19 - Fotos de Rostos",
    "20 - Servidores Público",
    "21 - Cheques sem Fundos",
    "22 - Devedores",
    "23 - Bolsa Família",
    "24 - Universitários",
    "25 - Conselhos",
    "26 - Domicílios",
    "27 - Vínculos",
    "28 - LinkedIn",
    "29 - Salário",
    "30 - Renda",
    "31 - Óbitos",
    "32 - IRPF",
    "33 - INSS",
    "34 - FGTS",
    "35 - CNS",
    "36 - NIS",
    "37 - PIS"
];

function decode_flags($flags) {
	global $descriptions;
	$result = array();
	for ($i = 36; $i >= 0; $i--) {
		if (($flags / 2**$i) % 2) {
			array_push($result, $descriptions[37-$i]);
		}
	}
	return $result;
}

?>