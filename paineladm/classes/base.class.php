<?php
require_once ("banco.classe.php");

abstract class base extends banco {
	
	//propriedades
	public $tabela = "";
	public $campos_valores = array();
	public $campopk = NULL
	public $valorpk = NULL
	public $extra_select = "";

	//metodos

	public function addCampo ($campo=NULL, $valor=NULL) {
		if ($campo != NULL):
			$this->campo_valores[$campo] = $valor;
		endif;
	} //add Campo

	public function delCampo ($campo=NULL) {
		if (array_key_exists($campo, $this->campo_valores)):
			unset ($this->campo_valores[$campo]);
		endif;
	} //dell Campo
	
	public function setValor ($campo=NULL, $valor=NULL) {
		if ($campo != NULL && $valor != NULL):
			$this->campos_valores[$campo] = $valor;
		endif;
	} //set Valor

	public function getValor ($campo=NULL) {
		if ($campo != NULL && array_key_exists($campo, this->campos_valores)):
			return $this->campos_valores[$campo];
		else:
			return FALSE;
		endif;
	} //get Valor

} // fim da classe base

?>