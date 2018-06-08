<?
require "../php/database/conexao.php";
require "../php/classes/usuario.class.php";
require "../php/util/listarArquivos.php";

date_default_timezone_set('America/Sao_Paulo');
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
		$titulo = "Documentos";
		include('menu.php'); 

		$diretorio = realpath(dirname(__DIR__).DIRECTORY_SEPARATOR."servidor".DIRECTORY_SEPARATOR."documentos".DIRECTORY_SEPARATOR.$usuario->id.DIRECTORY_SEPARATOR);
		// echo $diretorio;
		$documentos = listar($diretorio);
		$documentos = utf8ize($documentos)['informacoes'];

		usort($documentos, 'compara');

		function compara($a, $b) {
			return $a['time'] < $b['time'];
		}
		?>

		<article id="centro">
			<section id="documentos" class="painel">
				<h2>Boletos</h2>
				<table>
					<tr>
						<th>Nome</th>
						<th>Data</th>
						<th>Tipo</th>
						<th class="centro">Ações</th>
					</tr>
					
					<?
					foreach ($documentos as $key => $doc) {
					?>
					<tr data-index="<? echo $key ?>">
						<td><? echo ucfirst($doc['filename']); ?></td>
						<td><? echo date('d/m/Y, H:i', $doc['time']); ?></td>
						<td class="extensao"><? echo strtoupper($doc['extension']); ?></td>
						<td class="centro">
							<i class="fa fa-download baixar botao icon verde" title="Baixar Arquivo"></i>
							<i class="fa fa-eye ver botao icon amarelo" title="Abrir Arquivo"></i>
							<!-- <i class="fa fa-trash editar botao icon vermelho" title="Apagar Arquivo"></i> -->
						</td>
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
    	var documentos = <? echo json_encode($documentos); ?>
    </script>
    <script src="../js/geral/geral.js?<? echo time(); ?>"></script>
    <script src="../js/geral/dashboard.js?<? echo time(); ?>"></script>
    <script src="../js/adm/documentos.js?<? echo time(); ?>"></script>
</html>