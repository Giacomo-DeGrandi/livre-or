<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>livre d'Or</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
	<header>
			<a href="index.php" target="_top">go back to the home page </a>  &#160;&#160;&#160;&#160;
			<a href="connexion.php" target="_top">log in</a> &#160;&#160;&#160;&#160;
		<form action='' method="post">
			<input type="submit" name="disconnect" value="&#160;disconnect from your account" class="buttons1">
		</form>
	</header>
<?php

if (isset($_POST['disconnect'])){
	session_destroy();
	header("Location: connexion.php");
}

?>
	<br><br><br><br>
	<h1>What the say about us</h1>
		<div class="goldentable">
			<table>
			</table>
		</div> 
<?php 

if(isset($_SESSION['connected'])){

	echo '<form action="" method="post">
			<input type="submit" name="tocomments" value="leave a comment" class="buttons1">
		</form>';

} else { echo '<span class="ads"> please connect to leave a comment </span>'; }

if(isset($_POST['tocomments'])){
	$_SESSION['user']=$_SESSION['connected'];
	header("Location: commentaire.php");
}

?>
</body>
</html>