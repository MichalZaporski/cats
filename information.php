<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Michał Zaporski">
    <title>Informacje</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <label for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle">
      <nav>
          <?php
            session_start();
            if (isset($_SESSION['logged']))
              echo '<a href="profile.php">Profil</a>';
            else
              echo '<a href="index.php">Strona głowna</a>';
          ?>
          <a href="give.php">Oddaj w opiekę</a>
          <a href="take.php" class="current_page">Zaopiekuj się</a>
          <?php
            if (isset($_SESSION['logged']))
              echo '<a href="logout.php">Wyloguj się</a>';
          ?>
      </nav>
    </header>
    <div id="push"></div>
    <main>
      <div id="form_div" style="width: 80%;">
        <?php
          require_once('script_diplay_offert.php');
         ?>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
