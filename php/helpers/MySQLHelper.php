<?php

class conexaoBD {
	
	private $host = "mysql.hostinger.com.br";
	private $bd = "u670967363_fiest";
	private $user = "u670967363_sa";
	private $pass = "13204658";
	private $connect;
	 
   function conectar(){
	   try{
      		$this->connect = mysqli_connect($this->host,$this->user,$this->pass, $this->bd) or die($this->mensagem(mysqli_error()));
			
	   }catch (Exception $ex){
		   die("Erro ao conectar banco de dados");
	   }
   }
   
   function desconectar(){
	   mysqli_close($this->connect);
   }
   
   function pesquisar($query){
	   return $result = mysqli_query($this->connect,$query);
   }
   
   function inserir($query){
	   mysqli_query($this->connect,$query);
	   return mysqli_insert_id($this->connect);
   }
   
   function atualizar($query){
	   mysqli_query($this->connect,$query);
	   return mysqli_affected_rows($this->connect);
   }
   	
}

?>