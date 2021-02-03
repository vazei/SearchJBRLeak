
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Busca CPF no vazamento JBR</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<style>
.color-box{margin:15px 0;padding-left:20px}
.note-box,.warning-box,.tip-box{padding:8px 8px 3px 26px}
.info-tab{float:left;margin-left:-23px}
.content ul li{margin-top:7px}
.extra{padding-top:5px}
.green-box,.sky-box,.gray-box,.red-box,.pink-box{color:#000;margin-top:15px;padding:10px;background-color:#f6f8fa;border:1px solid #d7e2ec}
.tip-box{color:#2e5014;background:#d5efc2}
.tip-icon{background:#92CD59}
.info-tab{width:40px;height:40px;display:inline-block;position:relative;top:8px}
.info-tab::before,.info-tab::after{display:inline-block;color:#fff;line-height:normal;font-family:"icomoon";position:absolute}
.info-tab i::before,.info-tab i::after{content:"";display:inline-block;position:absolute;left:0;bottom:-15px;transform:rotateX(60deg)}
.info-tab i::before{width:20px;height:20px;box-shadow:inset 12px 0 13px rgba(0,0,0,0.5)}
.info-tab i::after{width:0;height:0;border:12px solid transparent;border-bottom-color:#fff;border-left-color:#fff;bottom:-18px}
.info-tab {background-size: 30px 30px; background-repeat: no-repeat; background-position: center; background-image: url("magnifying-glass.svg"); opacity: 0.8;}
.tip-icon::before{font-size:24px;content:"";top:7px;left:9px}


</style>

<script type="text/javascript">
function validaCPF(cpf) {
    // Extrai somente os números
    if (!/[0-9]{11}/.test(cpf)) return false;
    if (cpf == "00000000000") return false;

    // Faz o calculo para validar o CPF
    for (var t = 9; t < 11; t++) {
        var d;
        var c;
        for (d = 0, c = 0; c < t; c++) {
            d += parseInt(cpf.substring(c, c+1)) * ((t + 1) - c);
        }
        d = ((10 * d) % 11) % 10;
        if (parseInt(cpf.substring(c, c+1)) != d) {
            return false;
        }
    }
    return true;
}

function md5(txt) {
    return CryptoJS.MD5(txt).toString(CryptoJS.enc.Base64);
}

function gerahash() {
    var cpf = $( "#CPF" ).val().trim();
    if (cpf == "" || !validaCPF(cpf)) {
        alert("CPF Não preenchido ou inválido");
        return false;
    }
    if ($( "#nome" ).val().trim() == "" && $( "#nasc" ).val().trim() == "") {
        alert("Preencha o nome ou a data de nascimento.");
        return false;
    }
    var hashcpf = md5(cpf);
    $( "#CPF" ).val(hashcpf)
    if ($( "#nome" ).val().trim() != "") {
        var hashnome = md5($( "#nome" ).val().trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase());
        $( "#nome" ).val(hashnome);
    }
    if ($( "#nasc" ).val().trim() != "") {
        var hashnasc = md5($( "#nasc" ).val().trim());
        $(' #nasc' ).attr('type', 'text');
        $(' #nasc ').attr('style', "width: 100%;");
        $( "#nasc" ).val(hashnasc);
    }
    $( "#btn1" ).prop('disabled', false);
    $( "#anon" ).prop('disabled', true);
    $( "#nasc" ).prop("readonly", true);
    $( "#nome" ).prop("readonly", true);
    $( "#CPF" ).prop("readonly", true);
    return true;
}
</script> 

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container-fluid">
        <a href="#" class="navbar-brand mr-3"></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="./" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">Sobre</a>
            </div>
        </div>
    </div>    
</nav>

<div class="container">
    <div class="jumbotron text-center">
        <h1>Pesquise seus dados vazados</h1>
    </div>
