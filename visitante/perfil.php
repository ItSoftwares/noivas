<?
require "../php/database/conexao.php";
?>
<!DOCTYPE HTML>
<html> 
    <head>
        <title>Visitante - Feira de Noiva</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content=""/>
        <meta name="robots" content="index, follow">
        <link rel="stylesheet" type="text/css" href="../css/visitante/perfil.css" media="(min-width: 1000px)">
        <link rel="stylesheet" type="text/css" href="../css/geral/geral.css" media="(min-width: 1000px)">
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/index.css" media="(max-width: 999px)"> -->
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/geral/geral.css" media="(max-width: 999px)"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body class="fechado">
		<? 
		$titulo = "Meu Perfil";
		include('menu.php'); 
		?>

		<article id="centro">
			<section id="form-perfil" class="painel">
				
				<form>
					<div class="" id="foto">
						<div>
	                        <img src="../img/profile-default.png">
	                        <input type="file" name="foto_perfil" id="foto_perfil">
	                        <label for="foto_perfil">Mudar Foto</label>
	                    </div>
					</div>

					<div class="campos">
						<div class="input normal">
							<label>Nome</label>
							<input type="text" name="nome" required>
						</div>
						<div class="input normal metade">
							<label>Sexo</label>
							<select>
								<option value="0">Escolha</option>
								<option value="1">Homem</option>
								<option value="2">Mulher</option>
							</select>
						</div>
						<div class="input normal metade">
							<label>É Noivo(a)?</label>
							<select>
								<option value="0">Escolha</option>
								<option value="1">Sim</option>
								<option value="2">Não</option>
							</select>
						</div>
						<div class="input normal metade">
							<label>Data Casamento</label>
							<input type="text" name="data_casamento" required data-mask="00/00/0000">
						</div>
						<div class="input normal metade">
							<label>Telefone</label>
							<input type="text" name="telefone" required data-mask="(00) 90000-0000">
						</div>
						<div class="input normal">
							<label>E-mail</label>
							<input type="text" name="email" required>
						</div>
						<div class="input normal metade">
							<label>Mudar Senha</label>
							<input type="password" name="senha" required>
						</div>
						<div class="input normal metade">
							<label>Repita a nova senha</label>
							<input type="password" id="repetir_senha" required>
						</div>
						<div class="input normal metade">
							<label>Estado</label>
							<input type="text" name="estado" required>
						</div>
						<div class="input normal metade">
							<label>Cidade</label>
							<input type="text" name="cidade" required>
						</div>

						<button class="botao direita">Salvar</button>
					</div>
				</form>

			</section>

			<footer>
				<ul id="redes-sociais" class="transition">
					<li><a href="facebook" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="twitter" class="twitter"><i class="fab fa-twitter"></i></a></li>
					<li><a href="instagram" class="instagram"><i class="fab fa-instagram"></i></a></li>
				</ul>

				<a href="www.itsoftwares.com/itsoftwares">Desenvolvido por ItSoftwares</a>
			</footer>
		</article>

    </body>

    <script type="text/javascript">  
    </script>
    <script src="../js/geral/dashboard.js?<? echo time(); ?>"></script>
    <script src="../js/visitante/perfil.js?<? echo time(); ?>"></script>
</html>