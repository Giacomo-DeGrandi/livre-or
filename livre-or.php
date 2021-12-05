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
<?php 

if(isset($_SESSION['user'])){
	echo '<a href="profil.php" target="_top">back to your account</a>  &#160;&#160;&#160;&#160';
	echo '<form action="" method="post">
			<input type="submit" name="disconnect" value="&#160;disconnect from your account" class="buttonsdisc">
		</form>';
}

?>
			<a href="connexion.php" target="_top">log in</a> &#160;&#160;&#160;&#160;
	</header>
<?php

if (isset($_POST['disconnect'])){

	session_destroy(); 

	header("Location: connexion.php");
}

?>
<main id="reviewsmain">
	<br><br><br><br>
	<h1>What people are saying:</h1>
		<div id="goldentable">
			<table>
<?php

$servername = 'localhost:3306';
$username = 'giditree';
$password = 'admin.io';
$database = 'carlo-de-grandi-giacomo_livreor'; 

		$conn = mysqli_connect($servername, $username, $password, $database);

		$quest = "SELECT commentaire, date, id_utilisateur FROM commentaires ORDER BY date DESC";	//display everything

		$req = mysqli_query($conn,$quest);

		$res = mysqli_fetch_all($req, MYSQLI_ASSOC);

		if(!empty($res)){ 		// je pose ce condition parce-que si jamais il y à pas de commentaire le browser donne erreur php										// comme quoi $res c'est faux et tout mon tableau c'est en defaux
			for($i=0; $i<=isset($res[$i]); $i++){
				echo '<tr>';

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
						echo '<th colspan="2">';
						echo $v3;
						echo '</th>';
					}
				}
				echo '</tr>';
			}
		} 

?>
			</table>
		</div> 
<?php 

if(isset($_SESSION['connected'])){

	echo '<form action="" method="post" id="goldenform">';
	echo '<h4> username:'. ' ' . $_SESSION['connected'].'</h4>';
	echo '<input type="submit" name="tocomments" value="go to review form" class="buttons1">
			<input type="submit" name="fastcomments" value="send a review from here" class="buttons1">
		</form>';
} else { echo '<br><br><span class="ads"> please connect to leave a review </span>'; }

if(isset($_POST['tocomments'])){
	$_SESSION['user']=$_SESSION['connected'];
	header("Location: commentaire.php");
}
if(isset($_POST['fastcomments'])){
	echo '<div id="fastcomments">';
	echo '<h4>write here your review</h4>';
	echo '<form action="" method="post">';
	echo '<input type="submit" name="sendfast" value="send" class="buttons1">';
	echo '<textarea id="fastcommentsarea" name="fastcommentsarea" rows="4" cols="100"></textarea>';;
	echo '</form>';
	echo '</div>';
}

if(isset($_SESSION['connected'])){
	if(isset($_POST['fastcommentsarea'])){
		if(isset($_POST['sendfast'])){
		
				$comment = mysqli_real_escape_string($conn,$_POST['fastcommentsarea']);
				$iduser = $_SESSION['id'];
				$date = date("Y-m-d H:i:s");
		
				$quest= "INSERT INTO commentaires (commentaire, id_utilisateur, date ) VALUES ('$comment','$iduser','$date')";
		
				$req = mysqli_query($conn,$quest);

				header('Location: livre-or.php');
		
				echo '<span id="datecomments">&#160;&#160; review sent ☑️&#160;&#160;</span>';
		}
	}
}

?>
		<footer>
			<p>giditree<p>
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
		</footer>
</main>
</body>
</html>