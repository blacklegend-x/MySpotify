<?php declare(strict_types=1); // włączenie typowania zmiennych
session_start();
if (!isset($_SESSION['loggedin']))
{
	header('Location: login.php');
	exit();
}

	$dbhost=""; $dbuser=""; $dbpassword=""; $dbname="";
	$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	if (!$link)
	{
		echo " MySQL Connection error." . PHP_EOL;
		echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	//idu
	$idu = $_SESSION['idu'];
	$datetime = date('Y-m-d H:i:s');
	$name = $_POST['name'];
	$public = $_POST['public'];
	
	$playlist_exists = mysqli_query($link, "SELECT * FROM playlistname WHERE name='$name'");
	$playlist_exists_result = mysqli_fetch_array($playlist_exists);
	
	if(!$playlist_exists_result){
		$sql = mysqli_query($link, "INSERT INTO playlistname(idu, name, public, datetime) VALUES('$idu', '$name', '$public', '$datetime');");
	}
	
mysqli_close($link);
header('Location: portal.php');
?>
