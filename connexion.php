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
	<header>
			<a href="livre-or.php" target="_top">go to the reviews</a>
	</header>
	<div id="connwrapper"> 
		<div id="connbody">
			<h1> Log In </h1>
			<form action='' method='post' id="connform"><br><br>
					<input type="text" name="login" placeholder="login" ><br><br>
					<input type="password" name="password" placeholder="password"><br><br>
					<input type="submit" name="submit" value="Log In" class="buttons1"><br><br>
			</form>
<?php

if(isset($_SESSION['updated'])){
	echo '<span> details updated succesfully </span>';
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'livreor';

$conn = mysqli_connect($servername, $username, $password, $database);

if 	( ((isset($_POST['login']) and ($_POST['login']) != '')) and
		((isset($_POST['password']) and ($_POST['password']) != '')) ){

		$login=$_POST['login'];
 
		$quest= "SELECT login, password, id FROM utilisateurs WHERE login = '$login' ";
		$req= mysqli_query($conn,$quest);
		$res=mysqli_fetch_all($req, MYSQLI_ASSOC);

		$usercheck=0;
				foreach($res as $k => $v){
						if($v['login'] === $_POST['login']){ 
							$usercheck++;
						} else { echo '<span> wrong username </span>';}
						if ($v['password'] === $_POST['password']){
									$usercheck++;

								if($usercheck >= 2 ){

								$_SESSION['id'] = $v['id'];
								$_SESSION['user'] = $_POST['login'];
								$_SESSION['connected'] = $_POST['login'];
								$_SESSION['password'] = $_POST['password'];
										
										if(isset($_POST['submit'])){
										
											header( "Location: profil.php" );
										}

								} else { echo '<span class="ads">⚠️ invalid username or password </span>'; }

						} else { echo '<span> wrong password</span>';}
				}
} elseif (isset($_POST['submit'])) {
	echo '<span class="ads">⚠️ please insert your username and password </span>'; 
} else {
	echo '<span class="ads">hi! 👋 please insert your username and password to enter your account </span>'; 
}

?>

			<br>
			<a href="index.php" target="_top">go back to the home page </a>
			<br><br>
		</div>
	</div>
	<br><br><br><br>
		<footer>
			<p>giditree<p>
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
		</footer>

</body>
</html>