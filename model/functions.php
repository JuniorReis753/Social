<?php
require_once "config.php";

//pegando o id_usuario
function dados_user($email){	
	
	$pdo =conectar(); 
	$consulta = $pdo->query("SELECT sobrenome,nome,id_usuario,id_foto,ponto FROM usuario WHERE email = '$email'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);	
   return $linha;
}
function dados_visitado($visitado){	
	
	$pdo =conectar(); 
	$consulta = $pdo->query("SELECT sobrenome,nome,id_usuario,id_foto,ponto FROM usuario WHERE id_usuario = '$visitado'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);	
   return $linha;
}

//selecionando pontos_post
function pontos_post($ids){
	
	$pdo =conectar(); 
	$consulta = $pdo->query("SELECT ponto_estrela,ponto_coracao,ponto_ruim FROM posts where id= '$ids' ");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC); 
  return $linha;
}

// selecionando cor dos botoes
function cor_botao($id_post,$id_principal){
	
    $pdo =conectar(); 
	$consulta = $pdo->query("select ponto_ruim,ponto_coracao,ponto_estrela from apreciados where id_apreciado='$id_post' and id_apreciador = '$id_principal'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;
}

//seleciona seguidores
function seguidores($userid) {
 
    $pdo =conectar(); 
	$consulta = $pdo->query("select id_user from amigos where id_amigo='$userid'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;
}
// bara de pesquisa de usuario
function pesquisa ($parametro,$id_principal){				
   
    $pdo      = conectar(); 
	$consulta = $pdo->query("SELECT nome,id_usuario,sobrenome,id_foto FROM usuario WHERE UPPER(nome) LIKE UPPER('$parametro%') AND id_usuario <> '$id_principal' ORDER BY nome ASC LIMIT 5");	
    $linha    = $consulta->fetchAll(PDO::FETCH_ASSOC); 
  return $linha;

}
// filtro de seguranca
function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

// conta se postagens é maior que 1
function count_post($id_principal){

    $pdo      = conectar(); 
	$consulta = $pdo->query("SELECT id FROM posts WHERE usuario_id = '$id_principal' LIMIT 1");	
    $linha    = $consulta->fetchAll(PDO::FETCH_COLUMN, 0); 
  return $linha;
}

// achar id do usuario pelo id do post(para votacao);
function show_iduser($id_post){
   
    $pdo =conectar(); 
	$consulta = $pdo->query("select usuario_id from posts where id='$id_post'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;
}

// funcoes votação  //SEM RETORNO!
function votar1($tipo_ponto,$valor,$query1)                    {$pdo =conectar(); $pdo->query("UPDATE posts SET ".$tipo_ponto."=".$tipo_ponto." ".$valor." WHERE id = '$query1'");}
function votar2($tipo_ponto,$query1,$id_principal)             {$pdo =conectar(); $pdo->query("insert into apreciados (id_apreciado,id_apreciador,$tipo_ponto) values ('$query1','$id_principal','1')");}
function votar3($id_principal,$query1)                         {$pdo =conectar(); $pdo->query("DELETE FROM apreciados where id_apreciador='$id_principal' AND id_apreciado='$query1'");}
function votar4($tipo_ponto,$tipo_ponto2,$query1)              {$pdo =conectar(); $pdo->query("UPDATE posts SET ".$tipo_ponto."=".$tipo_ponto." -1,  ".$tipo_ponto2."=".$tipo_ponto2." +1 WHERE id = '$query1'");}
function votar5($valor,$id_usuario)                            {$pdo =conectar(); $pdo->query("UPDATE usuario SET ponto=ponto".$valor." WHERE id_usuario = ".$id_usuario."");}
function votar6($valor,$query1)                                {$pdo =conectar(); $pdo->query("UPDATE posts SET ponto_ruim=ponto_ruim ".$valor." WHERE id = '$query1'");}
function votar7($tipo_ponto,$id_principal,$query1,$tipo_ponto2){$pdo =conectar(); $pdo->query("UPDATE apreciados SET ".$tipo_ponto." = 0, ".$tipo_ponto2."= 1 WHERE id_apreciador = '$id_principal' AND id_apreciado='$query1'");}	
function votar9($id_principal,$id_usuario)                     {$pdo =conectar(); $pdo->query("DELETE from amigos where id_amigo='$id_usuario' and id_user='$id_principal' limit 1");}
function votar10($id_principal,$id_usuario)                    {$pdo =conectar(); $pdo->query("insert into amigos (id_user, id_amigo) values ('$id_principal','$id_usuario')");}

// funcoes votação //COM RETORNO!
function votar8($id_principal,$id_usuario)                     {
	$pdo      =conectar();
	$consulta = $pdo->query("select id_amigo from amigos where id_user = '$id_principal' AND id_amigo = '$id_usuario'");
	$linha    = $consulta->fetch(PDO::FETCH_ASSOC); 
  return $linha;
	}		

// funcoes configuracao da conta //SEM RETORNO!
function config2($nome,$sobrenome,$usuario,$email,$id_principal){$pdo =conectar(); $pdo-> query("UPDATE usuario SET nome='$nome',sobrenome='$sobrenome', user='$usuario', email='$email' WHERE id_usuario = '$id_principal'");}
function config3($sobrenome,$usuario,$email,$id_principal,$tipo){$pdo =conectar(); $pdo-> query("UPDATE usuario SET sobrenome='$sobrenome',user='$usuario', '$tipo'='$email' WHERE id_usuario = '$id_principal'");}
function config4($tipo,$tipo2,$id_principal,$tipo3,$tipo4)      {$pdo =conectar(); $pdo-> query("UPDATE usuario SET ".$tipo." ='$tipo2', ".$tipo3." ='$tipo4'  WHERE id_usuario = '$id_principal'");}
function config5($id_principal,$tipo,$tipo2)                    {$pdo =conectar(); $pdo-> query("UPDATE usuario SET ".$tipo." ='$tipo2' WHERE id_usuario = '$id_principal'");}
function config7($senha_nova,$id_principal)                     {$pdo =conectar(); $pdo-> query("UPDATE bd.usuario SET senha='$senha_nova' WHERE usuario.id_usuario = '$id_principal'");}
function config9($id_principal,$status)                         {$pdo =conectar(); $pdo-> query("UPDATE bd.usuario SET status='$status' WHERE usuario.id_usuario = '$id_principal'");}

//funcoes configuracao da conta //COM RETORNO!
function config1($id_principal,$senha_info){
    $pdo      = conectar(); 
	$consulta = $pdo-> query("SELECT senha,id_usuario FROM usuario WHERE id_usuario = '$id_principal' AND senha = '$senha_info'");	
	$linha    = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;
}
function config6($id_principal,$senha_info){
	$pdo      = conectar(); 
	$consulta = $pdo-> query("select senha,id_usuario from usuario where id_usuario = '$id_principal' AND senha = '$senha_info'");	
	$linha    = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;
}
function config8($id_principal){
	$pdo      = conectar();
	$consulta = $pdo-> query("select status from usuario where id_usuario = '$id_principal' AND status = 'active'");
	$linha    = $consulta->fetch(PDO::FETCH_ASSOC);
  return $linha;		
}


//Função show_posts()
function show_posts($userid){

	$qMarks = str_repeat('?,', count($userid) - 1) . '?';
	
    $pdo = conectar(); 
	$consulta=$pdo->prepare("SELECT usuario_id,nome,sobrenome,id,stamp,tag1,tag2,tag3 FROM posts WHERE usuario_id IN ($qMarks) order by stamp desc limit 20;");	
    $consulta->execute($userid);
	$linha = $consulta->fetchAll();
   return $linha;

}

//show_apreciados
function show_apreciado($userid){

	$qMarks = str_repeat('?,', count($userid) - 1) . '?';
	
    $pdo = conectar(); 
	$consulta=$pdo->prepare("SELECT id_usuario,nome,sobrenome,id_foto FROM usuario WHERE id_usuario IN ($qMarks) order by nome asc limit 30;");	
    $consulta->execute($userid);
	$linha = $consulta->fetchAll();
   return $linha;

}
 
// usuarios pesquisados 
function pesquisados($busca,$id_usuario) {
	
	$pdo =conectar(); 
	$consulta = $pdo->query("SELECT id_usuario FROM usuario WHERE UPPER(nome) LIKE UPPER ('$busca') AND id_usuario <> '$id_usuario' AND status='active'");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
   return $linha;
}

//exibir todos usuarios
function exibir_todos($id_user) {
	
	$pdo =conectar(); 
	$consulta = $pdo->query("select id_usuario from usuario where id_usuario <> '$id_user' AND status='active' LIMIT 20");	
    $linha = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
   return $linha;
}
//top 5 pontuacao
function top_ponto($cidade) {

    $pdo =conectar(); 
	$consulta = $pdo->query("SELECT nome,sobrenome,ponto,id_usuario,id_foto FROM usuario WHERE cidade = '$cidade' AND status= 'active' ORDER BY ponto DESC LIMIT 3");	
    $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
   return $linha;

}
// procurar tags no banco
function exibir_tags($tags) {

    $pdo =conectar(); 
	$consulta = $pdo->query("SELECT usuario_id FROM posts WHERE tag1 =  '$tags' OR tag2 =  '$tags' OR tag3 =  '$tags' order by stamp DESC LIMIT 30");	
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
   return $linha;
}
//exibir amigos do usuario/ conta quantos usuarios seguidos
function exibir_amigos($id_user) {
   
    $pdo =conectar(); 
	$consulta = $pdo->query("select id_amigo from amigos where id_user = '$id_user'");	
    $linha = $consulta->fetchAll(PDO::FETCH_COLUMN, 0);
   return $linha;
}

//calculo de hora da postagem
function time_elapsed_string($datetime, $full = false) {
	
	date_default_timezone_set("Brazil/East");
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mês',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'Agora Mesmo';
}


?>


