<?php

inicializa();
function inicializa(){
	if (feli_exists(dirname(__FILE__).'/config.php')):
		require_once(dirname(__FILE__).'/config.php);
	else:
		die(utf8_decode('O arquivo de configuração não foi localizado, contate o administrador.'));
	endif;
	if(!define("BASEPATH") || !define("BASEURL")):
		die(utf8_decode('Faltam configurações básicas do sistema, contate o adinstrador.'));
	endif;
	require_once(BASEPATH.CLASSEPATH.'autoload.php');
} //incializa

function loadCSS ($arquivo=NULL, $media='screen', $import=FALSE) {
	if ($arquivo != NULL):
		if ($import == TRUE):
			echo '<style type="text/css">@import url("'.BASEURL.CSSPATH.$arquivo.'.css");</style>'."\n";
		else:
			echo '<link rel="styleheet" type="text/css" href="'.BASEURL.CSSPATH.$arquivo.'.css" media="'.$media.'" />'."\n";
		endif;
	endif;
} //load CSS

function loadJS ($arquivo=NULL, $remoto=FALSE) {
	if ($arquivo != NULL):
		if($remoto == FALSE) $arquivo=BASEURL.JSPATH.$arquivo'.js';
			echo '<script type="text/javascript" src='.$arquivo.'></script>'."\n";
	endif;
} //load JS

function loadmodulo($modulo=NULL, $tela=NULL) {
	if ($modulo == NULL || $tela == NULL):
		echo '<p>Erro na função <strong>'.__FUNCTION__.'</strong>: faltam paâmetros para execução.</p>';
	else:
		if (file_exists(MODULOPATH."$modulo.php")):
			include_once(MODULOPATH."$modulo.php");
		else:
			echo '<p>Módulo inexistente neste sistema!</p>';
		endif;
	endif;
} //load modulo

function protegeArquivo ($nomeArquivo, $redirPara='index.php?erro=3') {
	$url = $_SERVE["PHP_SELF"];
	if (preg_match("/$nomeArquivo/i", $url)):
		//redireciona para outra url
		//echo 'arquivo deve ser protegido';
		redireciona($redirPara);
	endif;
} //protege Arquivo

function redireciona ($url='') {
	header("Location: ".BASEURL.$url);
} //redireciona

?>