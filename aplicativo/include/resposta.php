<?php $resposta = $_SESSION['resposta']; ?>

                                            
    <?php
    // RESPOSTA DA PÁGINA DE REGISTRO - CADASTRO FEITO COM SUCESSO
  if ($resposta == 'sucesso' ){ 
    header('Location: ../login.php');
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // DESCOBRIR DE QUAL PÁGINA
  if ($resposta == 'nome_email' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Nome ou email inválido.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA DA PÁGINA DE LOGIN - login não encontrado
  if ($resposta == 'login_invalido' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Email e senha incorretos.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA PARA CAPTCHA INVÁLIDO
  if ($resposta == 'captcha' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="ff9000">Atenção!</b> Código inválido.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA PARA NOVO USUÁRIO
  if ($resposta == 'registrar' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="ff9000">Atenção!</b> Faça seu cadastro.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA AO ACESSO AS PÁGINAS SEM LOGIN
  if ($resposta == 'negado' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="ff9000">Atençaõ!</b> Precisa estar logado para acessar.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>

    <?php
    // RESPOSTA CONFIRMANDO A CRIAÇÃO DO NOME DO ALBUM
  if ($resposta == 'alb_nome_criado' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="0da314">Legal!</b> Seu álbum foi criado.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA INFORMANDO QUE O NOME DO ALBUM DEU ERRO
  if ($resposta == 'alb_nome_negado' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Não foi possivel criar o álbum, tente novamente. Caso persista o erro, abra um chamado no suporte informando este código:<b>NAB#102</b></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>

    <?php
    // RESPOSTA CONFIRMANDO A PUBLICAÇÃO DO ALBUM
	if ($resposta == 'alb_publicado' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="0da314">Legal!</b> Seu extilo já foi publicado.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>

    <?php
    // RESPOSTA CONFIRMANDO A PUBLICAÇÃO DO ALBUM MAIS FAZENDO ALERTA DE QUE ALGUMA IMAGEM NÃO FOI CARREGADA
    if ($resposta == 'alb_alerta' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="ff9000">Atenção!</b> Publicamos seu eXtilo, porém deixamos de carregar alguma(s) foto(s) por causa do tamanho do arquivo. <a>Saiba Mais</a></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>

    <?php
    // RESPOSTA DE ERRO NA PUBLICAÇÃO DAS FOTOS PARA O ALBUM
    if ($resposta == 'alb_erro' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Ocorreu algum erro na publicação deste album, tente novamente. Caso persista o erro, abra um chamado no suporte informando este código: <b>IMG#102</b></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA DE ERRO NO CADASTRO DE HASTAG NO BANCO DE DADOS
    if ($resposta == 'alb_erro_hash' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Ocorreu algum erro na publicação deste album, tente novamente. Caso persista o erro, abra um chamado no suporte informando este código: <b>HAS#102</b></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA DE ERRO NO CADASTRO DE ARROBA NO BANCO DE DADOS
    if ($resposta == 'alb_erro_arroba' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Ocorreu algum erro na publicação deste album, tente novamente. Caso persista o erro, abra um chamado no suporte informando este código: <b>ARR#102</b></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
                                        <!-- RESPOSTAS DA CRIAÇÃO DE PÁGINAS -->
    <?php
    // RESPOSTA CONFIRMANDO A CRIAÇÃO DE UMA PÁGINA
    if ($resposta == 'npg_criada' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="0da314">Legal!</b> Criamos a primeira parte, agora edite sua página, acrescente as informações necessárias, ative e começe a publicar conteúdos.</font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>
    <?php
    // RESPOSTA ERRO NA CRIAÇÃO DE UMA PÁGINA
    if ($resposta == 'npg_erro' ){ ?>
      <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <p class="text-muted" ><b><font color="d60808">Ops!</b> Ocorreu algum erro na criação, tente novamente. Caso persista este erro, abra um chamado no suporte informando este código: <b>NPG#102</b></font></p>
      </div>
    <?php ;
    unset($_SESSION['resposta']);}
    ?>

