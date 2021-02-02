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

function progress_bar($done, $total, $info="", $width=50) {
    $perc = round(($done * 100) / $total);
    $bar = round(($width * $perc) / 100);
    printf("%s%%[%s>%s]%s\r", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
}

function calculate_flags($data) {
    // ignore first field
    $ret = 0;
    for ($i = 1; $i < count($data); $i++) {
        $exp = 37 - $i;
        if ($data[$i] == "•") $ret += (2**$exp);
    }
    return $ret;
}

if ($argc < 4) {
    echo "usage: ". $argv[0] . " <path to PF.txt> <path to Auxiliar de Dados - PF.txt> <sqlite db file>\n";
    exit(1);
}

$names_file = $argv[1];
$flags_file = $argv[2];
$sqlite_out = $argv[3];
$num_records = 223739216;
$step = $num_records/1000;

// passos:
// abre bde  transacao
// cria tabela
$dbh = new PDO("sqlite:$sqlite_out");
$createtable = $dbh->prepare('create table if not exists HASHES (CPF text, NOME text, NASC text, FLAGS int8)');
$createtable->execute();
$dbh->beginTransaction();
$insert = $dbh->prepare('insert into HASHES (CPF, NOME, NASC, FLAGS) values (:cpf, :nome, :nasc, 0)');
// abre arquivo de nomes e cpfs
if (($handle = fopen($names_file, "r")) !== FALSE) {
    $head = fgetcsv($handle, 0, "|");
    $row = 0;
    while (($data = fgetcsv($handle, 0, "|")) !== FALSE) {
        // hash de nome e cpf
        $cpf = base64_encode(md5(trim($data[0]), true));
        $nome = base64_encode(md5(strtolower(trim($data[1])), true));
        $nasc = base64_encode(md5(implode("-", array_reverse(explode("/", trim($data[3])))), true));
        //echo "$cpf | $nome | $nasc\n";
        //   insere no bd
        if ( !($insert->execute(array(':cpf' => $cpf, ':nome' => $nome, ':nasc' => $nasc))) ) {
            throw new ErrorException("Could not insert " . implode("|", $data));
        }
        if ($row++ % $step == 0) progress_bar($row, 3*$num_records);
    }
    fclose($handle);
}
$dbh->commit();

$createindex = $dbh->prepare('create unique index idx_cpf_hashes on hashes (cpf)');
if ( !($result = $createindex->execute()) ) {
    throw new ErrorException("Could not create index.");
}
progress_bar(2*$num_records, 3*$num_records);

$dbh->beginTransaction();
$update = $dbh->prepare('update HASHES set FLAGS = :flags where CPF = :cpf');
if (($handle = fopen($flags_file, "r")) !== FALSE) {
    $head = fgetcsv($handle, 0, "|");
    $row = 0;
    while (($data = fgetcsv($handle, 0, "|")) !== FALSE) {
        // hash de cpf
        $cpf = base64_encode(md5(trim($data[0]), true));
        $flags = calculate_flags($data);
        //   insere no bd
        //echo "$cpf | $flags \n";
        if ( !($update->execute(array(':cpf' => $cpf, ':flags' => $flags))) ) {
            throw new ErrorException("Could not update " . implode("|", $data));
        }
        if ($row++ % $step == 0) progress_bar(2*$num_records + $row, 3*$num_records);

    }
    fclose($handle);
}
$dbh->commit();

?>

