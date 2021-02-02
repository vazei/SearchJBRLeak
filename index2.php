<?php
include "header.php";
require("config.php");
?>

<div class="contact-form">
    <form action="search.php" method="POST">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
               CPF (somente os n&uacute;meros, obrigat&oacute;rio): <br />
            <input type="text" placeholder="Insira o CPF" name="CPF" id="CPF" style="width: 100%;"/><br/><br />
          </div>
          <div class="form-group">
              Para comprovar sua identidade, entre a data de nascimento ou o nome completo:<br>
            <input type="text" placeholder="Insira o Nome Completo" name="nome" id="nome" style="width: 100%;"/><br/><br />
            <input type="date" placeholder="Insira a Data de Nascimento" name="nasc" id="nasc" /><br/><br />
          </div>
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="<?php echo $CONFIG['recaptcha_sitekey']; ?>"></div>
          </div>
          <input type="button" class="btn btn-secondary btn-block" value="Anonimizar" name="" onclick="javascript:gerahash();" id='anon'>
          <input type="submit" class="btn btn-secondary btn-block" value="Consultar" name="" disabled=true id="btn1">
        </div>
      </div>
    </form>
  </div>

<?php
include "footer.php";
?>