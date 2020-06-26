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
    if (isset($_POST['submit_m'])){
      $que="SELECT id_care, cat_name, city, date_start, date_end FROM cares WHERE user_take_id is null AND date_start > CURDATE() AND city='$_POST[city]' ORDER BY date_start limit 10";
    }
    else
      $que="SELECT id_care, cat_name, city, date_start, date_end FROM cares WHERE user_take_id is null AND date_start > CURDATE() ORDER BY date_start limit 10";
    if(!$result = $db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    if($result->num_rows < 1)
      echo '<p class="center">Brak wyników</p>';
    else{
      echo '<table>';
      echo '<th> Imię </th> <th> Miasto </th> <th> Opieka od </th> <th> Opieka do </th> <th> Więcej </th>';
      while($row=$result->fetch_assoc()){
        echo '<tr>';
        echo "<td>$row[cat_name] </td><td> $row[city] </td> <td> $row[date_start] </td> <td> $row[date_end] </td> <td><a href='information.php?id=$row[id_care]'> Informacje </a></td>";
        echo '</tr> ';
      }
    }
    echo '</table>';
    $result->close();
    $db_obj->close();
    return 0;
  }
  $try = display();
  if($try == 1)
    echo 'Błąd połączenia z bazą danych.'
 ?>
