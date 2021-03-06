<?php
if (!(PHP_SAPI === 'cli')) {
  include "header.php";
?>

<div class="row">
  <div class="col-sm">

<?php
}

require_once("config.php");
require_once("functions.php");

$sqlite_file = $CONFIG['sqlite_file'];



function search_by_cpf($cpf) {
	global $sqlite_file;

	// Extrai somente os números
	//$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
	$hash = base64_encode(md5($cpf, true));

	$db = new SQLite3($sqlite_file, SQLITE3_OPEN_READONLY);

	$statement = $db->prepare('SELECT * FROM HASHES where CPF in (:cpf, :hash)');
	$statement->bindValue(':cpf', $cpf);
	$statement->bindValue(':hash', $hash);

	$results = $statement->execute();
	if ($row = $results->fetchArray()) {
		return $row;
	} else {
		return false;
	}
}


$captcha_fail=true.
$is_cli=false;

if (PHP_SAPI === 'cli') {
	if ($argc <= 2) {
		echo "Favor informar CPF e data de nascimento";
		exit(1);
  }
  
	$cpf = $argv[1];
	if (!validaCPF($cpf)) {
		echo "CPF $cpf is not valid. Please use a valid CPF";
		exit(1);
  }
  $nasc = $argv[2];
  $time = strtotime($nasc);
  $nome='';
  $is_cli=true;
} else {
	$response = $_POST["g-recaptcha-response"];

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => $CONFIG['recaptcha_secret'],
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
      'method' => 'POST',
      'header' => 'Content-Type: application/x-www-form-urlencoded',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);

	if ($captcha_success->success==false) {
    echo "<p>You are a bot! Go away!</p>";
	} else if ($captcha_success->success==true) {
		$cpf = $_POST["CPF"];
		$nome = trim($_POST["nome"]);
		$nasc = trim($_POST["nasc"]);
    $captcha_fail=false;
  }
}

if (!$captcha_fail || $is_cli) {
  if ($nasc != "") {
    $time = strtotime($nasc);
    $new_date = date('Y-m-d', $time);
    $hashdate = base64_encode(md5($new_date, true));
  }
  if ($nome != "") {
    $hashnome = base64_encode(md5(strtolower($nome), true));
  }
  if (!validaCPF($cpf) && substr($cpf, 22, 2) != '==') {
    echo "CPF $cpf is not valid and is not a hash. Please use a valid CPF";
  } else {
    $results = search_by_cpf($cpf);
    if ($nasc == "" && $nome == "") {
      echo "Favor informar a data de nascimento ou o nome completo";
    } elseif ($results === false) {
      echo "O CPF " . htmlspecialchars($cpf) . " não foi encontrado na base.";
    } elseif ($nasc != "" && $nasc != $results['NASC'] && $hashdate != $results['NASC']) {
      echo "Data de nascimento não confere.";
    } elseif ($nome != "" && $nome != $results['NOME'] && $hashnome != $results['NOME']) {
      echo "Nome completo não confere.";
    } else {
      $flags = $results['FLAGS'];
      echo "CPF: ". htmlspecialchars($cpf) ."<br />\n";
      if ($nome != "") echo "  Nome: ". htmlspecialchars($nome) ."<br />\n";
      if ($nasc != "") echo "  Data de Nascimento: " .  htmlspecialchars($nasc) ."<br />\n";
?>
    <table>
      <thead><tr><th>Tipo dos dados</th><th>Vazados?</th></tr></thead>
      <tbody>
<?php
  	  for ($i = 36; $i >= 0; $i--) {
?>
        <tr><td><?php echo create_links(37-$i); ?></td><td><?php echo ((($flags / 2**$i) % 2)?"Sim":"-") ?></td></tr>
<?php
      }
?>
      </tbody>
    </table>
<?php
    }
  }
}
if (!(PHP_SAPI === 'cli')) {

?>

  </div>
</div>

<?php
  include "footer.php";
}
?>
