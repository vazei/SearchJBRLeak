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

$files = [
    [],
    ["01_PF_Basico_Reference.txt"],
    ["02_PF_Email_Reference.txt"],
    ["03_PF_Telefone_Completo_Reference.txt","03_PF_Telefone_Localidade_Reference.txt","03_PF_Telefone_Vivo_Conta_Reference.txt"],
    ["04_PF_Endereco_Completo_1º_Reference.txt","04_PF_Endereco_Completo_2º_Reference.txt","04_PF_Endereco_Localidade_Reference.txt"],
    ["05_PF_Mosaic_Reference.txt"],
    ["06_PF_Ocupacao_CBO_Reference.txt","06_PF_Ocupacao_Cargo_Reference.txt"],
    ["07_PF_Atividade_de_Credito_Reference.txt","07_PF_Score_de_Credito_Reference.txt"],
    ["08_PF_Registro_Geral_Reference.txt"],
    ["09_PF_Titulo_de_Eleitor_Basico_Reference.txt","09_PF_Titulo_de_Eleitor_Completo_Reference.txt"],
    ["10_PF_Escolaridade_Reference.txt"],
    ["11_PF_Empresarial_Pais_Exterior_Reference.txt","11_PF_Empresarial_Qualificacao_Reference.txt","11_PF_Empresarial_Socios_Reference.txt"],
    ["12_PF_Receita_Federal_Reference.txt"],
    ["13_PF_Classe_Social_Reference.txt"],
    ["14_PF_Estado_Civil_Reference.txt"],
    ["15_PF_Emprego_Reference.txt"],
    ["16_PF_Affinidade_Reference.txt"],
    ["17_PF_Modelo_Analitico_Reference.txt"],
    ["18_PF_Poder_Aquisitivo_Reference.txt"],
    ["19_PF_Fotos_de_Rostos_Reference.txt"],
    ["20_PF_Servidores_Publicos_1º_Reference.txt","20_PF_Servidores_Publicos_2º_Reference.txt"],
    ["21_PF_Cheques_sem_Fundos_Reference.txt"],
    ["22_PF_Devedores_Reference.txt"],
    ["23_PF_Bolsa_Familia_Reference.txt"],
    ["24_PF_Universitarios_Reference.txt"],
    ["25_PF_Conselhos_Reference.txt"],
    ["26_PF_Domicilios_Reference.txt"],
    ["27_PF_Vinculos_1º_Reference.txt","27_PF_Vínculos_2º_Reference.txt"],
    ["28_PF_LinkedIn_Reference.txt"],
    ["29_PF_Salario_Reference.txt"],
    ["30_PF_Renda_Reference.txt"],
    ["31_PF_Obitos_Basico_Reference.txt","31_PF_Obitos_Completo_Reference.txt"],
    ["32_PF_IRPF_Reference.txt"],
    ["33_PF_INSS_Reference.txt"],
    ["34_PF_FGTS_Reference.txt"],
    ["35_PF_CNS_Reference.txt"],
    ["36_PF_NIS_Reference.txt"],
    ["37_PF_PIS_Reference.txt"],
];

function create_links($pos) {
    global $files,$descriptions;
    $current_files = $files[$pos];
    $ret = $descriptions[$pos];
    for ($i = 0 ; $i < count($current_files); $i++) {
        $current_file = $current_files[$i];
        $ret .= "<a href=\"references/$current_file\" target=\"_blank\">[$i]</a>";
    }
    return " <sup>".$ret."</sup>";
}


?>