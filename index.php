<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home</title>
	<link href="livreor.css" rel="stylesheet">
</head>
<body>
<main>
	<div id="indextitles">
		<h1> Hi! Welcome to goldenbook</h1><br>
		<a href="inscription.php" target="_top">SIGN UP </a>
		<br><br>
		<a href="connexion.php" target="_top">LOG IN</a>
		<br><br>
		<form action='' method="post">
			<input type="submit" name="goldenbook" value="&#160;&#160;&#160;go to the reviews page&#160;&#160;&#160;&#160;&#160;&#160;" class="buttons1">
		</form>
<?php 

if (isset($_POST['goldenbook'])){

	$_SESSION['connected'] = $_SESSION['user'];

	header("Location: livre-or.php");
}

?>
		<br><br><br><br>
	</div>
		<footer>
			<p>giditree<p>
				<a href="https://github.com/Giacomo-DeGrandi">mon github</a> 
		</footer>
</main>
</body>
</html>