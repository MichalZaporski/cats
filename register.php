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
    <title>Zarejestruj się</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <label for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle">
      <nav>
          <a href="index.php" class="current_page">Strona główna</a>
          <a href="give.php">Oddaj w opiekę</a>
          <a href="take.php">Zaopiekuj się</a>
      </nav>
    </header>
    <div id="push"></div>
    <main>
      <div id="form_div">
        <?php
          require_once('script_register.php');
        ?>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
