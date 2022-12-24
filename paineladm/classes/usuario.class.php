<?php


require_once ("base.classe.php");

class clientes extends base {
	
	public function __constructor ($campos=array()) {
		parent:: __constructor();
		$this->tabela = "clientes";
		if (sizeof($campos) <= 0):
			$this->campos_valores = array(
				"nome" => NULL, 
				"sobrenome => NULL
			);
		else:
			$this->campos_valores = $campos;
		endif;
		$this->campopk = "id";
	} //construtor
	
} //fim da classe cliente

?>