<?php

	require_once("php/helpers/MySQLHelper.php");
	require_once("php/domain/Usuario.php");
	require_once("php/domain/PushMessage.php");

	class Evento {
		private $cd_evento;
        private $ds_titulo_evento;
        private $ds_descricao;
        private $cd_usuario_inclusao;
        private $dt_evento;
        private $dt_inclusao;
        private $dt_alteracao;
        private $fg_evento_privado;
        private $ds_endereco;
        private $nr_latitude;
        private $nr_longitude;
        private $ds_caminho_foto_capa;
        private $ds_foto_capa;
        private $ds_url_foto;
        private $img_foto_capa;
		
		
		// PROPRIEDADES
		
		public function getCodigoEvento() {
            return $this->cd_evento;
        }

        public function setCodigoEvento($cd_evento) {
            $this->cd_evento = $cd_evento;
        }

        public function getTituloEvento() {
            return $this->ds_titulo_evento;
        }
	
        public function setTituloEvento($ds_titulo_evento) {
            $this->ds_titulo_evento = $ds_titulo_evento;
        }

        public function getDescricao() {
            return $this->ds_descricao;
        }

        public function setDescricao($ds_descricao) {
            $this->ds_descricao = $ds_descricao;
        }

        public function getCodigoUsuarioInclusao() {
            return $this->cd_usuario_inclusao;
        }

        public function setCodigoUsuarioInclusao($cd_usuario_inclusao) {
            $this->cd_usuario_inclusao = $cd_usuario_inclusao;
        }

        public function getDataEvento() {
            return $this->dt_evento;
        }

        public function setDataEvento($dt_evento) {
            $this->dt_evento = $dt_evento;
        }

        public function getDataInclusao() {
            return $this->dt_inclusao;
        }

        public function setDataInclusao($dt_inclusao) {
            $this->dt_inclusao = $dt_inclusao;
        }

        public function getDataAlteracao() {
            return $this->dt_alteracao;
        }

        public function setDataAlteracao($dt_alteracao) {
            $this->dt_alteracao = $dt_alteracao;
        }

        public function getEventoPrivado() {
            return $this->fg_evento_privado;
        }

        public function setEventoPrivado($fg_evento_privado) {
            $this->fg_evento_privado = $fg_evento_privado;
        }

        public function getEndereco() {
            return $this->ds_endereco;
        }

        public function setEndereco($ds_endereco) {
            $this->ds_endereco = $ds_endereco;
        }

        public function getLatitude() {
            return $this->nr_latitude;
        }

        public function setLatitude($nr_latitude) {
            $this->nr_latitude = $nr_latitude;
        }

        public function getLongitude() {
            return $this->nr_longitude;
        }

        public function setLongitude($nr_longitude) {
            $this->nr_longitude = $nr_longitude;
        }

        public function getCaminhoFotoCapa() {
            return $this->ds_caminho_foto_capa;
        }

        public function setCaminhoFotoCapa($ds_caminho_foto_capa) {
            $this->ds_caminho_foto_capa = $ds_caminho_foto_capa;
        }

        public function getFotoCapa() {
            return $this->ds_foto_capa;
        }

        public function setFotoCapa($ds_caminho_foto_capa) {
            $this->ds_foto_capa = $ds_caminho_foto_capa;
        }

        public function getNomeArquivoFoto() {
            return $this->ds_nome_arquivo_foto;
        }

        public function setNomeArquivoFoto($ds_nome_arquivo_foto) {
            $this->ds_nome_arquivo_foto = $ds_nome_arquivo_foto;
        }

        public function getUrlFoto() {
            return $this->ds_url_foto;
        }

        public function setUrlFoto($ds_url_foto) {
            $this->ds_url_foto = $ds_url_foto;
        }

        public function getImagemFotoCapa() {
            return $this->img_foto_capa;
        }

        public function setImagemFotoCapa($img_foto_capa) {
            $this->img_foto_capa = $img_foto_capa;
        }
		
		// MÉTODOS
		
		function retornarArrayEvento($result)
		{
			$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["cd_evento"] = $row["cd_evento"];
					$row_array["ds_titulo_evento"] = $row["ds_titulo_evento"];
					$row_array["ds_descricao"] = $row["ds_descricao"];
					$row_array["cd_usuario_inclusao"] = $row["cd_usuario_inclusao"];
					$row_array["dt_evento"] = $row["dt_evento"];
					$row_array["fg_evento_privado"] = $row["fg_evento_privado"];
					$row_array["ds_endereco"] = $row["ds_endereco"];					
					$row_array["nr_latitude"] = $row["nr_latitude"];
					$row_array["nr_longitude"] = $row["nr_longitude"];
					$row_array["fg_participa"] = $row["fg_participa"];
					if (!is_null($row["ind_classificacao"]))
						$row_array["ind_classificacao"] = $row["ind_classificacao"];
					if (!is_null($row["nr_convidados"]))
						$row_array["nr_convidados"]  = $row["nr_convidados"]; 
					if (!is_null($row["nr_comentarios"]))
						$row_array["nr_comentarios"]  = $row["nr_comentarios"]; 

					
					array_push($return,$row_array);
				}	
			}
			
			return json_encode($return);
		}
		
		function converterObjetoEvento($evento)
		{
			$this->setTituloEvento($evento->ds_titulo_evento);
			$this->setDescricao($evento->ds_descricao);
			$this->setCodigoUsuarioInclusao($evento->cd_usuario_inclusao);
			$this->setDataEvento($evento->dt_evento);
			$this->setEventoPrivado($evento->fg_evento_privado);
			$this->setEndereco($evento->ds_endereco);
			$this->setLatitude($evento->nr_latitude);
			$this->setLongitude($evento->nr_longitude);
			$this->setFotoCapa($evento->ds_foto_capa);
			$this->setNomeArquivoFoto($evento->ds_nome_arquivo_foto);
			$this->setDataAlteracao($evento->dt_alteracao);
		}
		
		function retonarArrayComentarios($result){
			$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["cd_comentario"] = $row["cd_comentario"];
					$row_array["ds_nome"] = $row["ds_nome"];
					$row_array["ds_comentario"] = $row["ds_comentario"];
					array_push($return,$row_array);
				}
			}
			
			return json_encode($return);
			
		}
		
		function inserirEvento()
		{
			$connect = new conexaoBD();
			$connect->conectar();
			
			$foto = base64_decode($this->ds_foto_capa);
		 
			$query = "insert into tb_evento 
						(
							ds_titulo_evento, 
							ds_descricao, 
							dt_inclusao, 
							fg_evento_privado, 
							cd_usuario_inclusao, 
							dt_evento, 
							ds_endereco, 
							nr_latitude, 
							nr_longitude
						)
						VALUES 
						(
							'".$this->ds_titulo_evento."', 
							'". $this->ds_descricao ."' ,
							'". $this->dt_inclusao ."' , 
							'". $this->fg_evento_privado."' , 
							'".$this->cd_usuario_inclusao."' , 
							'".$this->dt_evento."' , 
							'". $this->ds_endereco."', 
							'". $this->nr_latitude ."' , 
							'". $this->nr_longitude ."'
						)";
			
			$codigo_evento =  $connect->inserir($query);
			
			$query = "INSERT INTO tb_evento_convidado
						(
							cd_evento,
							cd_usuario_inclusao,
							cd_usuario,
							fg_participa,
							fg_notificacao_pendente 
						) 
						VALUES 
						(
							".$codigo_evento.",
							".$this->cd_usuario_inclusao.",
							".$this->cd_usuario_inclusao.",
							1,
							0
						)";
						
			$connect->inserir($query);
			
			$file = fopen('capa_evento/'. $codigo_evento . '.png' ,'wb');
			fwrite($file, $foto);
    		fclose($file);
			
			$connect->desconectar();
			return $codigo_evento;
			
		}
		
		function selecionarEvento($cd_evento, $cd_usuario)
		{
			$connect = new conexaoBD();
			$connect->conectar();
			$query = "SELECT DISTINCT
						 e.cd_evento,
						 e.ds_titulo_evento,
						 e.ds_descricao,
						 e.nr_latitude,
						 e.nr_longitude,
						 e.cd_usuario_inclusao,
						 DATE_FORMAT(e.dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						 DATE_FORMAT(e.dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						 DATE_FORMAT(e.dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						 e.fg_evento_privado,
						 e.ds_endereco,
						 e.fg_cancelado,
						 IFNULL(ec.fg_participa, 0) AS fg_participa,
						 IFNULL(ecl.ind_classificacao,0) AS ind_classificacao
						FROM tb_evento e
						LEFT JOIN tb_evento_convidado ec on e.cd_evento = ec.cd_evento AND ec.cd_usuario = $cd_usuario
						LEFT JOIN tb_evento_classificacao ecl on ecl.cd_evento = e.cd_evento AND ecl.cd_usuario = $cd_usuario 
						WHERE e.cd_evento = $cd_evento ";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
		}
		
		function atualizarEvento($cd_evento, $ds_mensagem = null)
		{
			$connect = new conexaoBD();
			$connect->conectar();
			$query =  
				"UPDATE tb_evento SET
					ds_titulo_evento = '". $this->getTituloEvento()	."',
					ds_descricao = '" . $this->getDescricao()		."',
					ds_endereco = '". $this->getEndereco()			."',
					dt_evento = '". $this->getDataEvento()			."',
					nr_latitude = '". $this->getLatitude()			."',
					nr_longitude = '". $this->getLongitude()			."',
					fg_evento_privado = '". $this->getEventoPrivado()."' ,
					dt_alteracao = '". $this->getDataAlteracao()."' 
				WHERE cd_evento = " .$cd_evento ;
				
			$return = $connect->atualizar($query);
			
			if ($ds_mensagem != null)
			{			
				$query = "SELECT DISTINCT ds_token FROM tb_evento_convidado ec
							INNER JOIN tb_usuario u on ec.cd_usuario = u.cd_usuario
							WHERE cd_evento = $cd_evento 
							AND ec.cd_usuario <> ec.cd_usuario_inclusao";
	
				$ids = array();
				$result = $connect->pesquisar($query);
				if (mysqli_num_rows($result) > 0) {
					while ($row = $result->fetch_assoc())
					{
						$ids[] = $row["ds_token"];
					}
				}
				
				
				if  (count($ids) > 0){				
					$title = "Houve uma alteração no evento";
					$message = $ds_mensagem;
					$objMensagem = new PushMessage();
					$objMensagem->enviarNotificacao($title, $message, $ids, 'atualizacaoEvento', $cd_evento);
				}
			}
			
			
			$connect->desconectar();
			return $return;
		}

		function selecionarTopFestas()
		{
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT 
						cd_evento,
						ds_titulo_evento,
						ds_descricao,
						nr_latitude,
						nr_longitude,
						cd_usuario_inclusao,
						DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						DATE_FORMAT(dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						DATE_FORMAT(dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						fg_evento_privado,
						ds_endereco,
						fg_cancelado, 
						(select avg(ind_classificacao) from tb_evento_classificacao where cd_evento = tb_evento.cd_evento) as ind_classificacao
						FROM tb_evento 
					  WHERE fg_cancelado = 0 AND Date(dt_evento) 
					  BETWEEN Date(Date_Sub(now(),Interval 1 MONTH)) 
					  AND Date(now())
					  ORDER BY ind_classificacao DESC";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return 	$return;
	
		}
		
		function selecionarTopConvidados()
		{
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT 
						cd_evento,
						ds_titulo_evento,
						ds_descricao,
						nr_latitude,
						nr_longitude,
						cd_usuario_inclusao,
						DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						DATE_FORMAT(dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						DATE_FORMAT(dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						fg_evento_privado,
						ds_endereco,
						fg_cancelado, 
						(select count(cd_evento) from tb_evento_convidado where cd_evento = tb_evento.cd_evento ) as nr_convidados
						FROM tb_evento 
					WHERE fg_cancelado = 0 AND Date(dt_evento) 
					BETWEEN Date(Date_Sub(now(),Interval 1 MONTH)) 
					AND Date(now())
					ORDER BY nr_convidados DESC
					LIMIT 10 ";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return 	$return;
	
		}
		
		function selecionarTopComentarios()
		{
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT 
						cd_evento,
						ds_titulo_evento,
						ds_descricao,
						nr_latitude,
						nr_longitude,
						cd_usuario_inclusao,
						DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						DATE_FORMAT(dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						DATE_FORMAT(dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						fg_evento_privado,
						ds_endereco,
						fg_cancelado, 
						(select count(cd_evento) from tb_evento_comentario where cd_evento = tb_evento.cd_evento ) as nr_comentarios
						FROM tb_evento 
					WHERE fg_cancelado = 0 AND Date(dt_evento) 
					BETWEEN Date(Date_Sub(now(),Interval 1 MONTH)) 
					AND Date(now())
					ORDER BY nr_comentarios DESC
					LIMIT 10";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return 	$return;
	
		}
		
		function buscarNovidades($cd_usuario){
			
		}
		
		function buscarEventosProximos($nr_latitude,$nr_longitude, $nr_distancia)
		{			
			$connect = new conexaoBD();	
			$connect->conectar();

			$query = "SELECT cd_evento,
						 ds_titulo_evento,
						 ds_descricao,
						 nr_latitude,
						 nr_longitude,
						 cd_usuario_inclusao,
						 DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						 DATE_FORMAT(dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						 DATE_FORMAT(dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						 fg_evento_privado,
						 ds_endereco,
						 ind_classificacao,
						 fg_cancelado, 
						 (
							6371 *
							acos(
								cos( radians( $nr_latitude ) ) *
								cos( radians( `nr_latitude` ) ) *
								cos(
									radians( `nr_longitude` ) - radians( $nr_longitude )
								) +
								sin(radians($nr_latitude)) *
								sin(radians(`nr_latitude`))
							)
						) as `distance`
						 FROM tb_evento  
						 WHERE fg_cancelado = 0
						 HAVING distance < $nr_distancia";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;

		}
		
		function comentar($cd_evento, $cd_usuario, $ds_comentario)
		{
			$connect = new conexaoBD();
			$objMensagem = new PushMessage();

			
			$connect->conectar();
			$query = "insert into tb_evento_comentario (cd_evento,cd_usuario,ds_comentario) values ('".$cd_evento ."','" .$cd_usuario . "' , '".$ds_comentario ."')";
			$return =  $connect->inserir($query);

			$query = "SELECT ds_token 
						FROM tb_usuario u 
						INNER JOIN tb_evento_convidado ec ON ec.cd_usuario = u.cd_usuario
						WHERE ec.cd_evento =".$cd_evento. "
						AND fg_participa = 1 " ; 

			$ids = array();
			$result = $connect->pesquisar($query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$ids[] = $row["ds_token"];
				}
			}
			
			$title = "Há um novo comentário em um evento que você esta participando";
			$message = "Cometário: " .$ds_comentario ;
			
			$objMensagem->enviarNotificacao($title, $message, $ids, 'comentario', $cd_evento);
			
			$connect->desconectar();
			return $return;
			
			
		}
		
		function selecionarComentarios ($cd_evento){
			$connect = new conexaoBD();
			$connect->conectar();
			$query = "SELECT 
						cd_comentario,
						ds_nome,
						ds_comentario 
					FROM tb_evento_comentario ec INNER JOIN tb_usuario u ON u.cd_usuario = ec.cd_usuario
					WHERE ec.cd_evento = ". $cd_evento;
					
			$result = $connect->pesquisar($query);
			$return = $this->retonarArrayComentarios($result);
			$connect->desconectar();
			return 	$return;
			
		}
		
		function convidar($cd_evento, $cd_usuario, $cd_usuario_inclusao){
			$connect = new conexaoBD();
			$connect->conectar();
			$query = "SELECT 1 FROM tb_evento_convidado WHERE cd_evento = $cd_evento AND cd_usuario = $cd_usuario";
			$result = $connect->pesquisar($query);
			if(mysqli_num_rows($result) < 1)
			{
				$query = "INSERT INTO tb_evento_convidado (cd_usuario, cd_evento, cd_usuario_inclusao , fg_notificacao_pendente) 
						VALUES (".$cd_usuario." , ". $cd_evento . " , ". $cd_usuario_inclusao." , 1)";
				$connect->inserir($query);
			}
			$connect->desconectar();
		}
		
		function classificar($cd_usuario, $cd_evento, $ind_classificacao){
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT cd_evento FROM tb_evento_classificacao 
					  WHERE cd_evento = $cd_evento
					  AND cd_usuario = $cd_usuario";
					  
			$result = $connect->pesquisar($query);
			if(mysqli_num_rows($result) > 0)
			{
				$query = "UPDATE tb_evento_classificacao 
						  SET ind_classificacao = $ind_classificacao
						  WHERE cd_evento = $cd_evento
						  AND cd_usuario = $cd_usuario";						
				
				$return = $connect->atualizar($query);	
			}
			else{

				$query = "INSERT INTO tb_evento_classificacao (cd_usuario, cd_evento,  ind_classificacao) 
						VALUES (".$cd_usuario." , ". $cd_evento . " , ". $ind_classificacao . ")";				
				$return = $connect->inserir($query);			
			}
			$connect->desconectar();
			return $return;
		}
		
		function cancelarEvento($cd_evento){
			$connect = new conexaoBD();
			$objMensagem = new PushMessage();
			$connect->conectar();
			$query = "UPDATE tb_evento SET fg_cancelado = 1 WHERE cd_evento = " . $cd_evento;
			$return = $connect->atualizar($query);
			
			$query = "SELECT ds_token 
						FROM tb_usuario u 
						INNER JOIN tb_evento_convidado ec ON ec.cd_usuario = u.cd_usuario
						WHERE ec.cd_evento =  " . $cd_evento; 

			$ids = array();
			$result = $connect->pesquisar($query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$ids[] = $row["ds_token"];
				}
			}
			
			if  (count($ids) > 0){				
				$title = "Evento cancelado";
				$message = "Evento cancelado" ;
				$objMensagem->enviarNotificacao($title, $message, $ids, 'cancelamento', $cd_evento);
			}
			
			$connect->desconectar();
			return $return;
		}
		
		function buscarConvites($codigoUsuario, $data){
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT DISTINCT
						e.cd_evento,
						e.ds_titulo_evento,
						e.ds_descricao,
						e.nr_latitude,
						e.nr_longitude,
						e.cd_usuario_inclusao,
						DATE_FORMAT(e.dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
						DATE_FORMAT(e.dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
						DATE_FORMAT(e.dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
						e.fg_evento_privado,
						e.ds_endereco,
						e.ind_classificacao,
						e.fg_cancelado,
						IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_comentario WHERE cd_evento = e.cd_evento), 0) AS nr_comentarios,
						IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_convidado WHERE cd_evento = e.cd_evento ), 0) AS nr_convidados
			 		FROM tb_evento e
					INNER JOIN  tb_evento_convidado ec ON  ec.cd_evento = e.cd_evento  AND ec.cd_usuario =  " .  $codigoUsuario . " 
					WHERE 
						fg_participa = 0  
						AND dt_evento > '" . $data ."'";
					

			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return 	$return;

				
		}
		
		function enviarMensagemConvite($cd_evento, $ds_nome){
			$connect = new conexaoBD();
			$objMensagem = new PushMessage();
			$connect->conectar();
			
			$query = "SELECT ds_token 
						FROM tb_usuario u 
						INNER JOIN tb_evento_convidado ec ON ec.cd_usuario = u.cd_usuario
						WHERE ec.cd_evento =  " . $cd_evento .
						" AND ec.fg_notificacao_pendente = 1 "; 

			$ids = array();
			$result = $connect->pesquisar($query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$ids[] = $row["ds_token"];
				}
			}
			
			$query = "SELECT ds_titulo_evento FROM tb_evento WHERE cd_evento =". $cd_evento;
			$ds_titulo_evento = '';
			$result = $connect->pesquisar($query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$ds_titulo_evento = $row["ds_titulo_evento"];
				}
			}
			
			if  (count($ids) > 0){				
				$title = "Você recebeu um novo convite";
				$message = $ds_nome. " enviou um convite para você participar do evento '". $ds_titulo_evento."'" ;
				$objMensagem->enviarNotificacao($title, $message, $ids, 'convite', $cd_evento);
			}
			
			$query = "UPDATE tb_evento_convidado SET fg_notificacao_pendente = 0 WHERE fg_notificacao_pendente = 1 ";
			$return = $connect->atualizar($query);
			$connect->desconectar();
			return $return;
		}
		
		function participar($cd_evento, $cd_usuario, $ds_nome)
		{
			$connect = new conexaoBD();
			$objMensagem = new PushMessage();
			$connect->conectar();
			
			$query = "SELECT cd_usuario_inclusao FROM tb_evento_convidado WHERE cd_evento =  " . $cd_evento .
						" AND cd_usuario = ". $cd_usuario ; 

			$cd_usuario_inclusao;
			$result = $connect->pesquisar($query);
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$cd_usuario_inclusao = $row["cd_usuario_inclusao"];
				}
			}			
			
			$query ="SELECT cd_evento FROM tb_evento_convidado 
					WHERE cd_evento = $cd_evento AND cd_usuario = $cd_usuario";	
					
			$result = $connect->pesquisar($query);			
			if (mysqli_num_rows($result) > 0) {

				$query = "UPDATE tb_evento_convidado SET fg_participa = 1 
						WHERE cd_evento = $cd_evento  
						AND cd_usuario= $cd_usuario";
				$return = $connect->atualizar($query);					
			}
			else{
							
				$query = "INSERT INTO tb_evento_convidado (cd_evento, cd_usuario, fg_participa)
						  VALUES ($cd_evento,$cd_usuario,1)";
				$return = $connect->inserir($query);
					
				$query= "SELECT COUNT(1) AS CONT FROM tb_evento_convidado
						WHERE cd_evento = $cd_evento 
						AND cd_usuario = $cd_usuario
						AND fg_participa = 1";
						
				$result = $connect->pesquisar($query);
				if (mysqli_num_rows($result) > 0)				
					$return=1;							
			}			
			
			if ($cd_usuario_inclusao != null )
			{
				$title = "Confirmação de convite";
				$message = "$ds_nome Aceitou seu convite!";
				
				$query = "SELECT ds_token FROM tb_usuario WHERE cd_usuario = $cd_usuario_inclusao"; 

				$ids = array();
				$result = $connect->pesquisar($query);
				if (mysqli_num_rows($result) > 0) {
					while ($row = $result->fetch_assoc())
					{
						$ids[] = $row["ds_token"];
					}
				}
			
				$objMensagem->enviarNotificacao($title, $message, $ids, "confirmacaoConvite", $cd_evento);
			} 
			
			$connect->desconectar();
			return $return;
			
		}
		
		function selecionarTodosEventos($cd_usuario)
		{
			$connect = new conexaoBD();			
			$connect->conectar();
			
			$query = "SELECT DISTINCT 
							e.cd_evento,
							e.ds_titulo_evento,
							e.ds_descricao,
							e.cd_usuario_inclusao,
							e.dt_evento,
							e.fg_evento_privado,
							e.ds_endereco, 
							e.nr_latitude,
							e.nr_longitude,
							IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_comentario WHERE cd_evento = e.cd_evento), 0) AS nr_comentarios,
							IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_convidado WHERE cd_evento = e.cd_evento), 0) AS nr_convidados						
						FROM tb_evento e
						INNER JOIN tb_evento_convidado ec on ec.cd_evento = e.cd_evento	
						WHERE e.fg_cancelado = 0 
						AND ec.fg_participa = 1
						AND ec.cd_usuario = $cd_usuario
						AND ec.cd_usuario_inclusao != $cd_usuario
						AND DATE(e.dt_evento) >= DATE(NOW())";			
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
		}
		
		function selecionarEventosPorData($dt_evento, $cd_usuario)
		{
			$connect = new conexaoBD();			
			$connect->conectar();
			
			$query = "SELECT DISTINCT 
							e.cd_evento,
							 e.ds_titulo_evento,
							 e.ds_descricao,
							 e.nr_latitude,
							 e.nr_longitude,
							 e.cd_usuario_inclusao,
							 DATE_FORMAT(e.dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
							 DATE_FORMAT(e.dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
							 DATE_FORMAT(e.dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
							 e.fg_evento_privado,
							 e.ds_endereco,
							 e.ind_classificacao,
							 e.fg_cancelado,
							 ec.fg_participa
						FROM tb_evento e
						INNER JOIN tb_evento_convidado ec on ec.cd_evento = e.cd_evento	
						WHERE e.fg_cancelado = 0 
						AND ec.fg_participa = 1
						AND ec.cd_usuario = $cd_usuario
						AND DATE(e.dt_evento) =  '$dt_evento'";			
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
			
		}
		
		function selecionarMeusEventos($cd_usuario, $dt_evento)
		{
			$connect = new conexaoBD();			
			$connect->conectar();
			$query = "SELECT DISTINCT 
							cd_evento,
							ds_titulo_evento,
							ds_descricao,
							nr_latitude,
							nr_longitude,
							cd_usuario_inclusao,
							DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
							DATE_FORMAT(dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
							DATE_FORMAT(dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
							fg_evento_privado,
							ds_endereco,
							ind_classificacao,
							fg_cancelado,
							IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_comentario WHERE cd_evento = tb_evento.cd_evento), 0) AS nr_comentarios,
							IFNULL((SELECT COUNT(cd_evento) FROM tb_evento_convidado WHERE cd_evento = tb_evento.cd_evento), 0) AS nr_convidados
						FROM tb_evento 
						WHERE cd_usuario_inclusao = $cd_usuario AND DATE(dt_evento) >= '$dt_evento' ";
						
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
		}
		
		function carregarComentario($cd_comentario){
			$connect = new conexaoBD();			
			$connect->conectar();
			$query = "SELECT ds_comentario, ds_nome, c.dt_inclusao FROM tb_evento_comentario c
						INNER JOIN tb_usuario u ON c.cd_usuario = u.cd_usuario
						WHERE cd_comentario = $cd_comentario";
						
			$result = $connect->pesquisar($query);
			
			$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["ds_comentario"] = $row["ds_comentario"];
					$row_array["ds_nome"] = $row["ds_nome"];
					$row_array["dt_inclusao"] = $row["dt_inclusao"];
					array_push($return,$row_array);
				}	
			}
			
			return json_encode($return);
			
		}
		
		function buscarAlterecoes($cd_usuario){
			$connect = new conexaoBD();			
			$connect->conectar();
			$query = "SELECT DISTINCT 
							e.cd_evento,
							ds_titulo_evento,
							ds_descricao,
							nr_latitude,
							nr_longitude,
							e.cd_usuario_inclusao,
							DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
							DATE_FORMAT(e.dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
							DATE_FORMAT(e.dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
							fg_evento_privado,
							ds_endereco,
							ind_classificacao,
							fg_cancelado,
							IFNULL((SELECT COUNT(cd_evento) 
										FROM tb_evento_comentario WHERE cd_evento = e.cd_evento), 0) AS nr_comentarios,
							IFNULL((SELECT COUNT(cd_evento) 
										FROM tb_evento_convidado WHERE cd_evento = e.cd_evento), 0) AS nr_convidados
						FROM tb_evento e
						INNER JOIN tb_evento_convidado ec ON ec.cd_evento = e.cd_evento AND ec.cd_usuario = $cd_usuario 
						WHERE 
							DATE(dt_evento) >= DATE(NOW())
							AND e.dt_alteracao IS NOT NULL";
						
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
		}
		
		function buscarNovosComentario($cd_usuario){
			$connect = new conexaoBD();			
			$connect->conectar();
			$query = "SELECT DISTINCT 
							e.cd_evento,
							ds_titulo_evento,
							ds_descricao,
							nr_latitude,
							nr_longitude,
							e.cd_usuario_inclusao,
							DATE_FORMAT(dt_evento, '%d/%m/%Y %H:%s') AS dt_evento,
							DATE_FORMAT(e.dt_inclusao, '%d/%m/%Y %H:%s') AS dt_inclusao ,
							DATE_FORMAT(e.dt_alteracao, '%d/%m/%Y %H:%s') AS dt_alteracao ,
							fg_evento_privado,
							ds_endereco,
							ind_classificacao,
							fg_cancelado,
							IFNULL((SELECT COUNT(cd_evento) 
										FROM tb_evento_comentario WHERE cd_evento = e.cd_evento), 0) AS nr_comentarios,
							IFNULL((SELECT COUNT(cd_evento) 
										FROM tb_evento_convidado WHERE cd_evento = e.cd_evento), 0) AS nr_convidados
						FROM tb_evento e
						INNER JOIN tb_evento_convidado ec ON ec.cd_evento = e.cd_evento AND ec.cd_usuario = $cd_usuario 
						WHERE 
							DATE(dt_evento) >= DATE(NOW())
							HAVING  nr_comentarios > 0";
						
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayEvento($result);
			$connect->desconectar();
			return $return;
		}
	}

?>