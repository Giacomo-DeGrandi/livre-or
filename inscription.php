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

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'livreor';

		$conn = mysqli_connect($servername, $username, $password, $database);

if  ((isset($_POST['login']) and ($_POST['login']) != '')){

			// CHECK IF USER EXISTS

			$login = $_POST['login'];

			$quest = "SELECT login FROM utilisateurs WHERE login = '$login' "; 

			$req = mysqli_query($conn,$quest);

			if (mysqli_fetch_row($req) != 0) {
				echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; 
			} else { 
				if  (  	(isset($_POST['password']) and ($_POST['password']) != '') and
						(isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '') )  {				//**
								if( $_POST['password'] === $_POST['passwordconf']){ 

									$login = mysqli_real_escape_string($_POST['login']);		// sur les injection SQL et saniter les inputs
									$password = mysqli_real_escape_string($_POST['password']);	// https://www.slideshare.net/billkarwin/sql-injection-myths-and-fallacies?from_action=save
									$quest2= " INSERT INTO utilisateurs( login, password) VALUES ('$login','$password') ";

									$req2 = mysqli_query($conn,$quest2);

									$_SESSION['subscribe']= $_POST['login'];

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
