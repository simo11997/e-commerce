<div class="sidebar">
	<br/>
	<h3>Derniers Article</h3>
	<br/>

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

$select = $db->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 0,3 ");
$select->execute();

while ($s=$select->fetch(PDO::FETCH_OBJ)){

	?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin/imgs/<?php echo $s->titre; ?>.jpg">
	<div style ="text-align:center;"><h2 style="color:white;"><?php echo $s->titre;?></h2>
	<h5 style="color:white;"><?php echo $s->description; ?></h5>
	<h4 style="color:white;"><?php echo $s->prix ;?>DH</h4></div>
	<br/><br/>
	<?php 
}
	 ?>
</div>