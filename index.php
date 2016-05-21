<?php
require 'function.inc.php';
require 'kodphp.inc.php';
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
   <meta charset="UTF-8" >
   <link rel="Stylesheet" href="style.css">
   <title>Przykładowa strona www wykonana w HTML 5</title>
   <meta name="Description" content="Strona firmy Sofcik" >
   <meta name="keywords" content="sofcik, oprogramowanie">
   <meta name="author" content="Sofcik">
  </head>
 <body>
  <header id="header">
    <h1><a href="index.php" title="Strona główna">Sofcik</a></h1>
 
    <nav>
     <ul id="menu">
      <li><a class="menu-2" href="index.php" title="Strona główna">Strona główna</a></li>
      <li><a class="menu-2" href="?podstrona=oferta" title="Oferta">Oferta</a></li>
      <li><a class="menu-2" href="?podstrona=kontakt" title="Kontakt">Kontakt</a></li>
      <li></li>
<?php
  if (!isset($_SESSION['zalogowany'])) 
      echo '<li><a class="menu-4" href="?podstrona=logowanie" title="Logowanie">Logowanie</a></li>';
  else { 
      echo '<li><a class="menu-4" href="?wyloguj=1" title="Wyloguj">['.$_SESSION['zalogowany'].'] Wyloguj</a></li>';
      echo '<li><a class="menu-3" href="?podstrona=zgloszenie" title="Zgoszenie">Zgłoszenie</a></li>';
      echo '<li><a class="menu-3" href="?podstrona=lista_zgloszen" title="Lista zgłoszeń">Lista zgłoszeń</a></li>';
  }
?>
     </ul>
    </nav>
  </header>
<?php
if (isset($komunikat)) { 
  echo '<section id="komunikat">' . $komunikat . '</h2></section>';
}
if (isset($_GET['podstrona'])) {
  switch ($_GET['podstrona']) {
    case 'oferta':
      echo '<section id="content"><h1>Oferta</h1></section>';
      break;    
    case 'kontakt':
    ?>
      <section id="content"><h1>Kontakt</h1>
      <p>
        Sofcik</br>
        ul. Uliczna 1</br>
        99-123 Miastowo
      </p>
      <h2>Formularz kontaktowy</h2>
      <form action="index.php" method="POST">
        Imię i nazwisko: <input type="text" name="nazwisko" size="50"></br>
        E-mail: <input type="text" name="email"></br>
        Wiadomość: <textarea rows="8" cols="80" name="wiadomosc"></textarea></br>
        <input type="submit" name="form_kontakt" value="Wyślij">
      </form>
      </section>
    <?php
      break;
    case 'logowanie':
    ?>
      <section id="content"><h1>Logowanie</h1>
      <form action="index.php" method="POST">
        Login: <input type="text" name="login"></br>
        Hasło: <input type="password" name="haslo"></br>
        <input type="submit" name="logowanie" value="Zaloguj">
      </form>
      </section>
    <?php
      break;
    case 'zgloszenie': ?>
    <section id="content"><h1>Zgłoszenie</h1>
      <ul id="menu">
        <li><a class="dbbutton" href="?action=createdb" title="Strona główna">Utwórz bazę danych</a></li>
        <li><a class="dbbutton" href="?action=dropdb" title="Oferta">Usuń bazę daych</a></li>
        <li><a class="dbbutton" href="?action=addtable" title="Tytuł linka">Dodaj tabelę produkty</a></li>
        <li><a class="dbbutton" href="?action=addproduct" title="Tytuł linka">Dodaj produkt</a></li>
        <li><a class="dbbutton" href="?action=delproduct" title="Tytuł linka">Usuń produkt id=1</a></li>      
        <li><a class="dbbutton" href="?action=updateproduct" title="Tytuł linka">Aktualizuj produkt</a></li>      
      </ul></br></br>
      <?php
             displayproducts();  ?>
    </section>
<?php 

      break;
    case 'lista_zgloszen':
      echo '<section id="content"><h1>Lista twoich zgłoszeń</h1>';
?>
      <form action="index.php" method="POST">
      <table>
      <tr><td>Nazwa</td><td>j.m.</td><td>Ilość</td><td>cena netto</td></tr>
      <tr><td><input type="text" name="nazwa" required></td>
          <td><select name="nazwa" required>
            <option selected>szt</option>
            <option>kg</option>
          </select></td>
          <td><input type="text" name="ilosc" required></td>
          <td><input type="text" name="cena" required></td></tr>
      </table>
      <input type="submit" name="dodaj_produkt" value="Dodaj produkt">
      </form>
<?php
      echo '</section>';
      break;  
    default:
     echo '<section id="content"><h2>Strona o podanym adresie nie istnieje.<br>Przejdź do <a href="index.php">Strony głównej</a></h2></section>';
  }
} else { 
?>
  <section id="content">
    <h1>Strona główna</h1>
   <p>Zapraszamy do zapoznania się z naszymi produktami i usługami! Zapewniamy profesjonalną obsługę wszelkiego rodzaju małych i średnich przedsiębiorstw, 
     oferując Państwu usługi informatyczne i nasze innowacyjne oprogramowanie.</p>
  </section>
<?php 
}
?>

  <footer id="footer">
   <p><?php $data=getdate(); echo 'Dziś jest: ' . $data['mday'] . ' ' . $data['month'] . ' ' . $data['year'] . ', ' . $data['weekday']; ?> -
    Liczba wszystkich odwiedzin: 
    <?php
      $licznik_calkowity = file_get_contents("licznik.txt");
      echo ++$licznik_calkowity;
      file_put_contents("licznik.txt", $licznik_calkowity);
    ?> -
    Liczba twoich odsłon: <?php if (isset($_COOKIE['wizyta'])) echo $_COOKIE['wizyta']; else echo '1';?></p>
   <p>Copyright Sofcik &copy; 2016</a></p>
  </footer>
</body>
</html>