<?php

	include("php/domain/Usuario.php");
	include("php/domain/Evento.php");
	include("php/domain/Contatos.php");
	
	require_once 'vendor/autoload.php';
	
use Endroid\Gcm\Client;
	
	switch ($_POST['method']){
		case 'inserirUsuario':
			$usuario = utf8_encode($_POST['json']);
			$usuario = json_decode($usuario);
			
			$objUsuario = new Usuario();
			
			$objUsuario->setTelefone($usuario->ds_telefone);
			$objUsuario->setNome($usuario->ds_nome);
			$objUsuario->setDDI($usuario->nr_ddi);
			$objUsuario->setFotoPerfil($usuario->ds_foto_perfil);
			echo $objUsuario->inserirUsuario($objUsuario);
		break;	 
		
	
	
		case'inserirEvento':
			$evento = utf8_encode($_POST['json']);
			$evento = json_decode($evento);
			$objEvento = new Evento();
			
			$objEvento->setTituloEvento($evento->ds_titulo_evento);
			$objEvento->setDescricao($evento->ds_descricao);
			$objEvento->setCodigoUsarioInclusao($evento->cd_usario_inclusao);
			$objEvento->setDataEvento($evento->dt_evento);
			$objEvento->setEventoPrivado($evento->fg_evento_privado);
			$objEvento->setEndereco($evento->ds_endereco);
			$objEvento->setLatitude($evento->nr_latitude);
			$objEvento->setLongitude($evento->nr_longitude);
			$objEvento->setFotoCapa($evento->ds_foto_capa);
			$objEvento->setNomeArquivoFoto($evento->ds_nome_arquivo_foto);
			echo ($objEvento->inserirEvento());
			
		break;
	
		case 'selecionarEvento':
			$evento = utf8_encode($_POST['json']);
			$evento = json_decode($evento);
			$cd_evento = $evento->cd_evento;
			$cd_usuario = $evento->cd_usuario;
			$objEvento = new Evento();
			echo $objEvento->selecionarEvento($cd_evento, $cd_usuario);
		break;
			
		case 'atualizarContatos':
			$contatos = utf8_encode($_POST['json']);
			$contatos = json_decode($contatos);
			$objContatos = new Contatos();
			echo $objContatos->atualizarContatos($contatos);
			
		break;
	
		case 'selecionarTopFestas':
			$objEvento = new Evento();
			$resultado = $objEvento->selecionarTopFestas();
			echo $resultado;
		break;
		
		
		case 'selecionarTopConvidados':
			$objEvento = new Evento();
			echo $objEvento->selecionarTopConvidados();
		break;
			
		case 'selecionarTopComentarios':
			$objEvento = new Evento();
			echo $objEvento->selecionarTopComentarios();
		break;
			
		case 'buscarEventosProximos':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$objEvento = new Evento();
			echo $objEvento->buscarEventosProximos($dados->nr_latitude, $dados->nr_longitude, $dados->nr_distancia);
		break;
		
		case 'classificarEvento':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$cd_usuario = $dados->cd_usuario;
			$cd_evento = $dados->cd_evento;
			$ind_classificacao = $dados->ind_classificacao;
			$objEvento = new Evento();
			echo $objEvento->classificar($cd_usuario,$cd_evento,$ind_classificacao);
		
		break;
	
		case 'buscarNovidades':
			echo 'Aguardando implementação';
		break;
		
		case 'comentarEvento':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$objEvento = new Evento();
			echo $objEvento->comentar($dados->cd_evento, $dados->cd_usuario, $dados-> ds_comentario);
			
		break;
		
		case 'selecionarComentarios':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$objEvento = new Evento();
			echo $objEvento->selecionarComentarios($dados->cd_evento);
			
		break;
		
		case 'atualizarToken':
			$usuario = utf8_encode($_POST['json']);
			$usuario = json_decode($usuario);			
			$objUsuario = new Usuario();
			$objUsuario->setCodigoUsuario($usuario->cd_usuario);
			$objUsuario->setToken($usuario->ds_token);
			echo $objUsuario->atualizarToken();
		
		break;
		
		case 'atualizarEvento':
			$evento = utf8_encode($_POST['json']);
			$evento = json_decode($evento);
			$cd_evento = $evento->cd_evento;
			$objEvento = new Evento();
			$objEvento->converterObjetoEvento($evento);
			echo $objEvento->atualizarEvento($cd_evento);
			
		break;
		
		case 'convidarUsuario':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$objEvento = new Evento();
			
			$count = count($dados->convidados);
			$cd_evento = $dados->cd_evento;
			$cd_usuario_inclusao = $dados->cd_usuario_inclusao;
			$ds_nome = $dados->ds_nome;
			
			foreach($dados->convidados as $convidado)
			{
				$objEvento->convidar($cd_evento,$convidado->cd_usuario, $cd_usuario_inclusao);
			}
			
			echo $objEvento->enviarMensagemConvite($cd_evento, $ds_nome);
			
		break;
		
		case 'cancelarEvento':
			$evento = utf8_encode($_POST['json']);
			$evento = json_decode($evento);
			$cd_evento = $evento->cd_evento;
			$objEvento = new Evento();
			echo $objEvento->cancelarEvento($cd_evento);
		
		break;
		
		case 'atualizarNome':
			$usuario = utf8_encode($_POST['json']);
			$usuario = json_decode($usuario);
			$objUsuario = new Usuario();
			echo $objUsuario->atualizarNome($usuario->ds_nome);
		break;
		
		case 'buscarConvites':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados );
			$codigoUsuario = $dados->codigoUsuario;
			$data = $dados->data;
			$objEvento = new Evento();
			echo $objEvento->buscarConvites($codigoUsuario ,$data);
	
		break;
		
		case 'participar':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$cd_usuario = $dados->cd_usuario;
			$cd_evento = $dados->cd_evento;
			$ds_nome = $dados->ds_nome;
			$objEvento = new Evento();			
			echo $objEvento->participar($cd_evento, $cd_usuario, $ds_nome);
		
		break;
		
		case 'selecionarEventosPorData':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$dt_evento = $dados->dt_evento;
			$cd_usuario = $dados->cd_usuario;
			$objEvento = new Evento();			
			echo $objEvento->selecionarEventosPorData($dt_evento, $cd_usuario);
		break;
		
		case 'selecionarTodosEventos':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$cd_usuario = $dados->cd_usuario;
			$objEvento = new Evento();	
			echo $objEvento->selecionarTodosEventos($cd_usuario);
			
		break;
		
		case 'buscarConvidados':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$cd_evento = $dados->cd_evento;
			$objContatos = new Contatos();
			echo $objContatos->buscarConvidados($cd_evento);
		break;
		
		case 'selecionarMeusEventos':
			$dados = utf8_encode($_POST['json']);
			$dados = json_decode($dados);
			$cd_usuario = $dados->cd_usuario;
			$dt_evento = $dados->dt_evento;
			$objEvento = new Evento();
			echo $objEvento->selecionarMeusEventos($cd_usuario,$dt_evento);
		break;
		
		default:
		

			
		break;
		
	}
	
	
?>