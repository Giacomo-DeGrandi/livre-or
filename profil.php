<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Account</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
	<header>
	</header>
	<main>
		<div id="mainwrapperprofil">
			<div id="sidediv">
				<h2>Hi!🎉</h2>
<?php

if(isset($_SESSION['user'])){
	echo '<h1> '.$_SESSION['user'].'</h1>';
} else {
	header('Location: connexion.php');
}
?>			
			</div>
			<div id="pfp">
			</div>
			<div id="usermaindiv">
			</div>
		</div>
		<div id="editandcomment">
			<div id="persinfo">
				<div id="editinfo">
					<h4>Personal Settings &#160;&#160;&#160;&#160;&#160; 🛠️</h4>
					<form action='' method='post' id="editinfoform">
							<input type="submit" name="see" value="see your actual informations 👁 " class="buttons1">
<?php

//Check your infos

if(isset($_POST['see'])){
	echo '<div id="seediv">';
	echo '<span>'.$_SESSION['user'].'</span><br/>';
	if(isset($_SESSION['password'])){
		echo '<span>'.$_SESSION['password'].'</span><br/>';
		echo '</div>';
		echo '<input type="submit" name="close" value="close" class="buttons1"><br><br>';
	} else {
		echo '<span>⚠️password </span>';
		echo '<input type="submit" name="close" value="close" class="buttons1">';
		echo '</div>';
	}
} 
if(isset($_POST['close'])){
	unset($_SESSION['password']);
	$_POST['see']==null;
	header('Location: profil.php');
}

?>
					</form>
					<form action='' method='post' id="editinfoform">
							<input type="submit" name="edit" value="edit your informations ⚙️ &#160;&#160;&#160;&#160;&#160;&#160;"class="buttons1">
					</form>
<?php 

//Edit your infos

if(isset($_POST['edit'])){
	echo '<div><form action="" method="post" id="editinfoform"><br><br>
							<input type="text" name="username" placeholder="new username" ><br>
							<input type="password" name="password2" placeholder="password"><br>
							<input type="text" name="oldusername" placeholder="old username" ><br>
							<input type="submit" name="submit" value="update" class="buttons1"><br><br>
							<input type="submit" name="clsedit" value="close edit" class="buttons1"><br><br>
					</form></div>';
}

if(isset($_POST['close'])){
	$_POST['edit']==null;
	header('Location: profil.php');
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'livreor';

$conn = mysqli_connect($servername, $username, $password, $database);

if( ((isset($_POST['username']) and ($_POST['username']) != '')) and
	((isset($_POST['password2']) and ($_POST['password2']) != '')) and 
	((isset($_POST['oldusername']) and ($_POST['oldusername']) != ''))  ){

			$login=$_POST['oldusername'];
			$quest = "SELECT login FROM utilisateurs "; 

			$req = mysqli_query($conn,$quest);

			$res = mysqli_fetch_all($req, MYSQLI_ASSOC);

	for($i=0; $i<=isset($res[$i]); $i++){
		foreach($res[$i] as $k => $v){
			if($v !== $_POST['username']){

				$username = $_POST['username'];
				$password = $_POST['password2']; 

				$quest2= "UPDATE utilisateurs SET login = '$username', password = '$password' WHERE login = '$login' ";

				mysqli_query($conn,$quest2);

				session_destroy();

				$_SESSION['updated']=$_POST['username'];

				header( "Location: connexion.php" );

			} else { echo '<span>this username already exists</span>';} 
		}
	} 
}
?>
		<form action='' method="post">
			<input type="submit" name="disconnect" value="&#160;disconnect from your account" class="buttons1">
		</form>
<?php 

if (isset($_POST['disconnect'])){

	session_destroy();

	header("Location: connexion.php");
}
?>
		<form action='' method="post">
			<input type="submit" name="goldenbook" value="&#160;&#160;&#160;go to the reviews page&#160;&#160;&#160;&#160;&#160;&#160;" class="buttons1">
		</form>
<?php 

if (isset($_POST['goldenbook'])){

	$_SESSION['connected'] = $_SESSION['user'];

	header("Location: livre-or.php");
}

?>
				</div>
			</div>
			<div id="comments">
				<div id="formtext">
					<h2>send a comment to the golden-book from here</h2>
					<form action='' method='post' id="commentsform">
						<textarea id="comments" name="comments" rows="7" cols="100">
						</textarea>
						<input type="submit" name="submit" value="send" class="buttons1"><br><br>
					</form>
				<div>
			</div>
<?php

?>
		</div>
	</main>
</body>
</html>