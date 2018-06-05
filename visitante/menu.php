<aside id="menu-lateral">
	<!-- <header>
		<img src="../img/logo1.png">
	</header> -->

	<ul class="">
		<h3>Menu</h3>
		<li class="<? echo $titulo=='Stands Visitados'?'selecionado':'' ?>">	
			<a href="stands-visitados">
				<i class="fa fa-eye"></i>
				<span>Stands Visitados</span>
			</a>
		</li>
		<li class="<? echo $titulo=='Sorteios'?'selecionado':'' ?>">	
			<a href="sorteios">
				<i class="fas fa-dice"></i>
				<span>Sorteios</span>
			</a>
		</li>
		<li class="<? echo $titulo=='Meu Perfil'?'selecionado':'' ?>">	
			<a href="perfil">
				<i class="fa fa-user"></i>
				<span>Perfil</span>
			</a>
		</li>
	</ul>

	<img src="../img/logo1.png" alt="" id="logo">

	<div id="visitante">
		<h3>Nome da pessoa</h3>

		<i class="fa fa-cog" id="sair"></i>
	</div>
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