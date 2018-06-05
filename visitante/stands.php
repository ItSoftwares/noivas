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
        <link rel="stylesheet" type="text/css" href="../css/visitante/visitante.css" media="(min-width: 1000px)">
        <link rel="stylesheet" type="text/css" href="../css/geral/geral.css" media="(min-width: 1000px)">
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/index.css" media="(max-width: 999px)"> -->
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/geral/geral.css" media="(max-width: 999px)"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body class="fechado">
		<? 
		$titulo = "Stands Visitados";
		include('menu.php'); 
		?>

		<article id="centro">
			<section id="stands-visitados" class="painel">
				<!-- <h2>Stands Visitados</h2> -->

				<table>
					<tr>
						<th>#</th>
						<th>Stand</th>
						<th>Data da Visita</th>
						<th class="centro">Número da Sorte</th>
					</tr>

					<?
					for ($i=0; $i < 10; $i++) { 
					?>
					<tr>
						<td><? echo $i ?></td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
						<td>27/09/2019 às 19:00</td>
						<td class="centro">10234</td>
					</tr>
					<?
					}
					?>
				</table>
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
</html>