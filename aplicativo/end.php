<?php
	
		session_unset();
		session_destroy();
		session_unset(['usuarioLogado']);
		session_unset(['senhaLogado']);
		session_unset(['idLogado']);
		session_unset(['nomeLogado']);
		session_unset(['arroba']);
		header("Location: login.php");

?>