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
        $usuario = new Usuario($dados);
        $result = $usuario->cadastrar();
        
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
        $temp = unserialize($_SESSION['perfil_editado']);
        $user = unserialize($_SESSION['usuario']);
        
        foreach($dados as $key => $value) {
            if ($value==$temp->$key and $key!="id") {
                unset($dados[$key]);
            }
        }
        
        $dados['foto_perfil'] = $temp->foto_perfil;
        
        $usuario = new Usuario($dados);
        $result = $usuario->atualizar($arquivos);
        
        foreach($result['atualizado'] as $key => $value) {
            $temp->$key = $value;
        }
        
        $_SESSION['perfil_editado'] = serialize($temp);
        
        if ($user->id==$temp->id) {
            $_SESSION['usuario'] = serialize($temp);
        } else if (is_object($usuario_moderador)) {
            $usuario->novoLogModerador(array(
                'descricao' => "O moderador <b>{$usuario_moderador->nickname}</b> atualizou informações em seu perfil!",
                'id_moderador' => $user->id,
                'id_usuario' => $temp->id
            ));
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