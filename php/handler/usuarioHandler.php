<?
require "../database/conexao.php";
require "../classes/usuario.class.php";
require "../util/listarArquivos.php";
require "../vendor/autoload.php";

if (isset($_POST['funcao'])) {
	if (!isset($_SESSION)) session_start();
	$dados = $_POST;
	$arquivos = $_FILES;
	$funcao = $dados['funcao']; unset($dados['funcao']);
	$usuario_sessao = isset($_SESSION['usuario'])?unserialize($_SESSION['usuario']):0;
	
	if ($funcao=="cadastro") {
		$tipoUsuario = isset($dados['tipoUsuario'])?$dados['tipoUsuario']:'visitante'; unset($dados['tipoUsuario']);
		$usuario = new Usuario($dados);
		$result = $usuario->cadastrar($tipoUsuario);
		
		echo json_encode($result);
		exit;
	} 
	else if ($funcao=="login") {
		$usuario = new Usuario($dados);
		$result = $usuario->login();
		
		echo json_encode($result);
		exit;
	}
	else if ($funcao=="atualizar") {
		$eu = isset($dados['eu'])?true:false; unset($dados['eu']);
		$tipoUsuario = isset($dados['tipoUsuario'])?$dados['tipoUsuario']:'visitante'; unset($dados['tipoUsuario']);
		if ($eu) {
			$temp = unserialize($_SESSION['usuario']);

			foreach($dados as $key => $value) {
				if ($value==$temp->$key and $key!="id") {
					unset($dados[$key]);
				}
			}

			$dados['foto_perfil'] = $temp->foto_perfil;
		}
		
		$usuario = new Usuario($dados);
		$result = $usuario->atualizar($arquivos, $tipoUsuario);

		if ($eu) {
			foreach($result['atualizado'] as $key => $value) {
				$temp->$key = $value;
			}
			
			$_SESSION['usuario'] = serialize($temp);
		}
		
		echo json_encode($result);
		exit;
	}
	else if ($funcao=="atualizarPin") {
		$usuario = new Usuario($dados);
		$result = $usuario->atualizarPin();
		
		echo json_encode($result);
		exit;
	}
	else if ($funcao=="emailModerador") {
		$usuario = new Usuario($dados);
		$result = $usuario->emailModerador();

		echo json_encode($result);
		exit;
	}
	else if ($funcao=="recuperarSenha") {
		$usuario = new Usuario($dados);
		$result = $usuario->recuperarSenha();
		
		echo json_encode($result);
		exit;
	} 
} 
else {
	echo json_encode(array(
		'estado' => 2,
		'mensagem' => "Post inexistente"
	));
	exit;
}
?>