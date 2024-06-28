<?php
include_once(__DIR__."/connection.php");

class Usuario extends Connection{
	private $idUsuario;
	private $email;
	private $password;
	private $code;
	private $lastLogin;
	private $nombre;
	private $errCode;
    private $errMsg;

	public function __construct($id=null){
		parent::__construct();
		if ($id!=null){
			$this->load($id);
		}
	}
	
	public function setIdUsuatio($id) {
		$this->idUsuario=$id;
	}
	
	public function setEmail($email) {
		$this->email=$email;
	}
	
	public function setPassword($pass) {
		$this->password=hash("sha512", $pass);
	}
	
	public function setCode($code) {
		$this->code=$code;
	}
	public function setNombre($n) {
		$this->nombre=$n;
	}
	
	public function getIdUsuatio() {
		return $this->idUsuario;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getCode() {
		return $this->code;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function getLastLogin() {
		return $this->lastLogin;
	}
	public function getErrCode() {
        return $this->errCode;
    }

    public function getErrMsg() {
        return $this->errMsg;
    }
	
	public function load($id){
		$this->clearErr();
		if ($id) {
			try{
				$stm=$this->getPdo()->prepare("Select * from usuarios where idUsuario=?");
				$stm->bindParam(1, $id);
				$stm->execute();
				
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					$this->idUsuario=	$result['idUsuario'];
					$this->email=		$result['email'];
					$this->password=	$result['password'];
					$this->code=		$result['code'];
					$this->lastLogin=	$this->getDateTimeToSpain($result['lastLogin']);
					$this->nombre=		$result['nombre'];
					return true;
				}
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
				return false;
			}
			
		}
		return false;
	}
	
	public function delete(){
		
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("delete from usuarios where idUsuario=?");
				$stm->bindParam(1, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}
	
	public function insert(){
		$this->clearErr();
		try{
			$stm=$this->getPdo()->prepare("insert into usuarios (email, password, nombre, code, lastLogin) values (?,?,?,?,NOW())");
			$stm->bindParam(1, $this->email);
			$stm->bindParam(2, $this->password);
			$stm->bindParam(3, $this->nombre);
			$stm->bindParam(4, $this->code);
			$stm->execute();
			$this->idUsuario=$this->getPdo()->lastInsertId();
			if ($this->idUsuario) return true;
		} catch (PDOException $e){
			$this->errCode=$e->getCode();
			$this->errMsg=$e->getMessage();
		}
		return false;
	}
	
	public function update(){
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("update usuarios set email=?, password=?, code=?, nombre=? where idUsuario=?");
				$stm->bindParam(1, $this->email);
				$stm->bindParam(2, $this->password);
				$stm->bindParam(3, $this->code);
				$stm->bindParam(4, $this->nombre);
				$stm->bindParam(5, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}
	
	public function setLastLogin(){
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("update usuarios set lastLogin=NOW() where idUsuario=?");
				$stm->bindParam(1, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}
	
	public function login(){
		$this->clearErr();
		try{
			$stm=$this->getPdo()->prepare("Select * from usuarios where email=? and password=? and (code is null or code = '') ");
			$stm->bindParam(1, $this->email, PDO::PARAM_STR);
			$stm->bindParam(2, $this->password, PDO::PARAM_STR);
			$stm->execute();
			
			$result = $stm->fetch(PDO::FETCH_ASSOC);
			if ($result) {
				$this->idUsuario=$result['idUsuario'];
				$this->setLastLogin();
				$this->load($this->idUsuario);
				return true;
			}
			
		} catch (PDOException $e){
			$this->errCode=$e->getCode();
			$this->errMsg=$e->getMessage();
		}
		return false;
	}
	
	public function loadByEmail(){
		$this->clearErr();
		if ($this->email) {
			try{
				$stm=$this->getPdo()->prepare("Select * from usuarios where email=?");
				$stm->bindParam(1, $this->email);
				$stm->execute();
				
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					$this->idUsuario=	$result['idUsuario'];
					$this->email=		$result['email'];
					$this->password=	$result['password'];
					$this->code=		$result['code'];
					$this->lastLogin=	$this->getDateTimeToSpain($result['lastLogin']);
					$this->nombre=		$result['nombre'];
					return true;
				}
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
				return false;
			}
			
		}
		return false;
	}
	
	
}
?>