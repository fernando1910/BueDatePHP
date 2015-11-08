<?php

	require_once("php/helpers/MySQLHelper.php");
	
	class Contatos
	{
		private $cd_contato;
	    private $ds_contato;
		
		public function getCodigoContato(){
			return $this->cd_contato;
		}
		
		public function getNomeContato(){
			return $this->ds_contato;
		}
		
		public function setCodigoContato($cd_contato){
			$this->cd_contato = $cd_contato;
		}
		
		public function setNomeContato($ds_contato){
			$this->ds_contato = $ds_contato;
		}
		
		function retornarArrayContatos($result){
			$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["cd_contato"] = $row["cd_usuario"];
					$row_array["ds_contato"] = $row["ds_nome"];
					array_push($return,$row_array);
				}	
			}
			
			return json_encode($return);
		}
		
		function buscarConvidados($cd_evento){
			$connect = new conexaoBD();
			$connect->conectar();
			
			$query = "SELECT DISTINCT 
						u.cd_usuario, 
						u.ds_nome 
					FROM tb_usuario u 
					INNER JOIN tb_evento_convidado ec ON ec.cd_usuario = u.cd_usuario
					WHERE ec.cd_evento = $cd_evento";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayContatos($result);
			$connect->desconectar();
			return $return;
		}
		
		function atualizarContatos($contatos)
		{
			$connect = new conexaoBD();
			$connect->conectar();
			
			$count = count($contatos->numeros);
			$return = array();
			
			$aux;
			$i = 1;
			foreach($contatos->numeros as $numero)
			{
				$aux = $aux . "'" . $numero->nr_telefone . "'";
				if ($i < $count)
				{
					$aux = $aux . " OR ds_telefone RLIKE  ";
					$i ++;			
				}
		
			}
			
			$query = "SELECT DISTINCT * FROM tb_usuario WHERE  fg_ativo = 1 AND ( ds_telefone  RLIKE  ". $aux . " )  ";
			$result = $connect->pesquisar($query);
			$return = $this->retornarArrayContatos($result);
			$connect->desconectar();
			return $return;
		}
	}
	
?>