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
	if (($_POST['login']=='admin') && ($_POST['haslo']=='123')) {
		$_SESSION['zalogowany']=$_POST['login'];
		$komunikat='Witaj ' . $_POST['login'] . '. Zostałes poprawnie zalogowany.';
	} else {
		$komunikat='Błędny login lub hasło.';
		$_GET['podstrona']='logowanie';
	}
}

if (isset($_GET['wyloguj'])) {
	unset($_SESSION['zalogowany']);
	$komunikat='Zostałes poprawnie wylogowany';
}

if (isset($_GET['action'])) {
	switch($_GET['action']) {
		case "createdb":
			createdb();
			break;
		case "dropdb":
			dropdb();
			break;
		case "addtable":
			addtable();
			break;
		case "addproduct":
			addproduct();
			break;
		case "delproduct":
			delproduct(1);
			break;
		case "updateproduct":
			updateproduct();
			break;
		case "del":
			delproduct($_GET['id']);
			break;
	}
	$_GET['podstrona'] = "mysql";
}
?>