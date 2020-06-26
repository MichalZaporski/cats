<?php
  function message(){
    $message = htmlentities($_POST['message'],ENT_QUOTES,"UTF-8");
    require_once('connect_data.php');
    // Połączenie z bazą
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    //Błąd połączenia z serwerem baz danych
    if ($db_obj->connect_errno)
      return 1;
    $db_obj->set_charset('utf8');
    // Ochrona przed sql injection
    $message=$db_obj->real_escape_string($message);
    // Kwerenda wyszukująca podanego użytkownika
    $que="INSERT INTO messages VALUES(null, '$_SESSION[id]', 1, '$message')";
    if(!$db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    $db_obj->close();
    return 0;
  }
  if (isset($_POST['submit_m'])) {
    if(message() == 1)
      echo '<p class="center" style="padding-bottom:15px;">Błąd podczas wysyłania wiadomości.</p>';
    else
      echo '<p class="center" style="padding-bottom:15px;">Wysłano wiadomość.</p>';
  }
 ?>
