<h1>&nbsp;Bienvenue M.IDRISSI</h1>
<?php

session_start();


if (isset($_SESSION['username'])){
if (isset($_GET['action'])){
if ($_GET['action']=='add'){

if(isset($_POST['submit'])){
$titre=$_POST['titre'];
$description=$_POST['description'];
$prix=$_POST['prix'];


$img = $_FILES['img']['name'];

$img_tmp =$_FILES['img']['tmp_name'];

if(!empty($img_tmp)){
	
	$image = explode('.',$img);

    $image_ext = end($image);

    if (in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){

	echo 'veuillez entrer une image ayant pour extention : png, jpg ou jpeg';
}else{

	$image_size = getimagesize($img_tmp);

	if($image_size['mime']=='image/jpeg'){

		$image_src = imagecreatefromjpeg($img_tmp);
	}else if($image_size['mime']=='image/png'){

		$image_src = imagecreatefrompng($img_tmp);
	}else{

		$image_src = false;
		echo 'veuillez rentrer une image valide';
	}
	if($image_src!==false){

		$image_width=100;

		if ($image_size[0]==$image_width){

			$image_finale = $image_src;
		}else{
			$new_width[0]=$image_width;

			$new_height[1] = 100;

			$image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);

			imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);

		}

		imagejpeg($image_finale,'imgs/'.$titre.'.jpg');

	}

}

}else{

	echo'veuillez rentrer une image';
}

if ($titre&&$description&&$prix){

	$categorie=$_POST['categorie'];

	try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}



$insert = $db->prepare("INSERT INTO produits VALUES('0','$titre','$description','$prix','$categorie')");
$insert->execute();

}else{

echo'veuillez remplir tous les champs';

}

}


?>

<form action=""method="post"enctype="multipart/form-data">
	<h3>Titre de produit :</h3><input type="text" name="titre"/>
	<h3>Description du produit :</h3><textarea name="description"></textarea>
	<h3>Prix :</h3><input type="text" name="prix"/>
	<h3>Image :</h3>
	<input type="file" name="img"/><br/><br/>
	<h3>categorie :</h3><select name="categorie">
		
		<?php 

try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}

		$select=$db->query("SELECT * FROM categorie");

		while($s = $select->fetch(PDO::FETCH_OBJ)){

			?>

			<option><?php echo $s->nom; ?></option>
			
			<?php 
}
			 ?>

    </select>
	<br/><br/>
	<input type="submit" name="submit"/>

</form>

<?php

}else if($_GET['action']=='modifieretsupprimer'){

	try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}

$select = $db->prepare("SELECT * FROM produits");
$select->execute();

while ($s=$select->fetch(PDO::FETCH_OBJ)){

	echo $s->titre;
	?>

<a href="?action=modifier&amp;id=<?php echo $s->id; ?>">Modifer</a>
<a href="?action=supprimer&amp;id=<?php echo $s->id; ?>">Supp</a><br/><br/>


	<?php 	



}

}else if($_GET['action']=='modifier'){


try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();
}
$id=$_GET['id'];
$select = $db->prepare("SELECT * FROM produits WHERE id=$id");
$select->execute();
$data = $select->fetch(PDO::FETCH_OBJ);
?>
<form action=""method="post">
	<h3>Titre de produit :</h3><input value="<?php echo $data->titre; ?>" type="text" name="titre"/>
	<h3>Description du produit :</h3><textarea name="description"><?php echo $data->description; ?></textarea>
	<h3>Prix :</h3><input value="<?php echo $data->prix; ?>" type="text" name="prix"/>
	<h3>categorie :</h3><input value=" <?php echo $data->categorie; ?> " type="text" name="categorie">
	<br/><br/>
	<input type="submit" name="submit" value="modifier"/>
</form>
<?php

if(isset($_POST['submit'])){
$titre=$_POST['titre'];
$description=$_POST['description'];
$prix=$_POST['prix'];
$categorie=$_POST['categorie'];


$update = $db->prepare("UPDATE produits SET titre='$titre',description='$description',prix='$prix',categorie='$categorie' WHERE id=$id");
$update->execute();


header('Location:admin.php?action=modifieretsupprimer');

}

}else if($_GET['action']=='supprimer'){

try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}	

$id=$_GET['id'];
$delete = $db->prepare("DELETE FROM produits WHERE id=$id");
$delete->execute();

header('location:admin.php?action=modifieretsupprimer ');

}else if ($_GET['action']=='add_categorie'){

	if(isset($_POST['submit'])){

		$nom = $_POST['nom'];
		if($nom){

			try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}



$insert = $db->prepare("INSERT INTO categorie VALUES('0','$nom')");
$insert->execute();

 header('location:admin.php?action=modifieretsupprimer_categorie');

}else{

		echo'veuillez remplir le champ';

		}
	}


	?>

	<form action="" method="post">
		
		<h3>Titre de la catégorie</h3><input type="text" name="nom"/>
		<input type="submit" name="submit" value="Ajouter" />
		

	</form>
	<?php  

}else if($_GET['action']=='modifieretsupprimer_categorie'){

try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}

$select = $db->prepare("SELECT * FROM categorie");
$select->execute();

while ($s=$select->fetch(PDO::FETCH_OBJ)){

	echo $s->nom;
	?>

<a href="?action=modifier_categorie&amp;id=<?php echo $s->id; ?>">Modifer</a>
<a href="?action=supprimer_categorie&amp;id=<?php echo $s->id; ?>">Supp</a><br/><br/>


	<?php
}
	
}else if ($_GET['action']=='modifier_categorie'){

try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();
}
$id=$_GET['id'];
$select = $db->prepare("SELECT * FROM categorie WHERE id=$id");
$select->execute();

$data = $select->fetch(PDO::FETCH_OBJ);

?>
<form action=""method="post">
	<h3>Titre de produit :</h3><input value="<?php echo $data->nom; ?>" type="text" name="titre"/>
	<input type="submit" name="submit" value="modifier"/>
</form>
<?php

if(isset($_POST['submit'])){
$titre=$_POST['titre'];


$update = $db->prepare("UPDATE categorie SET nom='$titre'WHERE id=$id");
$update->execute();

header('Location:admin.php?action=modifieretsupprimer_categorie');
}                

}else if ($_GET['action']=='supprimer_categorie'){

$id=$_GET['id'];

try
{
$db = new PDO('mysql:host=127.0.0.1;dbname=e-commerce','root','');
$db->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){

echo'une erreur est survenue';
die();

}

$delete = $db->prepare("DELETE FROM categorie WHERE id=$id");
$delete->execute();

header('location: admin.php?action=modifieretsupprimer_categorie ');

 }else{

die('une erreur s\'est produite.');
 
}
}else{

}
}else{

header('location: ../index.php');

}
?>
<link rel="stylesheet" type="text/css" href="../style/bootstrap-reboot.css"/>
<br/>
<a href="?action=add">&nbsp;&nbsp;Ajouter un produit</a><br/><br/>
<a href="?action=modifieretsupprimer">&nbsp;&nbsp;Modifier/Supprimer un produit</a><br/><br/>
<a href="?action=add_categorie">&nbsp;&nbsp;Ajouter une categorie</a><br/><br/>
<a href="?action=modifieretsupprimer_categorie">&nbsp;&nbsp;Modifier/Supprimer une categorie</a>