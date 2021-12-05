<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comments</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
	<header>
	</header>
	<div id="reviewformwrapper">
		<div id="reviewform">
<?php

if(isset($_SESSION['user'])){
	echo '<h2> hi '. $_SESSION['user'].'</h2>';
} else { header('Location: connexion.php');			// si l'utilisateur accede pour quelque obscur raison ici sans etre en session 
}													// je le renvoi à se connectre

?>
			<h4>write your review here</h4>
			<form action='' method='post' id="reviewform">
				<textarea id="comments" name="comments" rows="7" cols="100">
				</textarea>
				<input type="submit" name="send" value="submit" class="buttons1"><br><br>
			</form>
		<div id="undercommentslinks">
<?php

echo "<span id='datecomments'>today is the " . date("Y/m/d") . "</span><br>";

if(isset($_POST['comments'])){
	if(isset($_POST['send'])){


$servername = 'localhost:3306';
$username = 'giditree';
$password = 'admin.io';
$database = 'carlo-de-grandi-giacomo_livreor'; 


		$conn = mysqli_connect($servername, $username, $password, $database);

		$comment = mysqli_real_escape_string($conn,$_POST['comments']);
		$iduser = $_SESSION['id'];
		$date = date("Y-m-d H:i:s");

		$quest= "INSERT INTO commentaires (commentaire, id_utilisateur, date ) VALUES ('$comment','$iduser','$date')";

		$req = mysqli_query($conn,$quest);

		echo '<span id="datecomments">&#160;&#160; review sent ☑️&#160;&#160;</span>';

	}
}

?>
		<a href="livre-or.php" target="_top">go back to reviews </a>  &#160;&#160;
		<a href="index.php" target="_top">go back to the home page </a>  &#160;&#160;
		<form action='' method="post">
			<input type="submit" name="disconnect" value="&#160;disconnect from your account" class="buttonsdisc">
		</form>
<?php 

if (isset($_POST['disconnect'])){ 

	session_destroy();

	header("Location: connexion.php");
}
?>
	</div>
</body>
</html>