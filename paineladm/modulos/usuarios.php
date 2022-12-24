<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));

switch ($tela):
	case 'login':
		//echo 'tela login';
		?>
		<div id="loginform">
			<form class="userform" method="post" action="">
				<fieldset>
					<legend>Acesso restrito, identifique-se</legend>
					<ul>
						<li>
							<label for="usuario">Usuário:</label>
							<input type="text" size="35" name="usuario" value="<?php echo $_POST['usuario']; ?>" />
						</li>
						<li>
							<label for="senha">Senha:</label>
							<input type="password" size="35" name="senha" value="<?php echo $_POST['senha']; ?>" />
						</li>
						<li class="center">
							<input type="submit" name="logar" value="Login" />
						</li>
					</ul>
					
					<?php
					$erro = $_GET['erro'];
					switch ($erro):
						case 1:
							echo '<div class="sucesso">Você fez logoff do sistema.</div>;
							break;
						case 2:
							echo '<div class="erro">Dados incorretos ou usuário inativo.</div>;
							break;
						case 3:
							echo '<div class="erro">Faça login antes de acessar a página solicitada.</div>;
							break;
						default:
							echo '<div class="erro">Erro!.</div>;
							break;
					endswitch;
					?>
					
				</fieldset>
			</form>
		</div>
		<?php
		break;
	default:
		//echo 'tela default';
		echo '<p>A tela solicitada não existe.</p>'
		break;
endswitch;
>