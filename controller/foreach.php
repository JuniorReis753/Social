<?php
include_once("../../model/functions.php");



// postagens do painel
function postagens($id_principal){
	
$users  = exibir_todos($id_principal);
$amigos = exibir_amigos($id_principal);

if (count($users))
{
  		
		$posts = show_posts($users);

        if (count($posts))
        {
                // Passando frase por frase
                foreach($posts as $key => $list)
                {
                        $tempo            = time_elapsed_string($list['stamp']);
                        $str              = $list['usuario_id'];
                        $id_post          = $list['id'];
                        $tag1             = $list['tag1'];
                        $tag2             = $list['tag2'];
                        $tag3             = $list['tag3'];
                        $pontos_post      = pontos_post($id_post);
                        $cor_botao        = cor_botao($id_post,$id_principal);
						$ponto_ruim       = $cor_botao['ponto_ruim']; 
						$ponto_estrela    = $cor_botao['ponto_estrela'] ;
						$ponto_coracao    = $cor_botao['ponto_coracao'] ;

                        if ($ponto_ruim == 1){$corlike = 'span_hang2';}
                        else{$corlike = 'span_hang';}

                        if ($ponto_estrela == 1){$corlike2 = 'span_estrela2';}
                        else{$corlike2 = 'span_estrela'; }

                        if ($ponto_coracao == 1){$corlike3 = 'span_coracao2';}
                        else{$corlike3 = 'span_coracao';}
            
					   //CONTAINER DO POST
                        echo "<div class=\"post\" lang='$id_post' >";
                        echo "<div class=\"top-post\" lang='$id_post'>";

                        echo "<div>";
                        echo "<img class=\"circulo\" onclick=\"location.href='perfil.php?id=$str'\" src=\"../../model/getImagem.php?cod=".$list['usuario_id']."\"/>";
                        echo "</div>";
                        echo "<h1  onclick=\"location.href='perfil.php?id=$str'\">".$list['nome'].'&nbsp'.$list['sobrenome']."</h1>";

                        if (in_array($str, $amigos, true))
                        {

                                echo "<a id=\"".$id_post."unf\" class=\"apreciado\" alt=\"desapreciar\">Desapreciar</a>";
                        }
                        else
                        {
                                echo " <a id=\"".$id_post."unf\" class=\"apreciado2\" alt=\"apreciar\">Apreciar</a>";
                        }

                        // ---- tags ---   
                        if ($tag1 != null)
                        {
                                if ($tag2 != null)
                                {
                                        if ($tag3 != null)
                                        {
                                                echo "<div class=\"exibir_tag\">";
                                                echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\">".$tag1."</span>";
                                                echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag2'\" >".$tag2."</span>";
                                                echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag3'\" >".$tag3."</span>";
                                                echo "</div>";
                                        }
                                        else
                                        {
                                                echo "<div class=\"exibir_tag\">";
                                                echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\">".$tag1."</span>";
                                                echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag2'\">".$tag2."</span>";
                                                echo "</div>";
                                        }
                                }
                                else
                                {
                                        echo "<div class=\"exibir_tag\">";
                                        echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\">".$tag1."</span>";
                                        echo "</div>";
                                }
                        }
                        else
                        {
                                echo "<div class=\"exibir_tag\">";
                                echo "<span ></span>";
                                echo "</div>";

                        }

                        // ---- fim tags ---  
                        echo "<h2>".$tempo."</h2>";
                        // fecha div top
                        echo "</div>";
                        echo "<div class=\"container\">";
                        echo "<img class=\"foto1\" src=\"../../model/getImagem1.php?cod=".$id_post."\"/>";
                        echo "</div>";
                        echo "<div class=\"post-bot\" lang='$id_post'>";
                        echo "<a alt=\"ponto_estrela\" class=\"hvr-icon-pop\">Contemplar<span id=\"".$id_post."est\" class=\"$corlike2\"></span></a>";
                        echo "<span class=\"ponto_estrela\">";
                        echo "<span class=\"valor1\">".$pontos_post['ponto_estrela']."</span>";
                        echo "</span>";
                        echo "<a alt=\"ponto_coracao\" class=\"hvr-icon-coracao\">Admirar<span id=\"$id_post\" class=\"$corlike3\"></span></a>";
                        echo "<span class=\"ponto_coracao\">";
                        echo "<span class=\"valor2\">".$pontos_post['ponto_coracao']."</span>";
                        echo "</span>";
                        echo "<a alt=\"ponto_ruim\" class=\"hvr-icon-hang\">Desprezar<span id=\"".$id_post."desp\" class=\"$corlike\"></span></a>";
                        echo "<span class=\"ponto_ruim\">";
                        echo "<span class=\"valor3\">".$pontos_post['ponto_ruim']."</span>";
                        echo "</span>";
                        echo "</div>";
                        echo "</div>";

                }
        }
        else
        {

                echo " <p style=\"position:relative; left:250px; font-size:25px; margin-bottom:250px;\"><b>Nenhuma postagem encontrada nessa região.</b></p>";

        }
}

else
{

        echo "<p style=\"position:relative; left:300px; font-size:25px; margin-bottom:250px;\"><b>Nenhuma postagem encontrada nessa região.</b></p>";
}
}


// postagens do painel_post

function postagens_post($id_principal){	

$query_row = count_post($id_principal);

if ($query_row > 0){
					$array = array($id_principal);		
					$posts = show_posts($array );
										
					// Passando container por container				
					foreach ($posts as $key => $list  ) {					
					
					$tempo            =time_elapsed_string($list['stamp']);					
					$str              =$list['usuario_id']; 
					$id_post          =$list['id'];
                    $tag1             =$list['tag1'];
                    $tag2             =$list['tag2'];
                    $tag3             =$list['tag3'];
				    $pontos_post      =pontos_post($id_post);
				
					//CONTAINER DO POST
                    echo "<div class=\"post\" lang='$id_post' >";
	        		echo "<div class=\"top-post\" lang='$id_post'>";	
					echo "<div>";
             		echo "<img class=\"circulo\" src=\"../../model/getImagem.php?cod=$str\"/>";	   
					echo "</div>";					                   
				    echo "<h1>".$list['nome'] .'&nbsp' .$list['sobrenome']."</h1>";   
					echo "<div class=\"exclui_post\" onclick=\"location.href='../../model/remover_post.php?id=$id_post'\">Remover</div>"; 
                         
                    // ---- tags ---   
                        
                        if($tag1 !=null){
                            if($tag2 !=null){
                                if($tag3 !=null){
                            echo"<div class=\"exibir_tag\">";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag2."</span>";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag3'\" >".$tag3."</span>";
                            echo"</div>";
                                }
                            else{
                            echo"<div class=\"exibir_tag\">";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag2'\" >".$tag2."</span>";
                            echo"</div>";     
                                }
                                }
                            else{ 
                            echo"<div class=\"exibir_tag\">";
                            echo" <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
                            echo"</div>";                           
                            }
                        }else{echo"<div class=\"exibir_tag\">";
                            echo  "<span ></span>";
                             echo"</div>"; 
							         }
                            
						  // ---- fim tags ---  
							
							echo "<h2>".$tempo."</h2>";
						 // fecha div top
						  echo"</div>";
                            
                    echo"<div class=\"container\">";            
					echo "<img class=\"foto1\" src=\"../../model/getImagem1.php?cod=$id_post\"/>";
					echo"</div>";
					echo "<div class=\"post-bot\" lang='$id_post'>";   
					echo "<a alt=\"ponto_estrela\" class=\"hvr-icon-pop\">Contemplar<span id=\"".$id_post."est\" class=\"span_estrela2\"></span></a>";
					echo"<span class=\"ponto_estrela\">";
					echo"<span class=\"valor1\">".$pontos_post['ponto_estrela']."</span>";
					echo"</span>";
					echo "<a alt=\"ponto_coracao\" class=\"hvr-icon-coracao\">Admirar<span id=\"$id_post\" class=\"span_coracao2\"></span></a>";
					echo"<span class=\"ponto_coracao\">";
					echo"<span class=\"valor2\">".$pontos_post['ponto_coracao']."</span>";
					echo"</span>";					
					echo "<a alt=\"ponto_ruim\" class=\"hvr-icon-hang\">Desprezar<span id=\"".$id_post."desp\" class=\"span_hang2\"></span></a>";
					echo"<span class=\"ponto_ruim\">";
					echo"<span class=\"valor3\">".$pontos_post['ponto_ruim']."</span>"; 
					echo"</span>";	
					echo "</div>";					
				    echo "</div>";                
                 
					
					}
                }
		  

	else {
	
		echo"<p class=\"mensagem\" ><b>Você não tem nenhuma postagem.</b></p>";	
	}	
	
}


// postagem dos apreciados

function show_apreciados($id_principal){
	
 $amigos = exibir_amigos($id_principal);

$amigos_count= implode($amigos);

if ($amigos_count > 0 ){
	
	$posts = show_apreciado($amigos);
     
	 if (count($posts)) {
         
			// Passando frase por frase
						
				foreach ($posts as $key => $list  ) {					
									
					$str     = $list['id_usuario'];
                    				
					
					//CONTAINER DO POST
					
                     echo "<div class=\"container\" lang='$str'>";
			
					if (in_array($str, $amigos, true)){
				
					echo "<a id=\"".$str."unf\" class=\"apreciado\" alt=\"desapreciar\">Desapreciar</a>";
					}
					else{
					echo " <a id=\"".$str."unf\" class=\"apreciado2\" alt=\"apreciar\">Apreciar</a>";
					}	
             		if ($list['id_foto'] > 0){echo"<img class=\"circulo\" onclick=\"location.href='perfil.php?id=$str'\" src=\"../../model/getImagem.php?cod=".$list['id_usuario']. "\"/>";}	                  
                    else{echo"<div class=\"circulo\" onclick=\"location.href='perfil.php?id=$str'\" /></div>";}
					echo "<h1 onclick=\"location.href='perfil.php?id=$str'\">".$list['nome'] .'&nbsp' .$list['sobrenome']."</h1>";
					echo  "<div class=\"status\" style=\"color:white;\"></div>";      
                    echo "</div>";
					
                 
					}
                }
		}

               

	else {
	
		echo"<p style=\"position:relative; font-size:20px;  left:35%;\"><b>Você não aprecia ninguém.</b></p>";
		
	}
	
	
	}
	
	// postagem do perfil visitado
	
    function show_perfil($visitado){
		
		if ($visitado != null) {

			$posts = show_posts2($visitado);
			if (count($posts)) {
							// Passando frase por frase
							foreach($posts as $key = > $list) {

									$tempo = time_elapsed_string($list['stamp']);
									$str = $list['userid'];
									$id_post = $list['id'];
									$tag1 = $list['tag1'];
									$tag2 = $list['tag2'];
									$tag3 = $list['tag3'];


									//vendo a cor dos botões
									$query1 = $list['id'];

									$pontos = apreciados($query1);

									$sql = mysql_query("select ponto_ruim,ponto_coracao,ponto_estrela from apreciados where id_apreciado='$query1' and id_apreciador='$id_principal'");
									$row0 = mysql_fetch_array($sql);
									$ponto_ruim = $row0['ponto_ruim'];
									$ponto_estrela = $row0['ponto_estrela'];
									$ponto_coracao = $row0['ponto_coracao'];

									if ($ponto_ruim == 1) {
											$corlike = 'span_hang2';
									}
									else {
											$corlike = 'span_hang';
									}

									if ($ponto_estrela == 1) {
											$corlike2 = 'span_estrela2';
									}
									else {
											$corlike2 = 'span_estrela';
									}

									if ($ponto_coracao == 1) {
											$corlike3 = 'span_coracao2';
									}
									else {
											$corlike3 = 'span_coracao';
									}
									// fim vendo a cor dos botões
									//CONTAINER DO POST
									echo "<div class=\"post\" lang='$id_post' >";
									echo "<div class=\"top-post\" lang='$id_post'>";
									echo "<div>";
									echo "<img class=\"circulo\" onclick=\"location.href='perfil.php?id=$str'\" src=\"getImagem.php?cod=".$list['userid']."\"/>";
									echo "</div>";
									echo "<h1  onclick=\"location.href='perfil.php?id=$str'\">".$list['nome'].'&nbsp'.$list['sobrenome']."</h1>";

									// ---- tags ---   
									if ($tag1 != null) {
											if ($tag2 != null) {
													if ($tag3 != null) {
															echo "<div class=\"exibir_tag\">";
															echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
															echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag2'\" >".$tag2."</span>";
															echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag3'\" >".$tag3."</span>";
															echo "</div>";
													}
													else {
															echo "<div class=\"exibir_tag\">";
															echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
															echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag2'\" >".$tag2."</span>";
															echo "</div>";
													}
											}
											else {
													echo "<div class=\"exibir_tag\">";
													echo " <span class=\"tag_container\" onclick=\"location.href='painel_tags.php?id=$tag1'\" >".$tag1."</span>";
													echo "</div>";
											}
									}
									else {
											echo "<div class=\"exibir_tag\">";
											echo "<span ></span>";
											echo "</div>";

									}
									// ---- fim tags ---  
									echo "<h2>".$tempo."</h2>";
									// fecha div top
									echo "</div>";
									echo "<div class=\"container\">";
									echo "<img class=\"foto1\" src=\"getImagem1.php?cod=".$query1."\"/>";
									echo "</div>";
									echo "<div class=\"post-bot\" lang='$id_post'>";
									echo "<a alt=\"ponto_estrela\" class=\"hvr-icon-pop\">Contemplar<span id=\"".$id_post."est\" class=\"$corlike2\"></span></a>";
									echo "<span class=\"ponto_estrela\">";
									echo "<span class=\"valor1\">".$pontos['ponto_estrela']."</span>";
									echo "</span>";
									echo "<a alt=\"ponto_coracao\" class=\"hvr-icon-coracao\">Admirar<span id=\"$id_post\" class=\"$corlike3\"></span></a>";
									echo "<span class=\"ponto_coracao\">";
									echo "<span class=\"valor2\">".$pontos['ponto_coracao']."</span>";
									echo "</span>";
									echo "<a alt=\"ponto_ruim\" class=\"hvr-icon-hang\">Desprezar<span id=\"".$id_post."desp\" class=\"$corlike\"></span></a>";
									echo "<span class=\"ponto_ruim\">";
									echo "<span class=\"valor3\">".$pontos['ponto_ruim']."</span>";
									echo "</span>";
									echo "</div>";

									echo "</div>";

								}
					}
					else
					{
						echo "<p style=\"position:relative; left:300px; font-size:25px; margin-bottom:250px;\"><b> <?php print ($dados_visitado['nome']); ?> não tem postagens.</b></p>";
					}
		}
		else 
		{
					header('location:painel.php');
		}
		
	}


?>