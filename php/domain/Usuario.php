<?php

	require_once("php/helpers/MySQLHelper.php");


class Usuario {
	
	private $cd_usuario;
    private $ds_nome;
    private $ds_telefone;
    private $img_perfil;
    private $ds_caminho_foto;
    private $nr_ddi;
    private $nr_codigo_valida_telefone;
    private $ds_token;
    private $ds_foto_perfil;
	
	//PROPRIEDADES
	
	public function getNome() {
        return $this->ds_nome;
    }

    public function setNome($ds_nome) {
        $this->ds_nome = $ds_nome;
    }

    public function getTelefone() {
        return $this->ds_telefone;
    }

    public function setTelefone($ds_telefone) {
        $this->ds_telefone = $ds_telefone;
    }

    public function getCodigoUsuario() {
        return $this->cd_usuario;
    }

    public function setCodigoUsuario($cd_usuario) {
        $this->cd_usuario = $cd_usuario;
    }

    public function getImagemPerfil() {
        return $img_perfil;
    }

    public function setImagemPerfil($img_perfil) {
        $this->img_perfil = $img_perfil;
    }

    public function getCaminhoFoto() {
        return $this->ds_caminho_foto;
    }

    public function setCaminhoFoto($ds_caminho_foto) {
        $this->ds_caminho_foto = $ds_caminho_foto;
    }

    public function getDDI() {
        return $this->nr_ddi;
    }

    public function setDDI($nr_ddi) {
        $this->nr_ddi = $nr_ddi;
    }

    public function getCodigoVerificardor() {
        return $this->nr_codigo_valida_telefone;
    }

    public function setCodigoVerificardor($nr_codigo_valida_telefone) {
        $this->nr_codigo_valida_telefone = $nr_codigo_valida_telefone;
    }

    public function getToken() {
        return $this->ds_token;
    }

    public function setToken($ds_token) {
        $this->ds_token = $ds_token;
    }

    public function getFotoPerfil() {
        return $this->ds_foto_perfil;
    }

    public function setFotoPerfil($ds_foto_perfil) {
        $this->ds_foto_perfil = $ds_foto_perfil;
    }
	
	// MÉTODOS
	
	function __construct2() {
		
	}
	
	function __construct1($cd_usuario, $ds_token) {
		$this->cd_usuario = $cd_usuario;
		$this->ds_token = $ds_token;
	}
	
	
	function retornarArrayUsuario($result)
		{
			$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["cd_usuario"] = $row["cd_usuario"];
					$row_array["ds_nome"] = $row["ds_nome"];
					$row_array["ds_telefone"] = $row["ds_telefone"];
					$row_array["ds_token"] = $row["ds_token"];

					
					array_push($return,$row_array);
				}	
			}
			
			return json_encode($return);
		}
	
	public function inserirUsuario(Usuario $objUsuario){
		$connect = new conexaoBD();
		$connect->conectar();
		
		$foto = base64_decode($objUsuario->ds_foto_perfil);
		$query = "UPDATE tb_usuario SET fg_ativo = 0 WHERE ds_telefone = '" . $objUsuario->ds_telefone. "' ";
		$connect->atualizar($query);
			 
		$query = "insert into tb_usuario (ds_telefone,ds_nome, nr_ddi, fg_ativo) values ('". $objUsuario->ds_telefone ."','" . $objUsuario->ds_nome . "' , '". $objUsuario->nr_ddi ."' , '1')";
		$codigo_usuario = $connect->inserir($query);
		
		$file = fopen('foto_perfil/'. $codigo_usuario . '.png' ,'wb');
		fwrite($file, $foto);
		fclose($file);
				
		$connect->desconectar();
		return $codigo_usuario;
		
		
	}
	
	
	public function selecionarTokenUsuarios($usuarios){
		$connect = new conexaoBD();
		$connect->conectar();
		$query = "SELECT cd_usuario, ds_token FROM tb_usuario";
//		 WHERE cd_usuario IN (" .$usuarios. ")"  ; 
		$result = $connect->pesquisar($query);
		
		$return = array();
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result->fetch_assoc())
				{
					$row_array["ds_token"] = $row["ds_token"];
					array_push($return,$row_array);
				}	
			}
		
		$connect->desconectar();
		return $return;
		
	}
	
	public function atualizarToken(){
		$connect = new conexaoBD();
		$connect->conectar();
		$query = "UPDATE tb_usuario SET ds_token = '". $this->ds_token .  "' WHERE cd_usuario = " . $this->cd_usuario;
		$return =  $connect->atualizar($query);
		$connect->desconectar();
		return $return ;
	}
	
	public function atualizarNome($ds_nome){
		$connect = new conexaoBD();
		$connect->conectar();
		$query = "UPDATE tb_usuario SET ds_nome = '". $ds_nome .  "' WHERE cd_usuario = " . $this->cd_usuario;
		$return =  $connect->atualizar($query);
		$connect->desconectar();
		return $return ;
		
	}
	
	
}
?>