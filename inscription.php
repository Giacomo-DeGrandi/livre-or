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

			//check if username already exists

			$quest = "SELECT login FROM utilisateurs "; 

			$req = mysqli_query($conn,$quest);

			$res = mysqli_fetch_all($req, MYSQLI_ASSOC);

			for($i=0; $i<isset($res[$i]); $i++){
				foreach($res[$i] as $k => $v){	
					if($v !== $_POST['login']){
						if  (  	(isset($_POST['password']) and ($_POST['password']) != '') and
								(isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '') )  {	//**
								if( $_POST['password'] == $_POST['passwordconf']){ 

									$login = $_POST['login'];
									$password = $_POST['password'];

									$quest2= " INSERT INTO utilisateurs( login, password) VALUES ('$login','$password') ";

									$req2 = mysqli_query($conn,$quest2);

									$_SESSION['subscribe']= $_POST['login'];

									if(isset($_POST['submit'])){
									
										header( "Location: connexion.php" );

									}	
								} else { echo '<span class="ads">⚠️ error . passwords don\'t match</span>';}
						}elseif (isset($_POST['submit'])){
							echo '<span class="ads">⚠️ please insert your details </span>';
						} else { echo '<span class="ads">⚠️ please insert your password </span>';
						}
					}	else {	echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; }			//**if($v !== $_POST['l..
				}
			}
} elseif (isset($_POST['submit'])){
		echo '<span class="ads">⚠️ please insert your details </span>';
} else { echo '<span class="ads">hi! 👋 please choose a username </span>'; }


	/*

if($_POST['login'] === $res[$i]['login']){
			if  ((isset($_POST['password']) and ($_POST['password']) != '')){ 
				if ((isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '')){ 
						if  (($_POST['passwordconf'] === $_POST['password']) and ($_POST['login'] !== $res[$i]['login'])) {

							$login=$_POST['login'];
							$password=$_POST['password'];

							$quest= "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password')";

							$req = mysqli_query($conn,$quest);

							$_SESSION['subscribe']= $_POST['login'];

							header('Location: connexion.php');

						} else { echo '<span class="ads">⚠️ error . passwords has to be the same</span>';}
				} else { echo '<span class="ads">⚠️ please confirm your password</span>';}
			} elseif (isset($_POST['submit'])){
				echo '<span class="ads">⚠️ please insert your details </span>';
			} else { echo '<span class="ads">⚠️ please insert your password </span>';
			}
		} else { echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; }
	}



	foreach($res as $ind => $users){
		foreach ($users as $user => $details){
			if($_POST['login']===$details){
				$usercheck++;
				if($usercheck === 1){
					echo 'ok';
					if((isset($_POST['password']) and ($_POST['password']) != '')){
						echo $_POST['password'];
						if ((isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '')){ 
							if ($_POST['passwordconf'] == $_POST['password']){ 
											
											$login=$_POST['login'];
											$password=$_POST['password'];

											$quest= "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password')";

											$req = mysqli_query($conn,$quest);

											$_SESSION['subscribe']= $_POST['login'];

											header('Location: connexion.php');
									
							} else { echo '<span class="ads">⚠️ error . passwords has to be the same</span>';}
						} else { echo '<span class="ads">⚠️ please confirm your password</span>';} 
					} elseif (isset($_POST['submit'])){
						echo '<span class="ads">⚠️ please insert your details </span>';
					} else { echo '<span class="ads">⚠️ please insert your password </span>';
					}
					
				} elseif ($usercheck === 1) { echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>';
				}
			}
		}
	}
} elseif (isset($_POST['submit'])){
		echo '<span class="ads">⚠️ please insert your details </span>';
} else { echo '<span class="ads">hi! 👋 please choose a username </span>'; }

/*

if($_POST['login']===$user['login']){ 
			if((isset($_POST['password']) and ($_POST['password']) != '')){
				if ((isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '')){ 
					if ($_POST['passwordconf'] === $_POST['password']){ 
							if(	$usernamecheck === 1 ){
								echo '<span class="ads">⚠️ error . this account already exists</span>'; 
							} elseif ( $usernamecheck === 0 ) { 
									
									$login=$_POST['login'];
									$password=$_POST['password'];

									$quest= "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password')";

									$req = mysqli_query($conn,$quest);

									$_SESSION['subscribe']= $_POST['login'];

									header('Location: connexion.php');
							}
					} else { echo '<span class="ads">⚠️ error . passwords has to be the same</span>';}
				} else { echo '<span class="ads">⚠️ please confirm your password</span>';}
			} elseif (isset($_POST['submit'])){
				echo '<span class="ads">⚠️ please insert your details </span>';
			} else { echo '<span class="ads">⚠️ please insert your password </span>';
			}
		} else { echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; break ;}
	}
} elseif (isset($_POST['submit'])){
		echo '<span class="ads">⚠️ please insert your details </span>';
} else { echo '<span class="ads">hi! 👋 please choose a username </span>'; }


$login=$_POST['login'];
									$password=$_POST['password'];

									$quest= "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password')";

									$req = mysqli_query($conn,$quest);

									$_SESSION['subscribe']= $_POST['login'];

									header('Location: connexion.php');



	for($i=0; $i<isset($res[$i]); $i++){
		if($_POST['login'] !== $res[$i]['login']){
			if  ((isset($_POST['password']) and ($_POST['password']) != '')){ 
				if ((isset($_POST['passwordconf']) and ($_POST['passwordconf']) != '')){ 
						if  (($_POST['passwordconf'] === $_POST['password']) and ($_POST['login'] !== $res[$i]['login'])) {

							$login=$_POST['login'];
							$password=$_POST['password'];

							$quest= "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password')";

							$req = mysqli_query($conn,$quest);

							$_SESSION['subscribe']= $_POST['login'];

							header('Location: connexion.php');

						} else { echo '<span class="ads">⚠️ error . passwords has to be the same</span>';}
				} else { echo '<span class="ads">⚠️ please confirm your password</span>';}
			} elseif (isset($_POST['submit'])){
				echo '<span class="ads">⚠️ please insert your details </span>';
			} else { echo '<span class="ads">⚠️ please insert your password </span>';
			}
		} else { echo '<span class="ads">⚠️ this username already exists.<br/>Please choose another username</span>'; }
	}
} elseif (isset($_POST['submit'])){
		echo '<span class="ads">⚠️ please insert your details </span>';
} else { echo '<span class="ads">hi! 👋 please choose a username </span>'; }


*/
	
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
