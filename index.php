<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Social</title>
    <link rel="shortcut icon" href="view/imagens/favicon.png">
    <link rel="stylesheet" href="view/css/index/style.css"></head>
    <script src="view/js/functions.js"></script>

<body class="no-js">
     <div id="login">
            <div class="box_login">
                <div class="close" onclick="javascript: fechar_login('login', 'main');"></div>
                <form class="login-form" method="post" action="?go=login">
                    <input type="text" placeholder="E-mail"  name="usuario"/>
                    <input type="password" placeholder="senha" name="senha" />
                    <button>login</button>
                    <p class="message">N&atilde;o &eacute; registrado? <a href="view/php/cadastro.php">Crie uma conta</a></p>
                </form>
            </div>
        </div>

    <section class="main">
        <header>
            <div class="wrap">
                <div class="logo">
                    <a href="index.php">
                        <img src="view/imagens/laranja.png" width="262" height="52">
                    </a>
               </div><!-- logo -->        
        </div>
                </div><!--social -->
            </div><!-- wrap -->
        </header>
        <section class="promo">
            <div class="wrap">
                <div class="promo-text">
                    <div class="promo-title">A INOVAÇÃO E A FAMA</div>
                    <p>Mostra a sua visão do mundo, compartilhe momentos e cresça.</p>
                    <p><a class="promo-button" onclick="javascript: exibe('login', 'header');">ACESSE AGORA</a> &nbsp; <a class="promo-link" href="view/php/cadastro.php">CADASTRE-SE</a></p>
                </div><!-- promo-text -->
                <img src="view/imagens/promo.png" width="333" height="551" alt="">
            </div><!-- wrap -->
        </section><!-- promo -->
        <footer>
            <div class="wrap">
                <div class="istore">Aplicativo para Android (EM BREVE)</div>
                <div class="copy">
                    <p>Copyright &copy; 2016 <a href="http://www.soocial.16mb.com/">Social</a>.</p>
                </div><!-- copy -->
            </div><!-- wrap -->
        </footer>
    </section><!-- main -->
</body>
</html>

 <?php
require_once"model/config.php";
                            if (@$_GET['go'] == 'login') {
                                $login = $_POST['usuario'];
                                $senha = md5($_POST['senha']);
								
								$pdo      = conectar();
								
								$consulta = $pdo->query("SELECT * FROM usuario WHERE email = '$login' AND senha = '$senha'");
								
								$linha = $consulta->fetch(PDO::FETCH_ASSOC);

                                
								if ($linha > 0) {
									   session_start();
                                    $_SESSION['login'] = $login;
                                    $_SESSION['senha'] = $senha;
                                    header("Location:view/php/painel.php");

                                } else {
									echo"<script language=\"javascript\" type=\"text/javascript\">alert(\"Login e/ou senha incorretos\");window.location.href='index.php';</script>";
                                    session_destroy();
                                 
                                }
                            }
                            ?>
