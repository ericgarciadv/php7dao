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

	public function __construct($login = "",$password = ""){
		$this->desUsuario = $login;
		$this->desSenha = $password;
	}

	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){
			$this->setData($results[0]);
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
			$this->setData($results[0]);
		
		} else{
			throw new Exception("Login e/ou senha inválidos");
			
		}
	}

	public function setData($data){
		$this->setIdUsuario($data['idusuario']);
		$this->setDesUsuario($data['desusuario']);
		$this->setDesSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();

		$results  = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			':LOGIN'=>$this->getDesUsuario(),
			':PASSWORD'=>$this->getDesSenha()
		));

		if(count($results) > 0){
			$this->setData($results[0]);
		}
	}

	public function update($login,$senha){
		$this->setDesUsuario($login);
		$this->setDesSenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET desusuario = :LOGIN, dessenha = :SENHA WHERE idusuario  = :ID" ,array(
			':LOGIN'=>$this->getDesUsuario(),
			':SENHA'=>$this->getDesSenha(),
			':ID'=>$this->getIdUsuario()
		));
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setDesUsuario("");
		$this->setDesSenha("");
		$this->setDtCadastro(new DateTime());
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