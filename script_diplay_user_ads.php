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

    $que="SELECT cat_name, city, date_start, date_end, user_take_id FROM cares WHERE user_give_id = '$_SESSION[id]'  ORDER BY date_start";
    if(!$result = $db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    echo '<p class="center" id="add_ad_desc">Twoje ogłoszenia:</p>';
    if($result->num_rows > 0){
      echo '<table>';
      echo '<th> Kot </th> <th> Miasto </th> <th> Opieka od </th> <th> Opieka do </th><th> Opiekun </th>';
      while($row=$result->fetch_assoc()){
        echo '<tr>';
        echo "<td>$row[cat_name] </td><td> $row[city] </td> <td> $row[date_start] </td> <td> $row[date_end] </td><td>";
        if ($row['user_take_id'] == "")
          echo 'brak';
        else
          echo '&#x2714';
        echo "</td>";
        echo '</tr> ';
      }
    echo '</table>';
    }
    else
      echo '<p class="center" id="add_ad_desc">Nie masz żadnych ogłoszeń</p>';

    $que2="SELECT cat_name, city, date_start, date_end, phone_num FROM cares join users on users.id_user = cares.user_give_id WHERE user_take_id = '$_SESSION[id]' AND date_start > CURDATE() ORDER BY date_start";
    if(!$result = $db_obj->query($que2)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    echo '<p class="center" id="add_ad_desc">Twoje przyszłe opieki:</p>';
    if($result->num_rows > 0){
      echo '<table>';
      echo '<th> Kot </th> <th> Miasto </th> <th> Opieka od </th> <th> Opieka do </th><th> Nr tel. opiekuna</th>';
      while($row=$result->fetch_assoc()){
        echo '<tr>';
        echo "<td>$row[cat_name] </td><td> $row[city] </td> <td> $row[date_start] </td> <td> $row[date_end] </td><td> $row[phone_num] </td></tr>";
      }
    echo '</table>';
    }
    else
      echo '<p class="center" id="add_ad_desc">Nie masz żadnych ogłoszeń</p>';
    $result->close();
    $db_obj->close();
    return 0;
  }
  $try = display();
  if($try == 1)
    echo 'Błąd połączenia z bazą danych.'
 ?>
