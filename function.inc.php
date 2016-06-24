<?php
function login($user, $pass) {
	$link = mysqli_connect("localhost", "root", "", "request") or die("Error, MySQL is not connect");
	mysqli_select_db($link, "request") or die(mysqli_error($link));
	$result = mysqli_query($link, "SELECT * FROM User WHERE Name='$user' AND Password='$pass' LIMIT 1");
    if (mysqli_fetch_row($result)) {
        mysqli_close($link);
		return true;		
	}
	mysqli_close($link);
    return false;
}

function addRequest($user, $title, $type, $priotity, $description) {
	$link = mysqli_connect("localhost", "root", "", "request") or die("Error, MySQL is not connect");
	mysqli_select_db($link, "request") or die(mysqli_error($link));
	$sql = "INSERT INTO Entry (number, user, title, type, priority, description) VALUES (NULL ,  '$user',  '$title',  '$type',  '$priotity',  '$description')";
	if (mysqli_query($link, $sql)) {
    	$GLOBALS['komunikat']=  "Zgłoszenie zostało przyjęte";
	} else {
	    $GLOBALS['komunikat']=  "ERROR: Nie można wykonać polecenia $sql. " . mysqli_error($link);
	}
	mysqli_close($link);
}

function displayRequests($user) {
	$link = mysqli_connect("localhost", "root", "", "request") or die("Error, MySQL is not connect");
	mysqli_select_db($link, "request") or die(mysqli_error($link));
	$query = mysqli_query($link, "SELECT * FROM entry WHERE user='$user'");
	echo "<table width=\"800px\" border=\"1\"><tr><td>Numer</td><td>Data</td><td>Temat</td><td>Typ</td><td>Priorytet</td><td></td></tr>";
	while ($rekord = mysqli_fetch_assoc($query)) {
		$number = $rekord['Number'];
		$date = $rekord['Date'];
		$title = $rekord['Title'];
		$type = $rekord['Type'];
		$priority = $rekord['Priority'];
		echo "<tr><td>$number</td><td>$date</td><td>$title</td><td>$type</td><td>$priority</td><td></td></tr>"; 
	}
	echo "</table>";
}

function addMessage($fullName, $email, $content) {
	$link = mysqli_connect("localhost", "root", "", "request") or die("Error, MySQL is not connect");
	mysqli_select_db($link, "request") or die(mysqli_error($link));
	$sql = "INSERT INTO Message (id, fullName, email, content) VALUES (NULL ,  '$fullName',  '$email',  '$content')";
	if (mysqli_query($link, $sql)) {
    	$GLOBALS['komunikat']="Wiadomość została wysłana";
	} else {
	    $GLOBALS['komunikat']="ERROR: Nie można wykonać polecenia $sql. " . mysqli_error($link);
	}
	mysqli_close($link);
}

?>