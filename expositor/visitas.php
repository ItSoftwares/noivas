<?
require "../php/database/conexao.php";
require "../php/classes/usuario.class.php";

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
		$titulo = "Visitas";
		include('menu.php'); 

		$visitas = DBselect('visita v INNER JOIN visitante u ON v.id_usuario = u.id', "where id_expositor={$usuario->id} order by id DESC", 'v.*, u.nome');
		?>

		<article id="centro">
			<section id="ultimos" class="painel">
				<h2>Ultimos Visitantes</h2>
				<table>
					<tr>
						<th>Visitante</th>
						<th>Data</th>
						<th class="centro">Número da Sorte</th>
					</tr>

					<?
					foreach ($visitas as $key => $value) {
					?>
					<tr>
						<td><? echo $value['nome']; ?></td>
						<td><? echo date('d/m/Y, H:i', strtotime($value['time'])); ?></td>
						<td class="centro"><? echo $value['id']; ?></td>
					</tr>
					<?
					}
					?>
				</table>
			</section>

			<button class="botao redondo fixed" id="nova"><i class="fa fa-plus"></i></button>

			<footer>
				<ul id="redes-sociais" class="transition">
					<li><a href="facebook" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="twitter" class="twitter"><i class="fab fa-twitter"></i></a></li>
					<li><a href="instagram" class="instagram"><i class="fab fa-instagram"></i></a></li>
				</ul>

				<a href="www.itsoftwares.com/itsoftwares">Desenvolvido por ItSoftwares</a>
			</footer>
		</article>

		<? include('../html/modals.html'); ?>
    </body>

    <script type="text/javascript">  
    	var usuario = <? echo json_encode($usuario->toArray()) ?>;
    </script>
    <script src="../js/geral/geral.js?<? echo time(); ?>"></script>
    <script src="../js/geral/dashboard.js?<? echo time(); ?>"></script>
    <script src="../js/expositor/visitas.js?<? echo time(); ?>"></script>
</html>