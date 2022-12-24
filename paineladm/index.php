<?php require_once("funcoes.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtm11/DTD/xhtmll-strict.dtd">

<html xnlns="http://www.w3.org/1999/xhtml" xml:lang="pt_BR" lang="pt_BR">
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
		<meta name="description" content="" />
		<mata name="keywords" content="" />
		
		<title>Painel Administrativo</title>
		
		<link rel="shortcut icon" href="images/favicon.ico" />
		
		<?php
		loadCSS('reset');
		loadCSS('style');

		//loadJS('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', TRUE);
		loadJS('jquary');
		loadJS('geral');
		?>
	</head>

	<body>
		<?php loadmodulo('usuarios', login'). ?>
	</body>
	
	
</html>