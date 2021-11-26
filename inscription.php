<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscribe</title>
</head>
<body>
	<header>
	</header>
<main>
	<h1>SIGN UP</h1>
	<form action='' method='post'>	
		<input type="text" name="login" placeholder="login" ><br>
		<input type="text" name="prenom" placeholder="prenom"><br>
		<input type="text" name="nom" placeholder="nom" ><br>
		<input type="password" name="password" placeholder="password"><br>
		<input type="password" name="passwordconf" placeholder="confirm_password" ><br><br>
		<input type="submit" name="submit" value="send" class="buttons1">
	</form>
	<br>
	<a href="../index.php" target="_top">go back to the home page </a>
	<br><br>
	<a href="connexion.php" target="_top">Already Signed Up? Log in </a>

	<footer>
			<p>giditree<p>
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
	</footer>
</main>

<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'livreor';

		$conn = mysqli_connect($servername, $username, $password, $database);	// establish my connexion

?>

</body>
</html>
