<?php
  session_start();
  function checkpass($login, $password){
    $login_len=mb_strlen($login,'UTF-8');
    $password_len=mb_strlen($password,'UTF-8');
    if($login_len<3 || $login_len>30 || $password_len<5 || $password_len>25)
      return 2;
    //encje html
    $login = htmlentities($login,ENT_QUOTES,"UTF-8");
    require_once('connect_data.php');
    // Połączenie z bazą
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    //Błąd połączenia z serwerem baz danych
    if ($db_obj->connect_errno)
      return 1;
    $db_obj->set_charset('utf8');
    // Ochrona przed sql injection
    $login=$db_obj->real_escape_string($login);
    // Kwerenda wyszukująca podanego użytkownika
    $que_find_user="SELECT id_user, type, password FROM users WHERE email='$login'";
    if(!$result=$db_obj->query($que_find_user)){
      // Nieprawidłowe zapytanie
      $db_obj->close();
      return 1;
    }
    if($result->num_rows <> 1){
      // Nieprawidłowy wynik zpaytania
      $db_obj->close();
      return 2;
    }
    $row=$result->fetch_row();
    if(!password_verify($password,$row[2])){
      $db_obj->close();
      return 2; // Niepoprawne hasło
    }
    else{
      $_SESSION['id']=$row[0];
      $result->close();
      $db_obj->close();
      return $row[1];
    }
  }
  // Start skryptu
  if (isset($_SESSION['logged'])) {
    header("Location: profile.php");
    exit();
  }
  if (isset($_POST['login'])) {
    $login=$_POST['login'];
    $password=$_POST['password'];
    $try=checkpass($login, $password);
    // zreturnowana 1 - błąd serwera
    // zreturnowana 2 - złe dane logo
    if($try==1)
      echo 'Błąd podczas łączenia z serwerem.';
    elseif ($try==2)
      echo 'Niepoprawne dane logowania.';
    else{
      $_SESSION['logged']=$try;
      header("Location: take.php");
    }
  }
 ?>
