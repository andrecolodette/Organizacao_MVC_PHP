<?php

abstract class banco {

	public $servidor = "localhost"; //host
	public $usuario = "root"; //user
	public $senha = ""; // password
	public $nomebanco = ""; //database
	public $conexao = NULL;

	public $dataset = NULL;
	public $linhasafetadas = -1;

	//metodos
	
	public function __construct () {
		$this->conecta();
	} //construct

	public function __destruct () {
		if ($this->conexao != NULL):
			mysql_close ($this->conexao);
		endif;
	} //destruct

	public function conecta() {
		$this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, TRUE) or die ($this->trataerro(__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));
		mysql_select_db ($this->nomebanco) or die ($this->trataerro(__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));
		mysql_query ("SET NAMES 'utf8'");
		mysql_query ("SET character_set_connection = 'utf8'");
		mysql_query ("SET character_set_client = 'utf8'");
		mysql_query ("SET character_set_results = 'utf8'");
	} //conecta

	public function inserir ($objeto) {
		//insert into nome_tabela (campo1, campo2) values (valor1, valor2)
		$sql = "INSERT INTO ".$objeto->tabela." (";
		for ($i=0; $i < count($objeto->campos_valores); $i++):
			$sql .= key($objeto->campos_valores);
			if ($i < (count($objeto->campos_valores) - 1)):
				$sql .= ", ";
			else:
				$sql .= ") ";
			endif;
			next($objeto->campos_valores);
		endfor;
		resert($objeto->campos_valores);
		$sql .= "VALUES (";
		for ($i=0; $i < count($objeto->campos_valores); $i++):
			$sql .= is_numerico ($objeto->campos_valores[key($objeto->campos_valores)]) ? 
				$objeto->campos_valores[key($objeto->campos_valores)] :
				"'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
			if ($i < (count($objeto->campos_valores) - 1)):
				$sql .= ", ";
			else:
				$sql .= ") ";
			endif;
			next($objeto->campos_valores);
		endfor;
		return $this->executaSQL($sql);
	} //inserir

	public function atualizar ($objeto) {
		//update nome_tabela set campo1 = valor=1, campo2 = valor2 where id = id
		$sql = "UPDATE ".$objeto->tabela." SET ";
		for ($i=0; $i < count($objeto->campos_valores); $i++):
			$sql .= key($objeto->campos_valores)." = ";
			$sql .= is_numerico ($objeto->campos_valores[key($objeto->campos_valores)]) ? 
				$objeto->campos_valores[key($objeto->campos_valores)] :
				"'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
			if ($i < (count($objeto->campos_valores) - 1)):
				$sql .= ", ";
			else:
				$sql .= " ";
			endif;
			next($objeto->campos_valores);
		endfor;
		$sql .= "WHERE ".$objeto->campopk." = ";
		$sql .= is_numeric ($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
		return $this->executaSQL($sql);
	} //atualizar

	public function deletar($objeto) {
		//delete from tabela where id=id
		$sql = "DELETE FROM ".$objeto->tabela;
		$sql .= " WHERE ".$objeto->campopk." = ";
		$sql .= is_numeric ($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
		return $this->executaSQL($sql);
	} //deletar

	public function selecionaTudo ($objto-NULL) {
		$sql = "SELECT * FROM ".$objeto->tabela;
		if ($objeto->extra_select != NULL):
			$sql .= " ".$objeto->extra_select;
		endif;
		return $this->executaSQL($sql);
	} //seleciona tudo

	public function selecionaCampos ($objto-NULL) {
		$sql = "SELECT ";
		for ($i=0; $i < count($objeto->campos_valores); $i++):
			$sql .= key($objeto->campos_valores);
			if ($i < (count($objeto->campos_valores) - 1)):
				$sql .= ", ";
			else:
				$sql .= " ";
			endif;
			next($objeto->campos_valores);
		endfor;
		$sql .= " FROM ".$objeto->tabela;
		if ($objeto->extra_select != NULL):
			$sql .= " ".$objeto->extra_select;
		endif;
		return $this->executaSQL($sql);
	} //seleciona campos

	public function executaSQL ($sql=NULL) {
		if ($sql != NULL):
			$query = mysqli_query($sql) or $this->trataerro(__FILE__, __FUNCTION__);
			$this->linhasafetada = mysqli_affected_rows($this->conexao);
			if (substr(trin(strtolower($sql)), 0, 6 == "select"):
				$this->dataset = $query:
				return $query;
			else:
				return $this->linhasafetadas;
			endif;
		else:
			$this->trataerro(__FILE__,__FUNCTION__,NULL,"Comando SQL não Informado!",FALSE);
		endif;
	} //execulta SQL

	public function retornaDados ($tipo=NULL) {
		switch (strtolower($tipo)):
			case "array":
				return mysqli_fetch_array($this->dataset);
				break;
			case "assoc":
				return mysqli_fetch_assoc($this->dataset):
				break;
			case "object":
				return mysqli_fetch_object($this->dataset)
				break;
			default:
				return mysqli_fetch_object($this->dataset)
				break;
		endswitch;
	} //retorna Dados

	public function trataerro ($arquivo=NULL, $rotina=NULL, $numerro=NULL, $msgerro=NULL, $geraexcept=NULL) {
		if ($arquivo == NULL) $arquivo = "nao informado";
		if ($rotina == NULL) $rotina = "nao informado";
		if ($numerro == NULL) $numerro = mysql_errno ($this->conexao)
		if ($msgerro == NULL) $msgerro = mysql_error($this->conexao)

		$resultado = 'Ocorreu um erro com os seguintes detalhes: <br />
			<strong>Arquivo:</strong> '.$arquivo.'<br />
			<strong>Rotina:</strong> '.$rotina.'<br />
			<strong>Codigo:</strong> '.$codigo.'<br />
			<strong>Mensagem:</strong> '.$msgerro;
		
		if ($geraexcept == FALSE):
			echo($resultado);
		else:
			die($resultado);
		endif;
	} //trata erro

} //fim da classe banco

?>