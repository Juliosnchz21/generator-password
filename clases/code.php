<?php
include_once(__DIR__."/connection.php");

class Code extends Connection{
	private $idCode;
	private $idUsuario;
	private $code;
	private $fecha;
	private $descripcion;
	
	public function __construct($id=null){
		parent::__construct();
		if ($id!=null){
			$this->load($id);
		}
	}
	
	public function setIdCode($id) {
		$this->idCode=$id;
	}
	
	public function setIdUsuario($id) {
		$this->idUsuario=$id;
	}
	
	public function setCode($code) {
		$this->code=$this->cifrar($code);
	}
	
	public function setDescripcion($des) {
		$this->descripcion=$des;
	}
	
	public function getIdCode() {
		return $this->idCode;
	}
	
	public function getIdUsuatio() {
		return $this->idUsuario;
	}
	
	public function getCode() {
		return $this->descifrar($this->code);
	}
	
	public function getFecha() {
		return $this->fecha;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function generarRandomCode($lon, $may, $min, $num, $esp){
		if (!$_SESSION['isAuth']) {
			$lon=10;
			$may=true;
			$min=true;
			$num=true;
			$esp=true;
		}
		$numeros   =str_shuffle("1234567890");
		$mayusculas=str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM");
		$minusculas=str_shuffle("qwertyuiopasdfghjklzxcvbnm");
		$especiales=str_shuffle("!@#$%()=-_?[]<>*+/{}");
		
		$x=0;
		if ($may) $x++;
		if ($min) $x++;
		if ($num) $x++;
		if ($esp) $x++;
		
		$t=ceil($lon/$x);
		$total="";
		
		$x2=0;
		for ($y=0; $y<$t; $y++) {
			if ($may && $x2++<$lon) $total.=substr($mayusculas,rand(0,strlen($mayusculas)-1),1);
			if ($min && $x2++<$lon) $total.=substr($minusculas,rand(0,strlen($minusculas)-1),1);
			if ($num && $x2++<$lon) $total.=substr($numeros,rand(0,strlen($numeros)-1),1);
			if ($esp && $x2++<$lon) $total.=substr($especiales,rand(0,strlen($especiales)-1),1);
		}
		
		return $total;
	}
	
	private function cifrar($texto){
		$key=$_SESSION['pass'];

		$ivlong=openssl_cipher_iv_length(CIFRADO); //longitud del vector de inicialización
		$iv=openssl_random_pseudo_bytes($ivlong);

		$bruto=openssl_encrypt($texto, CIFRADO, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac=hash_hmac('sha256', $bruto, $key, true);

		$textoCifrado=base64_encode($iv.$hmac.$bruto);
		return $textoCifrado;
	}
	
	private function descifrar($texto){
		$key=$_SESSION['pass'];
		
		$ivlong=openssl_cipher_iv_length(CIFRADO);
		$decode=base64_decode($texto);
		$iv = substr($decode, 0, $ivlong);
		$hmac = substr($decode, $ivlong, SHA2_LONG);

		$brutoDes= substr($decode, $ivlong+SHA2_LONG);
		$textoDescifrado=openssl_decrypt($brutoDes, CIFRADO, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac2=hash_hmac('sha256', $brutoDes, $key, true);
		if (hash_equals ($hmac, $hmac2)){
			return $textoDescifrado;
		} else {
			return "Contaseña no recuperable.";
		}
	}
	
	public function load($id){
		$this->clearErr();
		if ($id) {
			try{
				$stm=$this->getPdo()->prepare("Select * from codes where idCode=? and idUsuario=?");
				$stm->bindParam(1, $id);
				$stm->bindParam(2, $_SESSION['idUsuario']);
				$stm->execute();
				
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					$this->idCode=		$result['idCode'];
					$this->idUsuario=	$result['idUsuario'];
					$this->code=		$result['code'];
					$this->fecha=		$this->getDateTimeToSpain($result['fecha']);
					$this->descripcion=	$result['descripcion'];
					return true;
				}
			} catch (PDOException $e){
				$this->setErrCode($e->getCode());   
				$this->setErrMsg($e->getMessage());
				return false;
			}
			
		}
		return false;
	}
	public function listCodes() {
		$this->clearErr();
		$respuesta=array();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("Select * from codes where idUsuario=?");
				$stm->bindParam(1, $this->idUsuario);
				$stm->execute();
				$x=0;
				
				while($result = $stm->fetch(PDO::FETCH_ASSOC)){
					$respuesta[$x]['idCode']=$result['idCode'];
					$respuesta[$x]['code']=$this->descifrar($result['code']);
					$respuesta[$x]['descripcion']=$result['descripcion'];
					$x++;
				}
				
			}catch (PDOException $e){
				$this->setErrCode($e->getCode());
				$this->setErrMsg($e->getMessage());
			}
		}
		return $respuesta;
		
	}
	
	public function delete(){
		
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("delete from codes where idCode=?");
				$stm->bindParam(1, $this->idCode);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->setErrCode($e->getCode());
				$this->setErrMsg($e->getMessage());
			}
		}
		return false;
	}
	
	public function insert(){
		$this->clearErr();
		try{
			$stm=$this->getPdo()->prepare("insert into codes (idUsuario, code, fecha, descripcion) values (?,?,NOW(),?)");
			$stm->bindParam(1, $this->idUsuario);
			$stm->bindParam(2, $this->code);
			$stm->bindParam(3, $this->descripcion);
			$stm->execute();
			$this->idCode=$this->getPdo()->lastInsertId();
			if ($this->idCode) return true;
		} catch (PDOException $e){
			$this->setErrCode($e->getCode());
			$this->setErrMsg($e->getMessage());
		}
		return false;
	}
}
?>