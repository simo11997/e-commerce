<?php 

require_once('includes/header.php');

require_once('includes/sidebar.php');

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
if (isset($_GET['show'])){


}else{ 

if (isset($_GET['categorie'])){

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
$categorie = $_GET['categorie'];
$select = $db->prepare("SELECT * FROM produits WHERE categorie= '$categorie'");
$select->execute();

while ($s=$select->fetch(PDO::FETCH_OBJ)){

	?>
	<br/><br/><a href="?show=<?php echo $s->titre; ?>"><img src="admin/imgs/<?php echo $s->titre; ?>.jpg"/></a>
	          <a href="?show=<?php echo $s->titre; ?>"><h2><?php echo $s->titre;?></h2></a>
	<h5><?php echo $s->description; ?></h5>
	<h4><?php echo $s->prix; ?>DH</h4>
	
<br/><br/>

	<?php  

   }

?>

<br/><br/>
<?php  

}else{ 


$select = $db->query("SELECT * FROM categorie");

while ($s = $select->fetch(PDO::FETCH_OBJ)){

?>

<a href="?categorie=<?php echo $s->nom; ?>"><h3><?php echo $s->nom ?></h3></a>

<?php 
} 
}
}

require_once('includes/header.php');

?>