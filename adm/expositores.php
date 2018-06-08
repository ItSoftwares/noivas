<?
require "../php/database/conexao.php";
require "../php/classes/usuario.class.php";

$expositores = DBselect('expositor', 'order by id DESC');
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
        <link rel="stylesheet" type="text/css" href="../css/adm/expositores.css" media="(min-width: 1000px)">
        <link rel="stylesheet" type="text/css" href="../css/geral/geral.css" media="(min-width: 1000px)">
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/index.css" media="(max-width: 999px)"> -->
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/geral/geral.css" media="(max-width: 999px)"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body class="fechado">
		<? 
		$titulo = "Expositores";
		include('menu.php'); 
		?>

		<article id="centro">
			<section id="expositores" class="painel">
				<table>
					<tr>
						<th>ID</th>
						<th>Nome Fantasia</th>
						<th>CNPJ</th>
						<th>Telefone</th>
						<th class="centro">Ações</th>
					</tr>
					
					<? 
					foreach($expositores as $exp) { 
						$exp = new Usuario($exp);
					?>
					<tr data-id=<? echo $exp->id; ?>>
						<td><? echo $exp->id; ?></td>
						<td class="nome_fantasia"><? echo $exp->nome_fantasia; ?></td>
						<td class="cnpj" data-mask="00.000.000/0000-00"><? echo $exp->cnpj; ?></td>
						<td class="telefone" data-mask="(00) 90000-0000"><? echo $exp->telefone; ?></td>
						<td class="centro">
							<i class="fa fa-file-alt arquivos botao verde icon" title="Contrato e Boletos"></i>
							<i class="fa fa-edit editar botao amarelo icon" title="Atualizar os Dados"></i>
							<i class="fa fa-trash excluir botao vermelho icon" title="Excluir a Conta"></i>
						</td>
					</tr>
					<? } ?>
				</table>
			</section>

			<section id="novo-expositor" class="fundo">
				<i class="fa fa-times fechar"></i>

				<div>
					<h3>Novo Expositor</h3>

					<form class="campos">
						<div class="input normal">
							<label>Razão Social</label>
							<input type="text" name="razao_social" placeholder="Razão Social da empresa" required>
						</div>
						<div class="input normal">
							<label>Nome Fantasia</label>
							<input type="text" name="nome_fantasia" placeholder="Nome Fantasia da empresa" required>
						</div>
						<div class="input normal">
							<label>Inscrição Estadual</label>
							<input type="text" name="inscricao_estadual" placeholder="Inscrição Estadual" required>
						</div>
						<div class="input normal metade">
							<label>CNPJ</label>
							<input type="text" name="cnpj" data-mask="00.000.000/0000-00" placeholder="00.000.000/0000-00" required>
						</div>
						<div class="input normal metade"></div>
						<hr class="linha">
						<div class="input normal metade">
							<label>CEP</label>
							<input type="text" name="cep" data-mask="00 000-000" placeholder="00 000-000" required>
						</div>
						<div class="input normal metade">
							<label>Estado</label>
							<input type="text" name="estado" placeholder="Estado" required>
						</div>
						<div class="input normal">
							<label>Cidade</label>
							<input type="text" name="cidade" placeholder="Cidade" required>
						</div>
						<div class="input normal">
							<label>Rua</label>
							<input type="text" name="rua" placeholder="Rua" required>
						</div>
						<div class="input normal">
							<label>Bairro, Nº</label>
							<input type="text" name="bairro" placeholder="Bairro, Nº" required>
						</div>
						<hr class="linha"></hr>
						<div class="input normal metade">
							<label>Telefone</label>
							<input type="text" name="telefone" data-mask="(00) 90000-0000" placeholder="(00) 00000-0000" required>
						</div>
						<div class="input normal">
							<label>E-mail</label>
							<input type="text" name="email" placeholder="teste@teste.com" required>
						</div>
						<div class="input normal metade">
							<label>Senha</label>
							<input type="text" name="senha" placeholder="********" required>
						</div>
						<!-- <div class="input normal"></div> -->

						<button class="botao direita redondo">Salvar</button>
					</form>
				</div>
			</section>

			<button id="novo" class="botao redondo fixed"><i class="fa fa-plus"></i></button>

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
    	var expositores = <? echo json_encode($expositores); ?>
    </script>
    <script src="../js/geral/jquery.mask.js?<? echo time(); ?>"></script>
    <script src="../js/geral/geral.js?<? echo time(); ?>"></script>
    <script src="../js/geral/dashboard.js?<? echo time(); ?>"></script>
    <script src="../js/adm/expositores.js?<? echo time(); ?>"></script>
</html>