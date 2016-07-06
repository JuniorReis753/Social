<?php
include_once("../../model/functions.php");
include_once("../../controller/foreach.php");

session_start();
//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['login']) and ! isset($_SESSION['senha'])) {
		//Destrói
		session_destroy();

		//Limpa
		unset($_SESSION['login']);
		unset($_SESSION['senha']);

		//Redireciona para a página de autenticação
		header('location:../../index.php');
} else {
	
		$dados             = dados_user($_SESSION['login']);      // pegando info do usuario
		$id_principal      = $dados['id_usuario'];
		$seguindo          = exibir_amigos($id_principal);         // amigos do usuario principal
        $seguindo_count    = count ($seguindo);
		$pontos            = $dados['ponto'];                     // pontuacao usuario principal
}

	$totalizando = $pontos / 2000;
	  
	  // nivel total
		$nivel = intval($totalizando);
		
		$nivel2 = $totalizando - $nivel ;
		
		//nivel da barra
		$nivel3 = $nivel2 * 100;
		$nivel4 = $nivel3 / 100;
		$nivel5 = $nivel4 * 2000;
		$nivel6 = round($nivel5);  
		
		$_SESSION['id_usuario']       = $id_principal;
		$_SESSION['nivel6']           = $nivel6;
		$_SESSION['nivel']            = $nivel;
		$_SESSION['nivel_barra']      = $nivel3;	
		$_SESSION['pontos_fixo']      = $pontos;
		$_SESSION['info_user']        = $dados;
		$_SESSION['seguindo']         = $seguindo_count;		
		
				
	
?>
<html>
        
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>
                        Social
                </title>
                <link rel="stylesheet" href="../css/painel/estilo.css">
                <link rel="icon" href="../imagens/favicon.png" type="../image/gif" size="16x16">           
                <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
                <script src="../js/functions.js"></script>
                <script type="text/javascript" language="javascript" src="../js/jquery-3.0.0.min.js"> </script>		
                <script src="../js/flat-ui.js"></script>
        </head>
        
        <body>
                <!--Alterar imagem de perfil-->
                <div id="box_mudar_foto">
                        <div class="box_login">
                                <div class="close" onclick="javascript: fechar_login('box_mudar_foto', 'principal');">
                                </div>
                        </div>
                        <form class="foto_perfil" action="../../model/gravar.php" method="POST" enctype="multipart/form-data">
                                <label for="file_input2">
                                        <img src="../imagens/upload.png" style="position:absolute; left:30; top:10px; width:90px; cursor:pointer;">
                                </label>
                                <input required="" id="file_input2" type="file"  accept="image/*" name="imagem_perfil" />            
                                <input class="up_foto_perfil" type="submit" value="Enviar" />
                        </form>
                </div>

                <div id="principal">  
					   <!--Barra top-->
                        <div class="top">
                                <img class="logo" src="../imagens/logo.png" alt="Social" onclick="location.href = 'painel.php'">
                                <table id="busca_pessoa">
                                        <form name="form_pesquisa" id="form_pesquisa" method="post" action="pesquisados.php?go=buscar">
                                                <input type="text" name="pesquisaCliente" id="pesquisaCliente" placeholder="Encontre um amigo"
                                                class="txt" required="" autocomplete="off" />
                                                <button class="buscar" type="submit" value="Buscar" />
                                                <div id="contentLoading">
                                                        <div id="loading">
                                                        </div>
                                                </div>
                                        </form>
                                </table>
                                <section class="jumbotron">
                                        <div id="MostraPesq">
                                        </div>
                                </section>
                        </div>
                     
					 <!--Barra da direita-->
                        <div id="direita">
                                <div class="profile-sidebar">
                                        <!-- SIDEBAR USURFOTO -->
                                        <div class="profile-userfoto">
                                                <div class="img">
                                                        <div id="alterar" onclick="javascript: exibe('box_mudar_foto', 'principal');">
                                                                Alterar
                                                        </div>
                                                        <div id="remover" onclick="location.href = 'remover.php'">
                                                                Remover
                                                        </div>
                                                        <img <?php if ($dados[ 'id_foto']>
                                                        0){ echo "src=\"../../model/getImagem.php?cod=$id_principal\"";}else{echo false;}?>
                                                        height="200px" width="200px" >
                                                </div>
                                        </div>
                          
                                        <!-- SIDEBAR USUARIO TITLE -->
                                        <div class="profile-nome">
                                                <div class="profile-usertitle-nome">
                                                        <?php print ($dados[ 'nome']. '&nbsp'.$dados[ 'sobrenome']); ?> 
                                                </div>
                                                <div class="profile-usertitle-status">
                                                        Nível
                                                        <?php echo $nivel + 1; ?>
                                                </div>
                                        </div>
                                        <div class="profile-xp">
                                                Reputação
                                        </div>
                                        <div class="meter orange nostripes">
                                                <div class="progresso">
                                                        <?php echo "$nivel6/2000"; ?>
                                                </div>
                                                <span style="width: <?php if($pontos >= 0){ echo " $nivel3%;";}else{echo "5%; background-color:red; ";} ?>">
                                                </span>
                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->
                                        <!-- SIDEBAR MENU -->
                                        <div class="profile-usermenu">
                                                <ul class="nav">
                                                        <li>
                                                                <a href="../php/painel_post.php">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    Suas Fotos </a>
                                                        </li>
                                                        <br>
                                                        <li>
                                                                <a href="../php/apreciados.php">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    Apreciados &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $seguindo_count; ?></a>
                                                        </li>
                                                        <br>
                                                        <li>
                                                                <a href="config_conta.php">
                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                    Configurações da conta </a>
                                                        </li>
                                                        <br>
                                                        <li class="logout">
                                                                <a href="../../controller/logout.php">
                                    <i class="fa fa-power-off" aria-hidden="true"></i>
                                    Sair </a>
                                                        </li>
                                                </ul>
                                        </div>
                                        <!-- END MENU -->
                                </div>
                        </div>
                        <div class="todos" onclick="location.href = 'painel.php'">
                        </div>
                        <div class="amigos" onclick="location.href = 'painel_amigos.php'">
                        </div>
                        <div class="top_users">
                                <span class="top_5" id="top_5id">
                                        Mais Relevantes
                                </span>
							   <form class="login-form"  id="top_form" method="post">
									<select  id="regiao" name="gravatai">
									<option value="gravatai">Selecione sua região</option>
									<option value="alegrete">Alegrete</option>
									<option value="alvorada">Alvorada</option>
									<option value="cachoerinha">Cachoeirinha</option>
									<option value="canoas">Canoas</option>
									<option value="caxias">Caxias do Sul</option>
									<option value="cruz_alta">Cruz Alta</option>
									<option value="gramado">Gramado</option>
									<option value="gravatai">Gravataí</option>
									<option value="glorinha">Glorinha</option>
								   <option value="novo_hamburgo">Novo Hamburgo</option>
								   <option value="porto_alegre">Porto Alegre</option>
								   <option value="pelotas">Pelotas</option>
								   <option value="rio_grande">Rio Grande</option>
								   <option value="santa_maria">Santa Maria</option>
								   <option value="santa_rosa">Santa Rosa</option>
								   <option value="santo_antonio">Santo Antônio da Patrulha</option>
								   <option value="sao_leopoldo">São Leopoldo</option>
								   <option value="torres">Torres</option>
								   <option value="viamao">Viamão</option>
							   </select>                          
						   </form>
                                <div id="top_users">
                                </div>
                                <div id="top_loading" class="top_loading">
                                </div>
                        </div>
 
        
            <div class="timeline">
					<div class="postar">
					  
					  <input name="tagsinput" class="tagsinput" value="" placeholder="Adicione suas tags aqui..." />			 						
						
						<button class="enviar_up2" id="post_button">Postar</button>  	
								
						<button class="limpar2" id="limpar_id" onclick="javascript: clearfield();">X</button> 
						
				<form  class="image-upload"  id="uploadForm" method="POST" enctype="multipart/form-data">
												
							<input id="file-input" type="file"  accept="image/*" onchange="loadFile(event)" name="foto"  required="" oninvalid="this.setCustomValidity('Selecione uma foto para publicar.')" ></input>
							
							<div id="post_foto"><img id="output"/>
                                <label class="texto" id="publique" for="file-input">Publique sua foto</label>
                             </div>		
             	</form>                           
		
		</div>
    
						
  <!---------------Mostrando Postagens na página painel.php------------->
  
<?php postagens($id_principal,$seguindo); ?>

  <!---------------Mostrando Postagens na página painel.php------------->
	  
</div>	  
</div>	 
</body>
</html>

   <script>				
				
			
		$(document).ready(function (){

		        var valores = $('#top_form').serialize()
		        load_dados(valores);

		        $("select").change(function ()
		        {
		                var valores = $('#top_form').serialize()

		                load_dados(valores);
		        });

		        function loading_show2()
		        {
		                $('#top_loading').html("<img src='../imagens/loading.gif'/>").fadeIn('fast');
		        }

		        function loading_hide2()
		        {
		                $('#top_loading').fadeOut('fast');
		        }

		        function load_dados(valores)
		        {
		                $.ajax(
		                {
		                        type: 'POST',
		                        dataType: 'html',
		                        url: '../../controller/top_5.php',
		                        beforeSend: function ()
		                        { //Chama o loading antes do carregamento
		                                loading_show2();
		                        },
		                        data: valores,
		                        success: function (msg)
		                        {
		                                loading_hide2();
		                                var data = msg;
		                                $('#top_users').html(data);
		                        }
		                });
		        }

		});

		var loadFile = function (event)
		        {
		                var output = document.getElementById('output');
		                output.src = URL.createObjectURL(event.target.files[0]);

		                $("#output").addClass('foto_post');

		                $("#publique").removeClass('texto').addClass('texto2');

		                $("#limpar_id").removeClass('limpar2').addClass('limpar');

		                $("#post_button").removeClass('enviar_up2').addClass('enviar_up');


		        };

		function clearfield()
		{

		        $("#output").removeAttr("src");

		        $("#output").removeClass('foto_post');

		        $("#limpar_id").removeClass('limpar').addClass('limpar2');

		        $("#publique").removeClass('texto2').addClass('texto');

		}

   </script>	
      <script>	

		$(document).ready(function ()
		{

		        //Aqui a ativa a imagem de load


		        function loading_show()
		        {
		                $('#loading').html("<img src='../imagens/loading.gif'/>").fadeIn('fast');
		        }

		        //Aqui desativa a imagem de loading


		        function loading_hide()
		        {
		                $('#loading').fadeOut('fast');
		        }


		        // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json


		        function load_dados(valores, page, div)
		        {
		                $.ajax(
		                {
		                        type: 'POST',
		                        dataType: 'html',
		                        url: page,
		                        beforeSend: function ()
		                        { //Chama o loading antes do carregamento
		                                loading_show();
		                        },
		                        data: valores,
		                        success: function (msg)
		                        {
		                                loading_hide();
		                                var data = msg;
		                                $(div).html(data).fadeIn();
		                        }
		                });
		        }

		        //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
		        $('#pesquisaCliente').keyup(function ()
		        {

		                var valores = $('#form_pesquisa').serialize() //o serialize retorna uma string pronta para ser enviada
		                //pegando o valor do campo #pesquisaCliente
		                var $parametro = $(this).val();

		                if ($parametro.length > 1)
		                {
		                        load_dados(valores, '../../controller/pesquisa.php', '#MostraPesq');


		                }
		                else
		                {
		                        loading_hide();
		                        $('#MostraPesq').html("").fadeIn();
		                }
		        });


		});
</script>
<script>
		$(function ($)
		{
		        // Quando clicando em uma imagem da div que tem CLASS = container e DIV=a
		        $("div.post-bot a").click(function ()
		        {


		                // Recupera o ID do post que está na propriedade LANG da DIV-PAI da imagem e que tem CLASS = container
		                var id = $(this).parent("div.post-bot").attr("lang");


		                // Recupera o tipo (otimo|bom|ruim) que está na propriedade ALT da imagem clicada
		                var tipo = $(this).attr("alt");
					
					
		                // Seleciona o SPAN onde estão os votos
		                var votos = $("div[lang=" + id + "]  span.ponto_estrela span.valor1");
		                var votos1 = $("div[lang=" + id + "] span.ponto_coracao span.valor2");
		                var votos2 = $("div[lang=" + id + "] span.ponto_ruim span.valor3");
		                var apreciado = $("div[lang=" + id + "]  a.apreciado");
		                var apreciado2 = $("div[lang=" + id + "]  a.apreciado2");

		                // Faz a requisição AJAX
		                $.post("../../controller/votar.php", { id: id, tipo: tipo,  pagina: 'painel'}, function (resposta) 
						
								{

		                        // ponto ruim 
		                        if (resposta == 1)
		                        {
		                                votos2.html(parseInt(votos2.html()) + 1);
		                                $("#" + id + "desp").removeClass('span_hang').addClass('span_hang2');

		                        }
		                        else if (resposta == 1.1)
		                        {
		                                votos.html(parseInt(votos.html()) - 1);
		                                votos2.html(parseInt(votos2.html()) + 1);
		                                $("#" + id + "est").removeClass('span_estrela2').addClass('span_estrela');
		                                $("#" + id + "desp").removeClass('span_hang').addClass('span_hang2');
		                        }
		                        else if (resposta == 1.2)
		                        {
		                                votos1.html(parseInt(votos1.html()) - 1);
		                                votos2.html(parseInt(votos2.html()) + 1);
		                                $("#" + id + "").removeClass('span_coracao2').addClass('span_coracao');
		                                $("#" + id + "desp").removeClass('span_hang').addClass('span_hang2');
		                        }
		                        else if (resposta == 1.3)
		                        {
		                                votos2.html(parseInt(votos2.html()) - 1);
		                                $("#" + id + "desp").removeClass('span_hang2').addClass('span_hang');
		                        }

		                        // ponto coracao
		                        else if (resposta == 2)

		                        {
		                                votos1.html(parseInt(votos1.html()) + 1);
		                                $("#" + id + "").removeClass('span_coracao').addClass('span_coracao2');
		                        }

		                        else if (resposta == 2.1)
		                        {
		                                votos.html(parseInt(votos.html()) - 1);
		                                votos1.html(parseInt(votos1.html()) + 1);
		                                $("#" + id + "est").removeClass('span_estrela2').addClass('span_estrela');
		                                $("#" + id + "").removeClass('span_coracao').addClass('span_coracao2');
		                        }
		                        else if (resposta == 2.2)
		                        {
		                                votos2.html(parseInt(votos2.html()) - 1);
		                                votos1.html(parseInt(votos1.html()) + 1);
		                                $("#" + id + "desp").removeClass('span_hang2').addClass('span_hang');
		                                $("#" + id + "").removeClass('span_coracao').addClass('span_coracao2');
		                        }
		                        else if (resposta == 2.3)
		                        {
		                                votos1.html(parseInt(votos1.html()) - 1);
		                                $("#" + id + "").removeClass('span_coracao2').addClass('span_coracao');

		                        }

		                        // ponto estrela
		                        else if (resposta == 3)

		                        {
		                                votos.html(parseInt(votos.html()) + 1);
		                                $("#" + id + "est").removeClass('span_estrela').addClass('span_estrela2');

		                        }

		                        else if (resposta == 3.1)
		                        {
		                                votos1.html(parseInt(votos1.html()) - 1);
		                                votos.html(parseInt(votos.html()) + 1);
		                                $("#" + id + "est").removeClass('span_estrela').addClass('span_estrela2');
		                                $("#" + id + "").removeClass('span_coracao2').addClass('span_coracao');
		                        }
		                        else if (resposta == 3.2)
		                        {
		                                votos2.html(parseInt(votos2.html()) - 1);
		                                votos.html(parseInt(votos.html()) + 1);
		                                $("#" + id + "desp").removeClass('span_hang2').addClass('span_hang');
		                                $("#" + id + "est").removeClass('span_estrela').addClass('span_estrela2');

		                        }
		                        else if (resposta == 3.3)
		                        {
		                                votos.html(parseInt(votos.html()) - 1);
		                                $("#" + id + "est").removeClass('span_estrela2').addClass('span_estrela');

		                        }	
								else
								{
										var status = $("div[lang=" + id + "] div.status");
										status.html(resposta);

								}				
					});
				});  
		});
</script>
<script>
$(function ($)
		{

				$("div.top-post a").click(function ()
						{

		                var id = $(this).parent("div.top-post").attr("lang");

		                var tipo = $(this).attr("alt");

		                var apreciado = $("div[lang=" + id + "]  a.apreciado");
		                var apreciado2 = $("div[lang=" + id + "]  a.apreciado2");

		                // Faz a requisição AJAX
		                $.post("../../controller/votar.php", { id: id, tipo: tipo, pagina: 'painel'}, function (resposta) 
							{
						if (tipo=="desapreciar"){
							
							 apreciado.html('Apreciar');
							$("#"+id+"unf").removeClass('apreciado').addClass('apreciado2');
							$("#"+id+"unf").attr("alt", "apreciar");
							
						}
						else{
							 apreciado2.html('Desapreciar');
							$("#"+id+"unf").removeClass('apreciado2').addClass('apreciado');
							$("#"+id+"unf").attr("alt","desapreciar");
						}
						
			});
        });  
	});
</script>
<script>

		var states = new Bloodhound(
		{
		        datumTokenizer: function (d)
		        {
		                return Bloodhound.tokenizers.whitespace(d.word);
		        },
		        queryTokenizer: Bloodhound.tokenizers.whitespace,
		        limit: 4,
		        local: [
		        {
		                word: "Start"
		        }, ]
		});

		states.initialize();

		$('input.tagsinput').tagsinput();

		$('input.typeahead-only').typeahead(null, {
		        name: 'states',
		        displayKey: 'word',
		        source: states.ttAdapter()
		});

</script>
<script>
		$(function ()
		{


		        var form;
		        $('#uploadForm').change(function (event)
		        {
		                form = new FormData();

		                // adicionar o que vai enviar no apped
		                form.append('foto', event.target.files[0]); // para apenas 1 arquivo

		                //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
		        });

		        $('#post_button').click(function ()
		        {
		                var a = document.getElementsByClassName("tag")[0];
		                var b = document.getElementsByClassName("tag")[1];
		                var c = document.getElementsByClassName("tag")[2];




		                if (a != null)
		                {
		                        var tag1 = a.childNodes[0].nodeValue;
		                        form.append('tag1', tag1);
		                }
		                if (b != null)
		                {
		                        var tag2 = b.childNodes[0].nodeValue;
		                        form.append('tag2', tag2);
		                }
		                if (c != null)
		                {
		                        var tag3 = c.childNodes[0].nodeValue;
		                        form.append('tag3', tag3);
		                }


		                $.ajax(
		                {
		                        url: '../../model/postar.php',
		                        // Url do lado server que vai receber o arquivo
		                        data: form,
		                        processData: false,
		                        contentType: false,
		                        type: 'POST',
		                        success: function (data)
		                        {
		                                location.reload();
		                                // utilizar o retorno
		                        }


		                });
		        });
		});
    </script>
