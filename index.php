<?php
require 'function.inc.php';
require 'kodphp.inc.php';
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
   <script src="bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
   <link rel="Stylesheet" type="text/css" href="style.css">
   <title>Witryna firmy Sofcik</title>
   <meta charset="UTF-8" >
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
if (isset($_GET['podstrona'])) {
  switch ($_GET['podstrona']) {
    case 'oferta':
      echo '<section id="content"><h1>Oferta</h1></section>';
      break;    
    case 'kontakt':
    ?>
      <section id="content">
      <div class="row">
        <div class="col-sm-6">
          <h2>Formularz kontaktowy</h2>
          <form action="index.php" method="POST">
              Imię i nazwisko:<br/>
              <input type="text" name="nazwisko"><br/>
              E-mail:<br/>
              <input type="text" name="email"><br/>
              Wiadomość:<br/>                  
              <textarea rows="8" cols="40" name="wiadomosc"></textarea><br/>
              <input class="btn btn-primary" type="submit" name="form_kontakt" value="Wyślij">
          </form>
        </div>
        <div class="col-sm-6">
          <h1>Kontakt</h1>
          Sofcik<br/>
          ul. Uliczna 1<br/>
          99-123 Miastowo
        </div>
      </div>
      </section>
    <?php
      break;
    case 'logowanie':
    ?>
      <section id="content"><h1>Logowanie</h1>
      <div class="row">
        <form action="index.php" method="POST">
          Login:<br/> <input type="text" name="login"><br/>
          Hasło:<br/> <input type="password" name="haslo"><br/>
          <input class="btn btn-primary" type="submit" name="logowanie" value="Zaloguj">
        </form>
      </div>
      </section>
    <?php
      break;
    case 'zgloszenie': ?>
    <section id="content"><h1>Zgłoszenie</h1>
      <div class="row">
        <form action="index.php" method="POST">
          Temat zgłoszenia:<br/> <input type="text" name="temat"><br/>
          Typ zgłoszenia:<br/>
          <select name="typ">
            <option value="Pytanie">Pytanie</option>
            <option value="Problem">Problem</option>
            <option value="Awaria">Awaria</option>
          </select><br/>
          Priorytet:<br/>
          <select name="priorytet">
            <option value="Niski">Niski</option>
            <option value="Średni">Średni</option>
            <option value="Wysoki">Wysoki</option>
          </select><br/>
          Opis zgłoszenia:<br/> <textarea name="opis" rows="5" cols="40"></textarea><br/>
          <input class="btn btn-primary" type="submit" name="zgloszenie" value="Wyślij zgłoszenie">
        </form>
      </div>
    </section>
    <?php 
      break;
    case 'lista_zgloszen':
      echo '<section id="content"><h1>Lista twoich zgłoszeń</h1>';
      displayRequests($_SESSION['zalogowany']);      
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
if (isset($komunikat)) { 
  echo '<section id="komunikat">' . $komunikat . '</h2></section>';
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