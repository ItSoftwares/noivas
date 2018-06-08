<?
if (!isset($_SESSION)) session_start();
$usuario = unserialize($_SESSION['usuario']);
?>
<aside id="menu-lateral">
	<ul class="">
		<li class="<? echo $titulo=='Visitas'?'selecionado':'' ?>">	
			<a href="visitas">
				<i class="fa fa-user-friends"></i>
				<span>Visitas</span>
			</a>
		</li>
		<li class="<? echo $titulo=='Documentos'?'selecionado':'' ?>">	
			<a href="documentos">
				<i class="fa fa-file-alt"></i>
				<span>Documentos</span>
			</a>
		</li>
		<li class="<? echo $titulo=='Perfil'?'selecionado':'' ?>">	
			<a href="perfil">
				<i class="fa fa-user"></i>
				<span>Perfil</span>
			</a>
		</li>
	</ul>

	<img src="../img/logo1.png" alt="" id="logo">
</aside>	

<header id="topo">
	<div id="toggle-menu" class="transition">
		<span></span>
		<span></span>
		<span></span>
	</div>
	<h1><? echo $titulo; ?></h1>
	<div id="perfil">
		<img src="../img/profile-default.png">
		<div id="nome">
			<h2>Nome do usuário</h2>
			<p><? echo date('d/m/Y'); ?></p>
		</div>
		<i class="fa fa-ellipsis-h"></i>

		<ul id="perfil-menu" class="transition">
			<li id="sair">Sair</li>
		</ul>
	</div>
</header>