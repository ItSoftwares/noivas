<?
require "php/database/conexao.php";
?>
<!DOCTYPE HTML>
<html> 
    <head>
        <title>Cadastro - Feira de Noiva</title>
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
			<div id="form-cadastro">
				<h2>Cadastro</h2>

				<form class="campos transition">
					<div class="input linha">						
						<input type="text" name="nome" required autofocus="" placeholder="Nome Completo">
						<i class="fa fa-user"></i>
					</div>
					<div class="input linha metade">						
						<select name="sexo">
							<option value="0">Sexo</option>
							<option value="1">Homem</option>
							<option value="2">Mulher</option>
						</select>
						<i class="fa fa-venus-mars"></i>
					</div>
					<div class="input linha metade">						
						<select name="e_noivo">
							<option value="0">É noivo(a)?</option>
							<option value="1">Sim</option>
							<option value="2">Não</option>
						</select>
						<i class="fa fa-users"></i>
					</div>
					<div class="input linha metade">						
						<input type="text" name="data_casamento" required data-mask="00/00/0000" placeholder="Data do casamento">
						<i class="fa fa-calendar-alt"></i>
					</div>
					<div class="input linha metade">						
						<input type="text" name="telefone" required data-mask="(00) 90000-0000" placeholder="Telefone">
						<i class="fa fa-mobile-alt"></i>
					</div>
					<div class="input linha">
						<input type="text" name="email" placeholder="E-mail" autofocus="">
						<i class="fa fa-envelope"></i>

					</div>
					<div class="input linha metade">
						<input type="password" name="senha" placeholder="Senha">
						<i class="fa fa-key"></i>
					</div>
					<div class="input linha metade">
						<input type="password" id="repetir-senha" placeholder="Repita a senha">
						<i class="fa fa-key"></i>
					</div>
					<div class="input linha metade">						
						<input type="text" name="estado" required placeholder="Estado">
						<i class="fa fa-map-marker"></i>
					</div>
					<div class="input linha metade">						
						<input type="text" name="cidade" required placeholder="Cidade">
						<i class="fa fa-map-marker"></i>
					</div>

					<button class="botao redondo direita">Cadastrar</button>
				</form>
				
				<a id="login" href="/noivas"><i class="fa fa-angle-left"></i>Login</a>
			</div>
		</div>

		<a href="www.instagram.com/itsoftwares" id="itsoftwares" class="transition">Densenvolvido por ItSoftwares</a>
    </body>

    <script type="text/javascript">  
    </script>
    <script src="js/geral/jquery.mask.js?<? echo time(); ?>"></script>
    <script src="js/geral/geral.js?<? echo time(); ?>"></script>
    <script src="js/cadastro.js?<? echo time(); ?>"></script>
</html>