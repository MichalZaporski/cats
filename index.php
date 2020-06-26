<?php
  session_start();
  if (isset($_SESSION['logged'])) {
    header('Location: profile.php');
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
    <meta name="keywords" content="koty, opieka nad kotami">
    <meta name="description" content="Zaopiekuj się kotkiem!">
    <meta name="robots" content="all">
    <title>Opieka Kotów</title>
    <link rel="stylesheet" href="./style.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162207836-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-162207836-1');
    </script>
  </head>
  <body>
    <header>
      <label for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle">
      <nav>
          <a href="index.php" class="current_page">Strona główna</a>
          <a href="give.php">Oddaj w opiekę</a>
          <a href="take.php">Zaopiekuj się</a>
          <a href="quiz.html">Quiz o kotach</a>
      </nav>
    </header>
    <div id="push"></div>
    <main>
      <div id="index_desc">
        <span id="caption1">Kot w opiece</span><br><br>
        <span id="caption2">Wyjeżdzasz na wakacje i nie masz z kim zostawić kota? A może jest Ci bardzo smutno, jesteś sam w domu i szukasz kogoś do przytulenia? Dzięki tej aplikacji możesz oddać swojego kotka w bezpieczne ręce lub zaopiekować się czyimś kotkiem. </span><br>
      </div>
      <div id="index_login_register">
        <a href="login.php" class="log_reg_button">
          <span>Zaloguj się</span>
        </a>
        <a href="register.php" class="log_reg_button">
          Zarejestruj się
        </a>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
