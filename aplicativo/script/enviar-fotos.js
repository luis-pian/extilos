
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
    					document.getElementById('qtde_preview').innerHTML = '<p>'+countFiles+' arquivo(s) selecionado(s)</p>';

    				}

    			} else {
    				alert("foto não suportada");
    			}
    		} else {
    			alert("Selecione uma foto");
    		}
    	});
//teste de exibição

//script para fazer consulta de # e @ no banco de dados
$(document).ready(function(){
                $("#marcacao").on('keyup focusout',function(){
                    var hashTag = $("#marcacao").val();
                    $.ajax({
                        url: 'functions/buscaTag.php',
                        type: 'POST',
                        data: {marcacao:hashTag},
                        success: function(data)
                        {
                            $("#resultadohashPag").html(data);
                        },
                        error: function(){
                            $("#resultadohashPag").html("Erro ao enviar...");
                        }
                    })
                });

            });


//$(document).ready(function(){
//$('#marcacao').textcomplete([
   // { // html
    //    mentions: 'buscaTag.php',
    //    match: /\B@(\w*)$/,
   //     search: function (term, callback) {
    //        callback($.map(this.mentions, function (mention) {
   //             return mention.indexOf(term) === 0 ? mention : null;
    //        }));
   //     },
   //     index: 1,
   //     replace: function (mention) {
   //         return '@' + mention + ' ';
   //     }
 //   }
//]);
// });
