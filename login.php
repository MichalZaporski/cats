<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Michał Zaporski">
    <title>Zaloguj się</title>
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
          if(isset($_GET['login'])){
            if($_GET['login'] == '1')
              echo '<p class="center">Zaloguj się, by oddać kotka.</p>';
            elseif($_GET['login'] == '2')
              echo '<p class="center">Zaloguj się, by zaopiekować się kotkiem.</p>';
              elseif($_GET['login'] == '3')
                echo '<p class="center">Poprawna rejestracja. Zaloguj się na konto.</p>';
            else
              echo '<p class="center">Zaloguj się, by zaopiekować się kotkiem.</p>';
          }
         ?>
        <form  action="" method="post">
          <input type="email" name="login" placeholder="E-mail" class="login_input" required>
          <input type="password" name="password" placeholder="Hasło" class="login_input" required>
          <input type="submit" name="submit_l" value="Zaloguj się" id="submit">
        </form>
        <br>
        <p class="center">Nie masz konta? <a href="register.php">Zarejestruj się.</a></p>
        <div id="login_com">
          <?php
            require_once('script_login.php');
           ?>
        </div>
      </div>
    </main>
    <footer>
        <p>&copy; Wszelkie prawa zastrzeżone</p>
    </footer>
  </body>
</html>
