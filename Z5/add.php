<?php
$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
$pass_confirm= htmlentities ($_POST['pass_confirm'], ENT_QUOTES, "UTF-8");; // hasło z formularza
$link = mysqli_connect('mariadb106.server701675.nazwa.pl', 'server701675_bargra5', 'N8CrQi!qb@y3YT@', 'server701675_bargra5'); //polaczenie z baza danych
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($link, "SELECT * FROM user WHERE login='$user'"); // wiersza, w którym login=login z formularza
$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD


if (str_contains($_POST['user'], '\\') || str_contains($_POST['user'], '/') || str_contains($_POST['user'], '|') || str_contains($_POST['user'], '<') || str_contains($_POST['user'], '>') || str_contains($_POST['user'], ':') || str_contains($_POST['user'], '?') || str_contains($_POST['user'], '*') || str_contains($_POST['user'], '"')){
	echo "Podano nieprawidlowe znaki przy tworzeniu użytkownika";
	echo "<a href='rejestruj.php'>Wróć do rejestracji</a>";
}
else{


if($pass !== $pass_confirm)
{
	echo "Hasła nie są takie same!<br><a href='index.php'>Powrót do index.php</a><br/><a href='rejestruj.php'>Powrót do rejestracji</a><br/>";
}
else
{
	if(!$rekord) //nie istnieje w bazie wpis
	{
		$query="INSERT INTO user (login, password) VALUES ('$user', '$pass')";
		if(mysqli_query($link, $query))
		{
//			if (!file_exists($user . '/')) {
//               mkdir($user . '/', 0777, true);
//            }
			header('Location: login.php');
		}
		else
		{
			header('Location: rejestruj.php');
		}			
			
	}
	else
	{
		echo "Uzytkownik już istnieje"; ?>
		<br><a href='index.php'>Powrót do index.php</a><br/><a href='rejestruj.php'>Powrót do rejestracji</a><br/>
		<?php

	}
}


}


mysqli_close($link);
?>