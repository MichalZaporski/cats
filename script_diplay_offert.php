<?php
  function display(){
    require_once('connect_data.php');
    // Połączenie z bazą
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    //Błąd połączenia z serwerem baz danych
    if ($db_obj->connect_errno)
      return 1;
    $db_obj->set_charset('utf8');
    // Kwerenda dodająca ogłoszenie do konta
    if (isset($_GET['id'])){
      $que="SELECT id_care, cat_name, city, date_start, date_end, description, name, phone_num FROM cares join users on users.id_user = cares.user_give_id  WHERE id_care = '$_GET[id]'";
      if(isset($_POST['submit_r'])){
        if (!isset($_SESSION['logged'])) {
          header("Location: login.php?login=2");
          exit();
        }
        $que = "UPDATE cares SET user_take_id = $_SESSION[id] WHERE id_care = '$_GET[id]'";
        if ($db_obj->query($que)) {
          echo '<p class="center" style="padding-bottom:15px;">Poprawnie zaakceptowano ogłoszenie.</p>';
          return 0;
        }
        return 1;
      }
    }
    else
      return 1;

    if(!$result = $db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }

    $row=$result->fetch_assoc();
    echo '<table>';
    echo '<th> Imię </th> <th> Miasto </th> <th> Opieka od </th> <th> Opieka do </th>';
    echo '<tr>';
    echo "<td>$row[cat_name] </td><td> $row[city] </td> <td> $row[date_start] </td> <td> $row[date_end] </td>";
    echo '</tr> ';
    echo '</table>';
    echo '<table>';
    echo '<th> Imię właściciela </th> <th> Nr telefonu </th>';
    echo '<tr>';
    echo "<td>$row[name] </td><td> $row[phone_num] </td>";
    echo '</tr> ';
    echo '</table>';
    echo '<table>';
    echo '<th> Kilka słów o kotku od właściciela </th>';
    echo '<tr>';
    echo "<td>$row[description] </td>";
    echo '</tr> ';
    echo '</table>';
    echo '<form  action="" method="post">';
    echo '<input type="submit" name="submit_r" value="Kliknij, by zarezerwować opiekę" id="submit">';
    echo '</form>';
    $result->close();
    $db_obj->close();
    return 0;
  }
  $try = display();
  if($try == 1)
    echo 'Błąd połączenia z bazą danych.'
 ?>
