<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscribe</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
	<header>
	</header>
<main>
	<div id="inscwrapper">
		<div id="subs"> 
			<h1>SIGN UP</h1>
			<form action='' method='post'>	
				<input type="text" name="login" placeholder="login" ><br>
				<input type="password" name="password" placeholder="password"><br>
				<input type="password" name="passwordconf" placeholder="confirm_password" ><br><br>
				<input type="submit" name="submit" value="send" class="buttons1">
			</form><br><br>
<?php

$servername = 'localhost:3306';
$username = 'giditree';
$password = 'admin.io';
$database = 'carlo-de-grandi-giacomo_livreor'; 

		$conn = mysqli_connect($servername, $username, $password, $database);

if  ((isset($_POST['login']) and ($_POST['login']) != '')){

			// CHECK IF USER EXISTS

			$loginbrut= htmlspecialchars($_POST['login']);

			$login = mysqli_real_escape_string($conn,$loginbrut);

			$quest = "SELECT login FROM utilisateurs WHERE login = '$login' "; 

			$req = mysqli_query($conn,$quest);

			if (mysqli_fetch_row($req) != 0) {
				echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; 
			} else { 
				if  (  	(isset($_POST['password']) and ($_POST['password']) != '') and
						(isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '') )  {				//**
								if( $_POST['password'] === $_POST['passwordconf']){ 

									$loginbrut=htmlspecialchars($_POST['login']);		// my security for XSS 
									$passwordbrut=htmlspecialchars($_POST['password']);

									// une petit point sur la securité ---> ALors, je me demande si, par example, 
									// en utilisant un regex pour excluder ou un preg_match pour detecter des scripts
									// je pourrait etre plus sûr sur ce que l'utilisateur insert dans les forms (ae. whitelisté toutes 
									// les possibilitées d'input de un utilisateur ou lieux d'excluder seulement certaines.

									$login = mysqli_real_escape_string($conn,$loginbrut);		// my security for SQL Inj
									$password = mysqli_real_escape_string($conn,$passwordbrut);	

									$quest2= " INSERT INTO utilisateurs( login, password) VALUES ('$login','$password') ";

									$req2 = mysqli_query($conn,$quest2);

									$_SESSION['subscribe']= $loginbrut;

									if(isset($_POST['submit'])){
									
										header( "Location: connexion.php" );

									}	
								} else { echo '<span class="ads">⚠️ error . passwords don\'t match</span>';}
				} else { echo '<span class="ads">⚠️ please insert your password </span>';	}
			}
} elseif (isset($_POST['submit'])){
		echo '<span class="ads">⚠️ please insert your details </span>';
} else { echo '<span class="ads">hi! 👋 please choose a username </span>'; }


?>
		</div> <!-- subs-->
		<div class="downlinks">
			<br><br><br><br><br>
			<a href="index.php" target="_top">go back to the home page </a>
			<br><br>
			<a href="connexion.php" target="_top">Already Signed Up? Log in </a>
			<br>
		</div>
		</div>		<!--inscwrapperdiv -->
		<footer>
			<p>giditree<p> 
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
		</footer>
	</main>
	</body>
</html>
