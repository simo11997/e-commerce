

<link rel="stylesheet" type="text/css" href="../style/bootstrap-reboot.css">
<h1>Administration - connexion</h1>
<form action = "" method="POST">
<h3>Pseudo :</h3><input type="text" name="username"/><br/><br/>
<h3>mots-de-passe :</h3><input type="text" name="password"/><br/><br/>
<input type="submit" name="submit"/><br/><br/>
</form>

<?php

session_start(); 

$user='idr_simo';
$password_definit='51895Simo';

if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password) {
	
if ($username==$user&&$password==$password_definit){
	

$_SESSION['username']=$username;
header('location: admin.php');

}else{
	
echo'Identifiant incorrect';

}

}else{

echo'Veuillez remplir les champs';

}

}

?>

