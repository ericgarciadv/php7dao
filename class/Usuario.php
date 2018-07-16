<?php  

class Usuario{

	private $idUsuario;
	private $desUsuario;
	private $desSenha;
	private $dtCadastro;

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getDesUsuario(){
		return $this->desUsuario;
	}

	public function setDesUsuario($desUsuario){
		$this->desUsuario = $desUsuario;
	}

	public function getDesSenha(){
		return $this->desSenha;
	}

	public function setDesSenha($desSenha){
		$this->desSenha = $desSenha;
	}

	public function getDtCadastro(){
		return $this->dtCadastro;
	}

	public function setDtCadastro($dtCadastro){
		$this->dtCadastro = $dtCadastro;
	}

	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesUsuario($row['desusuario']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY desusuario");
	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE desusuario LIKE :SEARCH ORDER BY desusuario",array(":SEARCH"=>"%".$login."%"));

	}

	public function login($login,$password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE desusuario = :LOGIN AND dessenha = :PASS ORDER BY desusuario",array(":LOGIN"=>$login,":PASS"=>$password));

		if(count($results) > 0){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesUsuario($row['desusuario']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		} else{
			throw new Exception("Login e/ou senha inválidos");
			
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"desusuario"=>$this->getDesUsuario(),
			"dessenha"=>$this->getDesSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}
?>