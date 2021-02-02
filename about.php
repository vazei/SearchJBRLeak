<?php
include "header.php";
?>

<div class="row">
  <div class="col-sm-3">
    <h5>Sobre o vazamento:</h5>
  </div>
  <div class="col-sm-9">
    <br/>
    Em janeiro de 2021 foi noticiado um gande vazamento de dados, contendo mais de 223 
    milhões de CPFs, e outros dados associados. 
    (<a href="https://tecnoblog.net/404838/exclusivo-vazamento-que-expos-220-milhoes-de-brasileiros-e-pior-do-que-se-pensava/" target="_blank">1</a>). 
    Os dados vazados eram compostos de duas partes: num primeiro vazamento, tornado 
    público pelos hackers, havia informações de nome, CPF e data de nascimento das 223 
    pessoas correspondentes. No outro vazamento, o hacker anunciava que possuia 37 
    bancos de dados com informações pessoais diversas, e disponibilizou além de 37 
    arquivos de exemplos, como prova do vazamento, com cerca de 100 registros cada, e 
    tambem um arquivo de "indice" onde se podia verificar a presença de cada um dos 
    223 milhões de CPFs nos respectivos bancos de dados, sem informar o conteúdo 
    desses dados.
  </div>
</div>
<div class="row">
  <div class="col-sm-3">
    <h5>Sobre os dados e sua anonimização:</h5>
  </div>
  <div class="col-sm-9">
    <br/>
    Nossa equipe tomou conhecimento dos arquivos através de um forum de internet 
    dedicado a distribuição de informações hackeadas ou vazadas 
    (<a href="https://raidforums.com/" target="_blank">2</a>). Neste forum estiveram 
    brevemente disponíveis os arquivos citados nas reportagens. Nossa equipe procedeu 
    imediatamente à anonimização dos dados através do uso de hashes criptograficas em 
    cada uma das informações. O algoritmo de anonimização escolhido foi o MD5 
    (<a href="https://pt.wikipedia.org/wiki/MD5" target="_blank">3</a>), entre outros 
    motivos, por gerar hashes menores e assim facilitar a indexação e buscas, sem 
    permitir que a anonimização seja revertida. O arquivo assim anonimizado permite 
    que o titular dos dados confirme se seus dados estão no arquivo, mas não permite 
    que terceiros, de posse do arquivo, tenham acesso aos dados pessoais de cada 
    titular. O arquivo desta forma anonimizado foi então indexado e disponibilizado 
    no site para consulta, de forma que apenas aqueles que já tenham posse da 
    informação possam consultar sua presença no arquivo.
  </div>
</div>
<div class="row">
  <div class="col-sm-3">
    <h5>Sobre o site:</h5>
  </div>
  <div class="col-sm-9">
    <br/>
    Nos preocupando sempre com a segurança dos dados dos usuários, tentamos fazer um site 
    simples e direto, onde os dados informados pelo usuário servem apenas para confirmar 
    a sua presença entre os vazamentos. Os dados do usuário são imediatamente anonimizados 
    com o mesmo algoritmo usado no arquivo de dados, e imeditamente descartados. Não há 
    armazenamento de nenhum dado enviado pelo site, seja na sua forma direta, seja na 
    forma anonimizada. Não há armazenamento de dados do usuário em nenhuma forma. Isso 
    garante que apenas uma pessoa que já esteja de posse dos dados possa consultá-los, 
    sem que essa informação seja transmitida para terceiros ou armazenada.
    <br/>
    A nossa equipe não tem e nunca teve acesso aos conteúdo dos 37 bancos de dados "vazados". 
    Nossa equipe não disponibiliza, coleta ou vende dados de terceiros. Nosso objetivo 
    é permitir que as pessoas descubram se suas informações pessoais foram "vazadas" e 
    com isso aumentar a concientização sobre a importancia da segurança digital.
  </div>
</div>

<?php
include "footer.php";
?>