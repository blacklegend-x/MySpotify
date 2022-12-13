<?php
session_start();
if (!isset($_SESSION['loggedin']))
{
	header('Location: login.php');
	exit();
}

if (file_exists($_FILES["file"]["tmp_name"]))
{
	$dbhost=""; $dbuser=""; $dbpassword=""; $dbname="";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	if (!$connection)
	{
		echo " MySQL Connection error." . PHP_EOL;
		echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	$file_name = $_FILES["file"]["name"];
	$file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); //rozszerzenie dodawanego pliku
	$idu = $_SESSION['idu'];
	$datetime = date('Y-m-d H:i:s');

	//przetwarzanie plikow
	if($file_extension == "mp3"){
		$target_location = "songs/" . $file_name; //lokacja docelowa nowego pliku
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_location); //przeniesienie nowego pliku
		$title = $_POST['title'];
		$musician = $_POST['musician'];
		$type = $_POST['type'];
		$lyrics = $_POST['lyrics'];
		$addfile_sql = mysqli_query($connection, "INSERT INTO song (title, musician, datetime, idu, filename, lyrics, idmt) 
		VALUES ('$title', '$musician', '$datetime', '$idu', '$file_name', '$lyrics', '$type');") or die ("DB error: $dbname");
	
		mysqli_close($connection);
	}else{
		echo "Proszę przesłać plik mp3!<br><a href='portal.php'>Wróc do portalu</a>";
	}
}
header ('Location: portal.php');
?>