<?php 

session_start();

	try {
	
		$db= new PDO('mysql:localhost;dbname=e-commerce','root','');
		$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
		$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

	}

	catch (Exception $e) {

	die('une erreur est survenue');
	
	}

?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style/bootstrap-reboot.css">
	</head>
	<header>
		<br/> <h1 class="ns">ShoppiSOM</h1><br/>
		<ul class="menu">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="Boutique.php">Boutique</a></li>
			<li><a href="Panier.php">Panier</a></li>
			<li><a href="Conditions.php">Conditions générales des ventes</a></li>
			<li><a href="/e-commerce/admin/">connexion</a></li>
		</ul>
	</header>
</html>
