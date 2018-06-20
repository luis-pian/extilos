<?php
ob_start();
session_start();
//VERIFICA SE USUÁRIO TEM ACESSO A PÁGINA
if(!isset($_SESSION['idLogado']) && (!isset($_POST['emailUsuario']))){
   $_SESSION['respesposta'] = 'negado';
    $_SESSION['retorno'] = 'pagina.php';
  header("Location: login.php"); exit;
}

//INCLUI AS FUNÇÕES NECESSÁRIAS
include_once 'functions/validar.php';
include_once 'functions/functions.php';
include_once 'functions/conexoes.php';
include_once 'include/modal.php';
include_once 'cadastros/caracteres-especiais.php';
//RETORNA VALOR DO BANCO DE DADOS PARA VALIDAR SE O USUARIO QUE ESTA ACESSANDO O ALBUM TEM PERMISÃO
$idUsuario = $_SESSION['idLogado']; // puxa da sessão o usuário logado
$usuario = busca_usuario($idUsuario); //retorna os dados do usuário que esta acessando a página
$blog = busca_blog(7); // faz consulta no conexoes.php para saber qual a página(blog) pelo id informado
$idPagina = $blog['idPagina']; //retorna o id da página(blog)
$tipoPagina = $blog['tipoPagina']; //faz as verificalão se a página é gratuíta ou profissional
$consulta = verifica_usu_pg($idUsuario, $idPagina); // faz as verificações de autorização do usuário X página
$admPagina = usersAdm($idPagina); //pega os usuários que administram a página
$paginaTorre = pagina_torre($idPagina); // buscam as torres que a página participa
$quantAdm = adm_total($idPagina); // consulta a quantidade de admininstradores na página
if($tipoPagina > 0){
  $tipoPg = '(Profissional)';
}else{
  $tipoPg = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head> 
  <meta charset="utf-8">
  <meta name="robots" content="all,follow,extilos,moda">
  <meta name="googlebot" content="index,follow,snippet,archive,moda,extilos">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Extilos - Mostre a sua moda">
  <meta name="author" content="APP Extilos | vempublicar.com">
  <meta name="keywords" content="">
  <title>
    eXtilos | Painel
  </title>
  <meta name="keywords" content="">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
  <!-- styles -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/owl.carousel.css" rel="stylesheet">
  <link href="css/owl.theme.css" rel="stylesheet">
  <!-- theme stylesheet -->
  <link href=<?php echo $corBotao ?> rel="stylesheet" id="theme-stylesheet">
  <!-- your stylesheet with modifications -->
  <link href="css/meu.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/respond.min.js"></script>
  <link rel="shortcut icon" href="favicon.png">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


</head>

<body>
  <div id="all">
    <div id="content">
      <div class="container box ">
        <div class="" id="customer-order">
          <a type="button" class="" data-toggle="modal" data-target="#modal-fotos">
            <i class="pull-right fa fa-align-justify"></i></a>
            <h4>Configuração do blog</h4>
            <!-- CARD DE EXIBIÇÃO -->
            <hr>
          </div>
          <div class='input-wrapper'>
           <form action="" method="post" enctype="multipart/form-data">
            <div class="panel panel-default sidebar-menu">
              <div class="panel-heading">
                <h4><i class="fa fa-th-large"></i> <b><?php echo $blog['nomePagina'] ?> </b><small><?php echo $tipoPg ?></small></h4>
                <div class="form-group">
                  <p>Estado:<b> <?php echo $blog['estadoPagina'] ?></b> | Cidade:
                    <b> <?php echo $blog['cidadePagina'] ?></b></p>
                  </div>
                  <p>Olá, <b><?php echo $usuario['nomeUsuario'] ?></b></p>
                  <input type="hidden" name="idPagina" id="idPagina" value="<?php echo $idPagina ?>">
                </div>
                <div class="container-full">
                  <div class="col-sm-6">
                    <div class="form-group" id="Respdescritivo" >
                      <h5 for="apresenta">Apresentação do blog</h5>
                      <?php if($consulta['pm_editar'] > 0){ ?>
                      <textarea type="textarea" class="form-control" id="apresenta" rows="3" ><?php echo $blog['descPagina'] ?></textarea>
                      <?php } else {?>
                      <textarea type="textarea" class="form-control" id="apresenta" rows="3" disabled><?php echo $blog['descPagina'] ?></textarea>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-sm-12 text-center torre">
                    <input id="descritivo" onclick="attPagina('descritivo')" class="btn btn-sm btn-block upload" value="Atualizar" style="display:none">
                  </div>
                </div>
              </div>
            </form>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h4><i class="fa fa-image"></i> Capa</h4>
                </div>
                <div class="container-full">
                  <div id="fotoCapa">
                    <img src="imagem/capa/media/<?php echo $blog['pgCapa'] ?>" class="img-responsive" >
                  </div>
                  <?php if($consulta['pm_editar'] > 0){ ?>
                  <label for='upload_file' class="btn btn-sm btn-block btn-default">Alterar foto</label>
                  <input type="file" id="upload_file" name="imagem" multiple class="upload_file" accept="image/jpeg, image/png, image/jpg,"/>
                  <input id='upload_file' type='file' value='' />
                  <span id='file-name'></span>
                  <div class="col-sm-12 text-center torre">
                    <input id="attImagem" onclick="attPagina('capa')" class="btn btn-sm btn-block upload" value="Atualizar" style="display:none">
                    <div id="atualizado"></div>
                     <div id="atualizadoCapa"></div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </form>
            <hr>
            <?php if($admPagina > ''){ ?>
                        <form action="" method="post" id="formADM" enctype="multipart/form-data">
                            <div class="panel panel-default sidebar-menu">
                              <div class="panel-heading">
                                <h4><i class="fa fa-users-cog"></i> Gerenciamento da página</h4>
                                <label for=""> Total <?php echo $quantAdm ?> usuário(s) </label>
                              </div>
                            <div class="form-group box">
                              <?php while ($pagina = $admPagina->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                              <?php
                              $idUsuario = $pagina['idUsuario'];
                              $nomeUsuario = busca_usuario($idUsuario); //consulta para trazer o nome do usuário dentro do while(for)
                              $nomeUsuario = $nomeUsuario['usuMarca']; //retorna o @nomedousuario para exibir.
                              $usuCadastrado = usuarioAdm($idPagina, $idUsuario);
                                if($usuCadastrado['pm_post']>0){$post = '1.';$checkPost = 'checked';}else{$checkPost = '';$post = '';}
                                if($usuCadastrado['pm_editar']>0){$editar = '2.';$checkEditar = 'checked';}else{$checkEditar = '';$editar = '';}
                                if($usuCadastrado['pm_excluir']>0){$excluir = '3.';$checkExcluir = 'checked';}else{$checkExcluir = '';$excluir = '';}
                                if($usuCadastrado['pm_cadastro']>0){$cadastro = '4.';$checkCadastro = 'checked';}else{$checkCadastro = '';$cadastro = '';}
                                if($usuCadastrado['pm_financeiro']>0){$financeiro = '5.';$checkFinanceiro = 'checked';}else{$checkFinanceiro = '';$financeiro = '';}
                                $nivel = ($post.$editar.$excluir.$cadastro.$financeiro);
                              ?>
                              <div class="form-group">
                                <p><b><?php echo $nomeUsuario?></b> <small> (Adm nível: <?php echo $nivel ?>)</small></p>
                              </div>
                            <?php endwhile; } ?>
                          </div>
                              <?php if($consulta['pm_editar'] > 0){ ?>
                              <div class="panel-body">
                               <input type="hidden" id="tipoPagina" value="<?php echo $tipoPagina ?>">
                               <div class="form-group">
                                <div id="nomeAdm"></div>
                                <div id="adicionaAdm"></div>
                                <div id="buscaAdm">
                                  <label for="city">Buscar usuários</label>
                                  <input type="text" class="form-control" id="adm" placeholder="@nome">
                                </div>
                                <div id="respUsuario"></div>
                              </div>
                            </div>
                          </div>
                          </form>
                          <?php } ?>
                        <hr>
                        <div class="form-group">
                         <?php if($consulta['pm_editar'] > 0){ ?>
                         <label for="marca">Publicar direto em qual torre? </label>
                         <?php while ($pagina = $paginaTorre->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                          <?php
                          $idTorre = $pagina['idTorre'];
                            $autorizado = verifica_pg_tr($idPagina, $idTorre); //verifica se tem autorização para publicar conteúdo
                            if($autorizado['retorno'] == 'aceito'){
                              $torre = topo_torre($pagina['idTorre']);
                              $nomePagina = palavraCurta($torre['nomeTorre']);
                              ?>
                              <div class="form-group">
                                <div class="switch__container">
                                  <p><?php echo $nomePagina ?></p>
                                  <?php  if($autorizado['ativar'] > 0) { ?>
                                  <input onclick="selTorre(<?php echo $pagina['idTorre'] ?>,<?php echo $idPagina ?>)" id="<?php echo $nomePagina ?>" class="switch switch--shadow" name="check_list[]" type="checkbox" value="paginaPHP" checked>
                                  <label for="<?php echo $nomePagina ?>"></label>
                                  <?php } else {   ?>
                                  <input onclick="selTorre(<?php echo $pagina['idTorre'] ?>,<?php echo $idPagina ?>)" id="<?php echo $nomePagina ?>" class="switch switch--shadow" name="check_list[]" type="checkbox" value="paginaPHP" >
                                  <label for="<?php echo $nomePagina ?>"></label>
                                  <?php } ?>
                                </div>
                              </div> 
                              <?php } ?>
                            <?php endwhile; ?>
                            <?php } else { ?>
                            <label for="marca">Publicando nas torres </label>
                            <?php while ($pagina = $paginaTorre->fetch(PDO::FETCH_ASSOC)): //prepara o conteúdo para ser listado ?>
                              <?php
                              $idTorre = $pagina['idTorre'];
                            $autorizado = verifica_pg_tr($idPagina, $idTorre); //verifica se tem autorização para publicar conteúdo
                            if($autorizado['retorno'] == 'aceito'){
                              $torre = topo_torre($pagina['idTorre']);
                              $nomePagina = palavraCurta($torre['nomeTorre']);
                              ?>
                              <div class="form-group">
                                <div class="switch__container">
                                  <p><?php echo $nomePagina ?></p>
                                  <?php  if($autorizado['ativar'] > 0) { ?>
                                  <input id="<?php echo $nomePagina ?>" class="switch switch--shadow" name="check_list[]" type="checkbox" value="paginaPHP" checked disabled>
                                  <label for="<?php echo $nomePagina ?>"></label>
                                  <?php } else {   ?>
                                  <input id="<?php echo $nomePagina ?>" class="switch switch--shadow" name="check_list[]" type="checkbox" value="paginaPHP" disabled >
                                  <label for="<?php echo $nomePagina ?>"></label>
                                  <?php } ?>
                                </div>
                              </div> 
                              <?php } ?>
                            <?php endwhile; ?>
                            <?php } ?>
                          </div>
                          <hr>
                          <?php if($consulta['pm_editar'] > 0){ ?>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="panel panel-default sidebar-menu">
                              <div class="panel-heading">
                                <h4><i class="fa fa-project-diagram"></i> Buscar torres</h4>
                                <input type="text" id="search-box" class="form-control" placeholder="Buscar torre" />
                              </div>
                              <div class="panel-body">
                                <div id="suggesstion-box"></div>
                              </div>
                            </div>
                          </form>
                          <?php } ?>
                        </div>
                      </div>

                      <!-- END CONTAINER -->
                    </div>
                    <!-- END CONTENT -->
                    <!-- RODAPÉ -->
                  </div>

                  <script src="js/jquery-1.11.0.min.js"></script>
                  <script src="js/bootstrap.min.js"></script>
                  <script src="js/jquery.cookie.js"></script>
                  <script src="js/waypoints.min.js"></script>
                  <script src="js/modernizr.js"></script>
                  <script src="js/bootstrap-hover-dropdown.js"></script>
                  <script src="js/owl.carousel.min.js"></script>
                  <script src="js/front.js"></script>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      $("#apresenta").on('keyup focusout',function(){
                        $("#descritivo").show();
                      });
                    })
                  </script>
                  <script type="text/javascript">
//CANCELA O CADASTRO DO USUÁRIO
function cancelaUser(){
  $("#buscaAdm").show();
  $("#adm").val('');
  $("#respostaUser").hide();
  $("#respUsuario").hide();
  $("#permitir").hide();
  $("#permitirBotao").hide();
}
</script>
<script type="text/javascript">
//CADASTRO DE USUARIO NA PÁGINA
function cadastrarUser(){
  var dados = $('#formADM').serialize();
  $.ajax({
    type: "POST",
    url: "functions/attPagina.php",
    data: dados,
    success: function(data){
      $("#adicionaAdm").html(data);
                    //$("#search-box").css("background","#FFF");
                    $("#buscaAdm").show();
                    $("#adm").val('');
                    $("#respostaUser").hide();
                    $("#respUsuario").hide();
                    $("#permitir").hide();
                    $("#permitirBotao").hide();
                  }
                });
}
</script>
<script type="text/javascript">
//ABRIR A DIV DE PERMISÕES PARA SEREM CADASTRADAS
function permitir(pagina, user){
    var tipoPagina = $("#tipoPagina").val();
  $.ajax({
    type: "POST",
    url: "functions/buscaUsuario.php",
    data:{pagina: pagina, user: user, tipoPagina: tipoPagina },
    success: function(data){
      $("#nomeAdm").html(data);
      $("#buscaAdm").hide();
      $("#respUsuario").hide();
    }
  })
}
</script>
<script type="text/javascript">
//ABRIR A DIV DE PERMISÕES PARA SEREM CADASTRADAS
function permisoes(){
  $("#permitir").show();
  $("#permitirBotao").show();
}
</script>
<script type="text/javascript">
 // BUSCA USUÁRIO DINAMICAMENTE NO BANCO DE DADOS
 $(document).ready(function(){
  $("#adm").on('keyup focusout',function(){
    var idPagina = $("#idPagina").val();
    var adm = $("#adm").val();
    $.ajax({
      type: "POST",
      url: "functions/buscaUsuario.php",
      data:{adm: adm, idPagina: idPagina},
      //beforeSend: function(){
        //$("#adm").css("background","#FFF url(img/spinner.gif) no-repeat 5px");
      //},
      success: function(data){
        $("#respUsuario").show();
        $("#respUsuario").html(data);
        $("#permitir").hide();
                //$("#search-box").css("background","#FFF");
              }
            });
  });
});
</script>
<script type="text/javascript">
      //ATUALIZA APRESENTAÇÃO DA PÁGINA
      function attPagina(idReq){
        var idPagina = $("#idPagina").val();
        var apresenta = $("#apresenta").val();

        $.ajax({
          url:("functions/attPagina.php"),
          type: "POST",
          data: { idPagina: idPagina,
            apresenta: apresenta,
            descritivo: idReq
          },
          success: function(data)
          {
            $("#Resp"+idReq).html(data);
            $("#"+idReq).hide();
          },
          error: function(){
           alert('deu ruim');
         }
       })

      }
</script>
<script type="text/javascript">
      //ATUALIZA CAPA DA PÁGINA
      function attPagina(idReq){
        $("#attImagem").hide();
        var idPagina = $("#idPagina").val();
        var form_data = new FormData();
        form_data.append("idPagina", $("#idPagina").val());
          var ins = document.getElementById('upload_file').files.length;
        for (var x = 0; x < ins; x++) {
          form_data.append("files[]", document.getElementById('upload_file').files[x]);
        }
        $.ajax({
          processData: false,
          contentType: false,
          url:("functions/attPagina.php"),
          type: "POST",
          data: form_data,
          success: function(data)
          {
            $("#atualizadoCapa").html(data);
            $("#atualizadoCapa").show();
          },
          error: function(){
           alert('deu ruim');
         }
       })

      }
</script>
    <script>
  // verificação de upload de imagem
  $("#upload_file").on('change', function () {

    var countFiles = $(this)[0].files.length;

    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#image_preview");
    image_holder.empty();
        if(countFiles > 5) { // VERIFICA SE É MAIOR DO QUE 5
          alert("Não é permitido enviar mais do que 5 arquivos.");
          $(this).val("");
          return false;
        } else if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
          if (typeof (FileReader) != "undefined") {

            for (var i = 0; i < countFiles; i++) {
              var reader = new FileReader();
              reader.onload = function (e) {
                $(
                  "<img />",{
                    "src": e.target.result,
                    "class": "img-responsive"
                  }).appendTo(image_holder);
                image_holder.show();
              }
              reader.readAsDataURL($(this)[0].files[i]);
              //document.getElementById('qtde_preview').innerHTML = '<p>'+countFiles+' arquivo(s) selecionado(s)</p>';
            }

          } else {
            alert("foto não suportada");
          }
        } else {
          alert("Selecione uma foto");
        }
      });
    </script>

    <script type="text/javascript">
 // BUSCA TORRE DINAMICAMENTE
 $(document).ready(function(){
  $("#search-box").on('keyup focusout',function(){
    var idPagina = $("#idPagina").val();
    var buscar = $("#search-box").val();
    $.ajax({
      type: "POST",
      url: "functions/buscatorre.php",
      data:{idPagina: idPagina, keyword: buscar },
      beforeSend: function(){
        $("#search-box").css("background","#FFF url(img/spinner.gif) no-repeat 20px");
      },
      success: function(data){
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        $("#search-box").css("background","#FFF");
      }
    });
  });
});
          //To select country name
          function selectCountry(val) {
            $("#search-box").val(val);
            $("#suggesstion-box").hide();
          }
        </script>
        <script type="text/javascript">
//ADICIONA A RELAÇÃO ENTRE PÁGINA E TORRE
function addTorre(idTorre){
  var idPagina = $("#idPagina").val();
  $.ajax({
    url:("functions/paginaXtorre.php"),
    type: "POST",
    data: { idPagina: idPagina, 
      idTorre: idTorre,
    },
    success: function(data)
    {
      $("#torre"+idTorre).html(data);
      $("#"+idTorre).hide();
    },
    error: function(){
     alert(idPagina);
   }
 })

}

</script>
<script type="text/javascript">
//ADICIONA A RELAÇÃO ENTRE PÁGINA E TORRE
function selTorre(torre,pagina){
  $.ajax({
    url:("functions/paginaXtorre.php"),
    type: "POST",
    data: { torre: torre, 
      pagina: pagina,
    }
  })

}

</script>
<script type="text/javascript">
//FAZ O TRATAMENTO DA IMAGEM ENVIADA NO UPLOAD
$(function () {

  var form;
  $('#upload_file').change(function (event) {
    var form_data = new FormData();
    var ins = document.getElementById('upload_file').files.length;
    for (var x = 0; x < ins; x++) {
      form_data.append("files[]", document.getElementById('upload_file').files[x]);
    }
        //form.append('upload_file', event.target.files[i]); // para apenas 1 arquivo
        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção

        $.ajax({
            url: 'functions/upFoto.php', // Url do lado server que vai receber o arquivo
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            beforeSend: function(){
              $("#fotoCapa").html('<img src="img/spinner.gif" class="img-responsive" height="100" width="100">');
            },
            success: function (data) {
                // utilizar o retorno
                $("#fotoCapa").html(data);
                $("#attImagem").show();
                $("#atualizadoCapa").hide();
              },
              error: function(){
               alert('deu ruim');
             }
           });
      });
});
</script>


</body>

</html>
