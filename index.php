<?php
include "header.php";
require("config.php");
?>

      <div class="row">
        <div class="col-sm">
				<!--Tip Box-->
                <div class="color-box space">
                    <div class="shadow">
                        <div class="info-tab tip-icon" title="Useful Tips"><i></i></div>
                        <div class="tip-box">
			   <div class="row">
			   <div class="col-sm-1">
			    <p><strong>Dica:</strong><p>
			   </div>
			   <div class="col-sm-10">
			    <p>Privacidade não é brincadeira e nós do Vazei levamos isso a sério. 
			       A anonimização dos dados aqui não é só uma promessa: nenhum dado seu é enviado aos nossos
                               servidores sem ser antes anonimizado. E agora você pode ver isso com seus próprios olhos.<br/>
			       Para fazer sua consulta, você primeiro vai ter de anonimizar seus dados. Clique no botão 
                               "Anonimizar" e veja seus dados transformados de  forma irreversível antes de consultar. <p>
                           </div>
                           </div>
                        </div>
                    </div>
                </div>
                <!--End:Tip Box-->
        </div>
      </div>

<br/>
<div class="contact-form">
    <form action="search.php" method="POST">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
               CPF (somente os n&uacute;meros, obrigat&oacute;rio): <br />
            <input type="text" placeholder="Insira o CPF" name="CPF" id="CPF" style="width: 100%;"/>
          </div>
          <div class="form-group">
              Para comprovar sua identidade, entre a data de nascimento ou o nome completo:<br>
            <input type="text" placeholder="Insira o Nome Completo" name="nome" id="nome" style="width: 100%;"/><br/><br />
            <input type="date" placeholder="Insira a Data de Nascimento" name="nasc" id="nasc" /><br/><br />
          </div>
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="<?php echo $CONFIG['recaptcha_sitekey']; ?>"></div>
          </div>
          <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4">
              <input type="button" class="btn btn-secondary btn-block" value="Anonimizar" name="" onclick="javascript:gerahash();" id='anon'>
            </div>
            <div class="col-sm-4">
              <input type="submit" class="btn btn-secondary btn-block" value="Consultar" name="" disabled=true id="btn1">
            </div>
            <div class="col-sm-2">
            </div>
        </div>
      </div>
    </form>
  </div>

<?php
include "footer.php";
?>
