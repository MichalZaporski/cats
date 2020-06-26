<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: login.php?login=1');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Michał Zaporski">
    <title>Oddaj w opiekę</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <label for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle">
      <nav>
          <a href="profile.php">Profil</a>
          <a href="give.php"  class="current_page">Oddaj w opiekę</a>
          <a href="take.php">Zaopiekuj się</a>
          <a href="logout.php">Wyloguj się</a>
      </nav>
    </header>
    <div id="push"></div>
    <main>
      <div id="form_div">
        <p class="center" id="add_ad_desc">Wprowadź dane, by wystawić ogłoszenie.</p>
        <form  action="" method="post">
          <input type="text" maxlength="30" name="name" placeholder="Imię kota" class="login_input" required>
          <p class="center">Data oddania:</p>
          <input type="date" name="date1" placeholder="Data oddania" id="input_date" class="login_input" required>
          <p class="center">Data powrotu:</p>
          <input type="date" name="date2" placeholder="Data powrotu" id="input_date" class="login_input"  required>
          <input type="text" maxlength="30" name="city" placeholder="Miasto odbioru" class="login_input" required>
          <textarea name="description" maxlength="300" placeholder="Opis kota: płeć, wiek..." id="input_des" class="login_input"></textarea>
          <input type="submit" name="submit_o" value="Dodaj ogłoszenie" id="submit">
        </form>
        <br>
        <div id="login_com">
          <?php
            require_once('script_add_ad.php');
           ?>
        </div>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
