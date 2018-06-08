<?

class Usuario {

	private $props = []; 
	public $valores_atualizar = array();
	
	public function cadastrar($tipo = 'visitante') {
		$senha_digitada = $this->senha;
		
		$result = DBselect('adm', "where email = '{$this->email}'", 'email');
		$result2 = DBselect('visitante', "where email = '{$this->email}'", 'email');
		$result3 = DBselect('expositor', "where email = '{$this->email}'", 'email');
		
		if (count($result)>0 or count($result2)>0 or count($result3)>0) {
			// $result = $result[0];
			return array('estado'=>2, 'mensagem'=>"Já existe algum usuário cadastrado com esse email!");
		} else {
			$qtd = DBselect("adm", "", "count(*) as qtd")[0]['qtd'];

			if ($qtd==0) {
				$this->hash = time();
				$this->senha = md5($this->senha.$this->hash);
				
				$dados = array_filter($this->toArray());
				$dados['pin'] = '1111';
				DBcreate("adm", $dados);
				
				$retorno = "Conta Administrador criada com sucesso!";
				$tipo = 'adm';
			} else {
				$dados = array_filter($this->toArray());

				if ($tipo=="visitante") $this->id = DBcreate('visitante', $dados);
				else if ($tipo=="expositor") $this->id = DBcreate('expositor', $dados);

				$retorno = "Conta criada com sucesso!";
			}
			
			// ENVIAR EMAIL DE CONFIRMAÇÃO DE CADASTRO
			$mensagem = "<p>{$this->nome} ({$this->nickname})</p>";
			$mensagem .= "<p>VOCÊ ESTÁ NO SITE DE HQs E NOVELS MAIS DIVERTIDO DA INTERNET.</p>";
			$mensagem .= "<p>NOSSA MISSÃO? ENTRETER VOCÊ QUE AMA ESTA ARTE, VALORIZANDO OS ARTISTAS DOS QUADRINHOS COM UMA PLATAFORMA DEDICADA A ELES.</p>";
			$mensagem .= "<p>SABOREIE OS TÍTULOS SEM MODERAÇÃO.</p>";
			$mensagem .= "<p>VENHA SEMPRE!</p>";
			
			$result = $this->mensagem($mensagem, "Bem-vindo a nossa plataforma");
			
			return array('estado'=>1, 'mensagem'=>$retorno, 'tipo_usuario'=>$tipo, 'usuario'=>$this->toArray());
		}
	}
	
	public function login() {
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$result = DBselect('adm');

			if (count($result)==0) {
				$result = $this->cadastrar();
				return $result;
			}

			$usuarios = ['adm', 'visitante', 'expositor'];

			foreach ($usuarios as $value) {
				$result = DBselect($value, "where email = '{$this->email}'");
				
				// Verifica se usuário está cadastrado
				if (count($result)>0) {
					$result = $result[0];
					// Verifica se senha está correta

					$senha = $this->senha;
					if ($value=='adm') $senha = md5($this->senha.$result['hash']);

					if ($result['senha'] == $senha) {
						unset($_SESSION['usuario']);
						// echo "empresa encontrado";

						// CAPTURAR TODAS AS INFORMAÇÕES DO empresa
						$dados = $result;
						$this->fromArray($dados);
						$this->valores_atualizar = array();
						
						// TEMPO PARA EXPIRAR SESSÃO
						$_SESSION['expire'] = time();

						// IDENTIFICAR SESSÃO
						$_SESSION['donoSessao']=md5('sat'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
						// session_name($_SESSION['donoSessao']);
						
						// MENSAGEM de boa vindas
						if ($this->ultimo_login==null or $this->ultimo_login=="") {
							$_SESSION['conf_msg'] = "Bem vindo a ZINNES. Toda a equipe estará a disposição!";
						}

						$_SESSION['tipo_usuario'] = $value;
						
						// RETORNO
						$_SESSION['usuario'] = serialize($this);
						
						return array('estado'=>1, 'mensagem'=> "Redirecionando...", 'tipo_usuario' => $value);
					} else {
						return array('estado'=>2, 'mensagem'=> "Senha incorreta para esta conta!");
					}
				}
			}

			return array('estado'=>2, 'mensagem'=> "Credenciais inválidas!");
		} else {
			return array('estado'=>2, 'mensagem'=> "Digite um email válido");
		}
	}

	public function recuperarSenha() {
		if (!$this->carregar(null,null,$this->email)) {
			return array('estado'=>2, 'mensagem'=>"Email não encontrado!");
		}
		// link válido por 1 hora
		$agora = time();
		$url = "www.zinnes.com.br/recuperarSenha?hash={$this->senha}&time={$agora}&id={$this->id}";

		$texto = "<p>Você solicitou recuperação de senha. Para alterar sua senha acesse o link abaixo clicando no botão ou colando o LINK diretamente no navegador!</p>";
		$texto .= "<a href='{$url}' class='botao' target='_BLANK'>Clique Aqui</a>";
		$texto .= "<br>";
		$texto .= "<p>Não consegue acessar o link? Copie e cole-o no navegador: {$url}</p>";

		if ($this->mensagem($texto, "Recuperar senha")==1) {
			return array('estado'=>1, 'mensagem'=>"Email enviado com sucesso, verifique sua caixa de emails!");
		} else {
			return array('estado'=>2, 'mensagem'=>"Problemas ao enviar email, tente novamente mais tarde!");
		}
	}
	
	public function atualizar($arquivos = null, $tipoUsuario) {
		if ($this->estaDeclarado('email')) {
			$email = DBselect($tipoUsuario, "where email='{$this->email}' and id<>{$this->id}");
			
			if (count($email)>0) {
				return array('estado'=>2, 'mensagem'=>"Já existe um usuário com esse Email!");
			}
		}
		
		if ($this->senha=="") {
			$this->unsetAtributo('senha');
		}
		else if ($tipoUsuario=='adm') {
			$this->hash = time();
			$this->senha = md5($this->senha.$this->hash);
		}
		
		if ($arquivos!=null and is_uploaded_file($arquivos['imagem-perfil']['tmp_name'])) {
			$this->foto_perfil = $this->mudarFoto($arquivos['imagem-perfil'], $this->larguraImagem, $this->alturaImagem);
			$this->unsetAtributo('alturaImagem');
			$this->unsetAtributo('larguraImagem');
		}
		
		$temp = $this->id;
		DBupdate($tipoUsuario, $this->valores_atualizar, "where id={$temp}");
		
		$this->valores_atualizar = array();
		return array('estado'=>1, 'mensagem'=>"Informações atualizadas com sucesso!", 'atualizado' => $this->toArray());
	}
	
	public function mensagem($texto_mensagem, $titulo = "Mensagem Plataforma") {

		$mensagem = file_get_contents(dirname(__DIR__, 2)."/html/emailGeral.html");
		// echo dirname(__DIR__, 2)."/html/emailGeral.html"; exit;
		$mensagem = str_replace("--TITULO--", $titulo, $mensagem);
		$mensagem = str_replace("--MENSAGEM--", $texto_mensagem, $mensagem);

		$mail = new PHPMailer;

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->addAddress($this->email, $this->nome);

		$mail->SMTPDebug = 0;                            // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'suporte@zinnes.com.br';                 // SMTP username
		$mail->Password = 'zinnes123';                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                  // TCP port to connect to

		$mail->setFrom('suporte@zinnes.com.br', 'ZINNES');

		$mail->DEBUG = 0;
		$mail->Subject = $titulo.' - ZINNES';
		$mail->isHTML(true);
		$mail->Body = $mensagem;
		$mail->CharSet = 'UTF-8';

		if (!$mail->send()) {
			// erro
			// echo $mail->ErrorInfo;
			return 2;
		} else {
			$mail->ClearAllRecipients();
			
			return 1;
		}
	}

	public function mudarFoto($imagem, $w, $h) {
		$dirname = realpath("../..".DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'servidor'.DIRECTORY_SEPARATOR.'thumbs-usuarios'.DIRECTORY_SEPARATOR;
		$save = $this->id.time().".png";
		
		switch (pathinfo($imagem['name'], PATHINFO_EXTENSION))
		{
			case 'jpeg':
			case 'jpg':
				$img = imagecreatefromjpeg($imagem['tmp_name']);
			break;
			case 'png':
				$img = imagecreatefrompng($imagem['tmp_name']);
			break;
			default:
				die('Invalid image type');
		}
		
		$img2 = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => $w, 'height' => $w]);

		imagejpeg($img2, $dirname.$save, 75);
		imagedestroy($img2);
		
		if ($this->foto_perfil!=null || $this->foto_perfil!="") unlink($dirname.$this->foto_perfil);
		
		return $save;
	}

	public function atualizarPin() {
		DBupdate("moderador", array('pin' => "{$this->pin}"), "where id_usuario={$this->id_usuario}");

		return array('estado'=>1, 'mensagem'=>"PIN atualizado com sucesso!");
	}

	public function toArray() {
		return $this->props;
	}
	
	public function fromArray($post) {
		foreach($post as $key => $value) {
			$this->props[$key] = $value;
			$this->valores_atualizar[$key] = $value;
		}
	}
	
	public function unsetAtributo($chave) {
		unset($this->props[$chave]);
		unset($this->valores_atualizar[$chave]);
	}
	
	public function estaDeclarado($chave) {
		if (isset($this->props[$chave])) return true;
		else return false;
	}
	
	public function novoLogModerador($log) {
		$id = DBcreate('log_moderador', $log);
	}
	
	public function pegarNotificacoes($data = 0) {
		$extra = $data!=0?" and n.data < '".date('Y-m-d H:i:s', $data)."'":"";
		$extra2 = $data!=0?" and data < '".date('Y-m-d H:i:s', $data)."'":"";
		
		$notificacoes = DBselect('notificacao n INNER JOIN titulo t ON n.id_titulo = t.id INNER JOIN projeto p ON t.id_projeto = p.id', "where n.id_usuario = {$this->id}{$extra} order by n.data DESC limit 10", "n.*, t.nome, t.descricao, t.id_projeto, t.thumb_titulo, p.thumb_projeto, p.tipo");
		
		$logs = DBselect('log_moderador', "where id_usuario = {$this->id}{$extra2} order by data DESC limit 10");

		$comentarios = DBselect('notificacao_comentario n INNER JOIN usuario u ON u.id = n.id_de', "where id_usuario = {$this->id}{$extra2} or id_titulo in (select id from titulo where id_projeto in (select id from projeto where id_usuario = {$this->id})) order by data DESC limit 10", 
			"n.*, u.foto_perfil, u.nickname, 
			(select tipo from projeto where id in (select id_projeto from titulo where id = n.id_titulo)) tipo, 
			(select nome from titulo where id = n.id_titulo) titulo");
			
		// $comentarios = [];
		
		DBupdate("notificacao", array('lido' => 1), "where id_usuario={$this->id}");
		DBupdate("log_moderador", array('lido' => 1), "where id_usuario={$this->id}");
		DBupdate("notificacao_comentario", array('lido' => 1), "where id_usuario = {$this->id} or id_titulo in (select id from titulo where id_projeto in (select id from projeto where id_usuario = {$this->id}))");
		
		$notificacoes = $notificacoes==null?[]:$notificacoes;
		$logs = $logs==null?[]:$logs;

		$retorno = [];
		$retorno['notificacoes'] = $notificacoes;
		$retorno['logs'] = $logs;
		$retorno['comentarios'] = $comentarios;
		if (count($notificacoes)<10 and count($logs)<10 and count($comentarios)<10) $retorno['acabou'] = 1;
		
		return $retorno;
	}
	
	public function lerNotificacao($data) {
		
	}
	
	// Gets e Sets
	public function __get($name) {
		if (isset($this->props[$name])) {
			return $this->props[$name];
		} else {
			return false;
		}
	}

	public function __set($name, $value) {
		$this->props[$name] = $value;
		$this->valores_atualizar[$name] = $value;
	}
	
	public function __wakeup(){
		foreach (get_object_vars($this) as $k => $v) {
			$this->{$k} = $v;
		}
	}
	
	public function __construct($dados=null) {
		if ($dados!=null) {
			$this->fromArray($dados);
		}
	}
}

?>