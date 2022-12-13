<?php declare(strict_types=1); // włączenie typowania zmiennych
session_start();
if (!isset($_SESSION['loggedin']))
{
	header('Location: login.php');
	exit();
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="fonts/fontawesome/css/all.css">
<style>
</style>
</head>
<body>
	Zalogowano w aplikacji jako użytkownik: 
	<?php echo $_SESSION['username'];?>
	
	Dodanie nowej playlisty<br>
	<br><form action="newplaylistadd.php" method="post">
	Nazwa playlisty: <input type="text" name="name" maxlength="20"><br>
	<input type="hidden" name="public" value="0"/>
	Public <br><input type="checkbox" name="public" value="1"><br>
	<br><input type="submit" value="Utwórz"/>
	</form><br>
	
	<br><a href='portal.php'>Powrót</a><br>
</body>
</html>