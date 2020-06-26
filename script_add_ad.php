<?php
  function add_ad($name, $date1, $date2, $city, $description){
    $pattern = '/^[a-zżźńćąśóęłŻŹŃĆĄŚÓĘŁ]+$/i';
    if(!preg_match($pattern, $name))
      return 2;
    if(!preg_match($pattern, $city))
      return 2;
    $name_len=mb_strlen($name,'UTF-8');
    $city_len=mb_strlen($city,'UTF-8');
    $description_len=mb_strlen($description,'UTF-8');
    if($name_len>30 || $city_len>30 || $description_len>300)
      return 2;
    //encje html
    $name1 = htmlentities($name,ENT_QUOTES,"UTF-8");
    $date11 = htmlentities($date1,ENT_QUOTES,"UTF-8");
    $date21 = htmlentities($date2,ENT_QUOTES,"UTF-8");
    $city1 = htmlentities($city,ENT_QUOTES,"UTF-8");
    $description1 = htmlentities($description,ENT_QUOTES,"UTF-8");
    require_once('connect_data.php');
    // Połączenie z bazą
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    //Błąd połączenia z serwerem baz danych
    if ($db_obj->connect_errno)
      return 1;
    $db_obj->set_charset('utf8');
    // Ochrona przed sql injection
    $name2 = $db_obj->real_escape_string($name1);
    $date12 = $db_obj->real_escape_string($date11);
    $date22 = $db_obj->real_escape_string($date21);
    $city2 = $db_obj->real_escape_string($city1);
    $description2=$db_obj->real_escape_string($description1);
    if($name2!=$name || $date12!=$date1 || $date22!=$date2 || $city2!=$city || $description2!=$description)
      return 2;
    // Kwerenda dodająca ogłoszenie
    $que="INSERT INTO cares VALUES (null, '$_SESSION[id]', null, '$date12', '$date22', '$name2', '$city2', '$description2')";
    if(!$db_obj->query($que)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    $db_obj->close();
  }
  // Start skryptu
  if (isset($_POST['submit_o'])) {
    $name=$_POST['name'];
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];
    $city=$_POST['city'];
    $description=$_POST['description'];
    $try=add_ad($name, $date1, $date2, $city, $description);
    // zreturnowana 1 - błąd serwera
    // zreturnowana 2 - Błedne dane wprowadzenia
    if($try==1)
      echo 'Błąd podczas łączenia z serwerem.';
    elseif ($try==2)
      echo 'Niepoprawne dane ogłoszenia.';
    else
      echo 'Poprawnie dodano ogłoszenie.';
  }
 ?>
