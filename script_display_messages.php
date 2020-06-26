<?php
  function display(){
    require_once('connect_data.php');
    // Połączenie z bazą
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    //Błąd połączenia z serwerem baz danych
    if ($db_obj->connect_errno)
      return 1;
    $db_obj->set_charset('utf8');
    // Kwerenda wyświetlająca informacje  o ogłoszeniu

    $que="SELECT text, name, sec_name, email FROM messages join users on users.id_user =  messages.from_user_id ORDER BY id_mess desc limit 10";
    if(!$result = $db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    if($result->num_rows < 1)
      echo '<p class="center">Brak wyników</p>';
    else{
      while($row=$result->fetch_assoc()){
        echo "<p class='messag'>$row[name] $row[sec_name] $row[email]</p>";
        echo "<p class='messag'>$row[text]</p><br>";
      }
    }
    $result->close();
    $db_obj->close();
    return 0;
  }
  $try = display();
  if($try == 1)
    echo 'Błąd połączenia z bazą danych.'
 ?>
