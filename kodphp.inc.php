<?php
session_start();  
if(isset($_COOKIE['wizyta'])) {
	$licznik=intval($_COOKIE['wizyta']);
	$licznik++;
	setcookie("wizyta","$licznik",time()+60*1);
} else {
	setcookie("wizyta","1",time()+60*1);
}

if (isset($_POST['logowanie'])) {
		if (login($_POST['login'], $_POST['haslo']) === true) {
		$_SESSION['zalogowany']=$_POST['login'];
		$komunikat='Witaj ' . $_POST['login'] . '. Zostałes poprawnie zalogowany.';
	} else {
		$komunikat='Błędny login lub hasło.';
		$_GET['podstrona']='logowanie';
	}
}

if (isset($_POST['zgloszenie'])) {
		if(empty($_POST["temat"]) || empty($_POST["opis"]))	{
			$komunikat='Nie wypełniono poprawnie wszystkich pól';
			$_GET['podstrona']='zgloszenie';
		} else {			
			addRequest($_SESSION['zalogowany'], $_POST['temat'], $_POST['typ'], $_POST['priorytet'], $_POST['opis']);
			$komunikat='Wysłano zgłoszenie';
		};
}

if (isset($_POST['kontakt'])) {
		if(empty($_POST["nazwisko"]) || empty($_POST["email"]) || empty($_POST["wiadomosc"])) {
			$komunikat='Nie wypełniono poprawnie wszystkich pól';
			$_GET['podstrona']='kontakt';
		} else {
			addMessage($_POST['nazwisko'], $_POST['email'], $_POST['wiadomosc']);
			$komunikat='Wiadomość została wysłana';			
		};
}

if (isset($_GET['wyloguj'])) {
	unset($_SESSION['zalogowany']);
	$komunikat='Zostałes poprawnie wylogowany';
}


?>