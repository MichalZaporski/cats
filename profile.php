<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
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
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <label for="toggle">&#9776;</label>
      <input type="checkbox" id="toggle">
      <nav>
          <a href="profile.php" class="current_page">Profil</a>
          <a href="give.php">Oddaj w opiekę</a>
          <a href="take.php">Zaopiekuj się</a>
          <a href="logout.php">Wyloguj się</a>
      </nav>
    </header>
    <div id="push"></div>
    <main>
      <div id="form_div" style="width: 80%;">
        <?php
          if (isset($_SESSION['logged']) && ($_SESSION['logged'] == 'a')){
            echo '<a href="admin_panel.php" id="message_button">Wiadomości</a>';
          }
          require_once('script_diplay_user_ads.php');
         ?>
        <p class="center" id="add_ad_desc">Napisz wiadomość do administracji:</p>
        <form  action="message.php" method="post">
          <textarea name="message" maxlength="300" placeholder="Twoja wiadomość..." id="input_des" class="login_input"></textarea>
          <input type="submit" name="submit_m" value="Wyślij" id="submit">
        </form>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
