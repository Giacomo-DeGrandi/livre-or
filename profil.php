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
<?php 

// PROFIL COLOR

if(isset($_COOKIE['colors'])){
	echo '<div id="pfp" style="background-color:'.$_COOKIE['colors'].' " >';

} else { echo '<div id="pfp" style="background-color:var(--bkgcolor); z-index:3">'; }


//PROFIL ICON

echo '<span id="pfplogo">'.$_SESSION['user'][0].'</span>';

?>
				<br>
				<form action="" method="post">
					<select name="color">
					  <option value="black">black</option>
					  <option value="pink">pink</option>
					  <option value="yellow">yellow</option>
					  <option value="red">red</option>
					  <option value="orange">orange</option>
					  <option value="green">green</option>
					  <option value="blue">blue</option>
					</select>
					<input type="submit" name="chcolor" value="change color" class="buttonscol">
				</form>
<?php

if(isset($_POST['chcolor'])){	
	if(isset($_POST['color'])){

				$black= '#070D0B';
				$pink= '#F31693';
				$yellow= '#F6AE2D';
				$red= '#C84630';
				$orange= '#F26419';
				$green= '#0EAD69';
				$blue= '#0072BB';

				setcookie('colors',$black,time()-3600000);
				setcookie('colors',$pink,time()-3600000);
				setcookie('colors',$yellow,time()-3600000);
				setcookie('colors',$red,time()-3600000);
				setcookie('colors',$orange,time()-3600000);
				setcookie('colors',$green,time()-3600000);
				setcookie('colors',$blue,time()-3600000);

			if($_POST['color'] == 'black'){
				setcookie('colors',$black,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='pink'){
				setcookie('colors',$pink,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='yellow'){
				setcookie('colors',$yellow,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='red'){
				setcookie('colors',$red,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='orange'){
				setcookie('colors',$orange,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='green'){
				setcookie('colors',$green,time()+3600000);
				header('Location: profil.php');
			}
			if($_POST['color'] =='blue'){
				setcookie('colors',$blue,time()+3600000);
				header('Location: profil.php');
			}
	}
}


?>				
			</div>
			<div id="usermaindiv">
				<table id="profiltable">
<?php 

// MESSAGES TABLE
	
	echo '<tr><th style="background-color:var(--bkgcolor)">latest reviews sent</th></tr>';

$servername = 'localhost:3306';
$username = 'giditree';
$password = 'admin.io';
$database = 'carlo-de-grandi-giacomo_livreor'; 

$conn = mysqli_connect($servername, $username, $password, $database);

		$login=$_SESSION['user']; 
		
		$quest3= "SELECT id FROM utilisateurs WHERE login = '$login' ";

		$req3 = mysqli_query($conn,$quest3);

		$row = mysqli_fetch_row($req3);

		// CHECK IF THERE ARE MESSAGES ALREADY, ELSE GIVE A MESSAGE INSTEAD OF A PHP ERROR

		$idmess = $row[0];

		$quest = "SELECT commentaire, date, id_utilisateur FROM commentaires WHERE id_utilisateur = '$idmess'  ORDER BY date DESC";	//display everything by date

		$req = mysqli_query($conn,$quest);

		$res = mysqli_fetch_all($req, MYSQLI_ASSOC);

		if($res != 0){

			for($i=0; $i<=isset($res[$i]); $i++){

				echo '<tr>';

				if(isset($res[$i])){ 
					foreach ($res[$i] as $k => $v){
						if($res[$i]['id_utilisateur'] !== $v){
						
						echo '<td>';
						echo $v;
							'</td>';
						}
					}

					$id = $res[$i]['id_utilisateur'];

					$quest2 = "SELECT login FROM utilisateurs WHERE id = '$id' ";	//associate  login name of another table

					$req2=mysqli_query($conn,$quest2);

					$res2=mysqli_fetch_all($req2, MYSQLI_ASSOC);

					foreach ($res2 as $k2 => $v2){
						foreach($v2 as $k3 => $v3){

							if(isset($_COOKIE['colors'])){
								echo '<th colspan="2" style="background-color:'.$_COOKIE['colors'].' " >';
								echo $v3;
								echo '</th>';								
							} else {
								echo '<th colspan="2" style="background-color:var(--bkgcolor)" >';
								echo $v3;
								echo '</th>';
							}

						}
					}

				} else {  echo '<tr><th style="background-color:var(--bkgcolor)">There are no reviews here yet</th></tr>'; }

				echo '</tr>';
			} 
		}else { '<tr><th style="background-color:var(--bkgcolor)">There are no reviews here yet</th></tr>'; }

?>
				</table>
			</div>
		</div>
		<div id="editandcomment">
			<div id="persinfo">
				<div id="editinfo">
<?php

if(isset($_COOKIE['colors'])){
	echo '<h4 style="background-color:'.$_COOKIE['colors'].' " >Personal Settings &#160;&#160;&#160;&#160;&#160; 🛠️</h4>';

} else { echo '<h4 style="background-color:var(--bkgcolor)" >Personal Settings &#160;&#160;&#160;&#160;&#160; 🛠️</h4>'; }

?>
					<form action='' method='post' id="editinfoform">
							<input type="submit" name="see" value="see your actual informations 👁 " class="buttons1">
<?php

//PERSONAL SETTINGS
$close = 'close' ;

if(isset($_POST['see'])){
	echo '<div id="seediv">';
	echo '<span>'.$_SESSION['user'].'</span><br/>';
	if(isset($_SESSION['password'])){
		echo '<span>'.$_SESSION['password'].'</span><br/>';
		echo '</div>';
		echo '<input type="submit" name="close" value="'.htmlspecialchars($close).'" class="buttons1"><br><br>';
	} else {
		echo '<span>⚠️password </span>';
		echo '<input type="submit" name="close" value="'.htmlspecialchars($close).'" class="buttons1">';
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

//EDIT YOUR INFOS



if(isset($_POST['edit'])){
	echo '<div><form action="" method="post" id="editinfoform"><br><br>
							<input type="text" name="username" placeholder="new username"><br>
							<input type="password" name="password2" placeholder="new password"><br>
							<input type="text" name="oldusername" placeholder="old username" ><br>
							<input type="submit" name="submit" value="update" class="buttons1"><br><br>
							<input type="submit" name="clsedit" value="close edit" class="buttons1"><br><br>
					</form></div>';
}

$conn = mysqli_connect($servername, $username, $password, $database);

if( ((isset($_POST['username']) and ($_POST['username']) != '')) and
	((isset($_POST['password2']) and ($_POST['password2']) != '')) and 
	((isset($_POST['oldusername']) and ($_POST['oldusername']) != ''))  ){

		if(isset($_POST['submit'])){

			$login=htmlspecialchars($_POST['username']);

			$quest = "SELECT login FROM utilisateurs WHERE login = '$login'"; 

			$req = mysqli_query($conn,$quest);

			if(mysqli_fetch_row($req) > 0 ){
			 echo '<span>this username already exists</span>';
			} else {

				$loginbrut = htmlspecialchars($_POST['oldusername']);
				$usernamebrut= htmlspecialchars($_POST['username']);
				$passwordbrut= htmlspecialchars($_POST['password2']);

				$login = mysqli_real_escape_string($conn,$loginbrut);
				$username = mysqli_real_escape_string($conn,$usernamebrut);
				$password = mysqli_real_escape_string($conn,$passwordbrut); 

				$quest2= "UPDATE utilisateurs SET login = '$username', password = '$password' WHERE login = '$login' ";

				mysqli_query($conn,$quest2);

				$_SESSION['password'] = $password;

				$_SESSION['user'] = $username;

				header( "Location: profil.php" );
			} 

		} elseif (isset($_POST['clsedit'])){
			if(isset($_POST['edit'])){
				$_POST['edit']= null;
			}
		}
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
		<form action='' method="post">
			<input type="submit" name="disconnect" value="&#160;disconnect" class="buttonsdisc">
		</form>
<?php 

if (isset($_POST['disconnect'])){

	session_destroy();

	header("Location: connexion.php");
}

?>
				</div>
			</div>
			<div id="comments">
				<div id="formtext">
					<h2>send a review from here</h2>
					<form action='' method='post' id="commentsform">
						<textarea id="comments" name="comments" rows="7" cols="100">
						</textarea>
						<input type="submit" name="submit" value="send" class="buttons1"><br><br>
					</form>
				<div>
			</div>
<?php

$servername = 'localhost:3306';				// je le reecrit parce que j'ai utilisé les meme variables pour des autres fins
$username = 'giditree'; 
$password = 'admin.io';
$database = 'carlo-de-grandi-giacomo_livreor'; 

if(isset($_POST['comments'])){
	if(isset($_POST['submit'])){

		$conn = mysqli_connect($servername, $username, $password, $database);

		$commentbrut = htmlspecialchars($_POST['comments']);

		$comment = mysqli_real_escape_string($conn,$commentbrut);
		$iduser = $_SESSION['id'];
		$date = date("Y-m-d H:i:s");

		$quest= "INSERT INTO commentaires (commentaire, id_utilisateur, date ) VALUES ('$comment','$iduser','$date')";

		$req = mysqli_query($conn,$quest);

		echo '<span id="datecomments">&#160;&#160; review sent ☑️&#160;&#160;</span>';

		header('Location: profil.php');

		$_SESSION['sentprofil'] = 1 ;
		
	}
}

?>
		</div>
	</main>
</body>
</html>