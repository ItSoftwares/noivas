<?
require "php/database/conexao.php";
?>
<!DOCTYPE HTML>
<html> 
    <head>
        <title>Login - Feira de Noiva</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content=""/>
        <meta name="robots" content="index, follow">
        <link rel="stylesheet" type="text/css" href="css/index.css" media="(min-width: 1000px)">
        <link rel="stylesheet" type="text/css" href="css/geral/geral.css" media="(min-width: 1000px)">
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/index.css" media="(max-width: 999px)"> -->
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/geral/geral.css" media="(max-width: 999px)"> -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body>
        <div id="fundo"></div>
		<div id="centro" class=''>
			<div id="logo">
				<img src="img/logo1.png">
			</div>

			<div id="form-login">
				<h2>Login</h2>

				<form class="campos">
					<div class="input linha transition">
						<input type="text" name="email" placeholder="E-mail" autofocus="">
						<i class="fa fa-envelope"></i>

					</div>

					<div class="input linha transition">
						<input type="password" name="senha" placeholder="Senha">
						<i class="fa fa-key"></i>

						<!-- <i class="fa fa-eye ocultar-senha"></i> -->
					</div>

					<button class="botao redondo cheio">ENTRAR</button>
				</form>
				
				<a id="esqueci">Esqueceu a senha?</a>
				<a id="cadastro" href="cadastro">Cadastrar-se<i class="fa fa-angle-right"></i></a>
			</div>
		</div>

		<a href="www.instagram.com/itsoftwares" id="itsoftwares" class="transition">Densenvolvido por ItSoftwares</a>
    </body>

    <script type="text/javascript">  
    </script>
    <script src="js/geral/geral.js?<? echo time(); ?>"></script>
    <script src="js/login.js?<? echo time(); ?>"></script>
</html>