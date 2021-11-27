<?php
session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
	<div id="connwrapper">
		<div id="connbody">
			<h1> Log In </h1>
			<form action='' method='post' id="connform"><br><br>
					<input type="text" name="login" placeholder="login" ><br><br>
					<input type="password" name="password" placeholder="password"><br><br>
					<input type="submit" name="submit" value="Log In" class="buttons1"><br><br>
			</form>
<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'livreor';

$conn = mysqli_connect($servername, $username, $password, $database);

		$quest= "SELECT login, password, id FROM utilisateurs";
		$req= mysqli_query($conn,$quest);
		$res=mysqli_fetch_all($req, MYSQLI_ASSOC);

if  ((isset($_POST['login']) and ($_POST['login']) != '')){
	if  ((isset($_POST['password']) and ($_POST['password']) != '')){
			for($i=0; $i<isset($res[$i]);$i++){
				if(($_POST['login']===$res[$i]['login']) and ($_POST['password']===$res[$i]['password'])){
							
							echo '<span class="hiddenbuttons">';
							echo '<form action="profil.php" method="post">';
							echo '<input type="submit" name="connect" value="connect" class="hiddenbuttons"></span>';
							echo '</form></span>';

				} elseif (($_POST['login']!==$res[$i]['login']) and ($_POST['password']!==$res[$i]['password'])){
					echo '<span class="ads">⚠️ wrong username or password</span>';
				}
			}
	}
} elseif (isset($_SESSION['subscribe'])) {
		echo '<span class="ads">Hi! '.'<h2>'. $_SESSION['subscribe'] .'</h2>'.' please insert your username and password to enter in your account </span>';
} elseif (isset($_POST['submit'])) {
	echo '<span class="ads">⚠️ please insert your username and password </span>'; 
} else {
	echo '<span class="ads">hi! 👋 please insert your username and password to enter your account </span>'; 
}

?>

			<br><br><br><br><br><br><br><br>
			<a href="index.php" target="_top">go back to the home page </a>
			<br><br><br><br>
		</div>
	</div>
	<br><br><br><br>
		<footer>
			<p>giditree<p>
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
		</footer>

</body>
</html>