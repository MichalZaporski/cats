<?php
  function validate(){
    $_SESSION['flag']=true;
    $_SESSION['email_flag']=true;
    $pattern = '/^[a-zżźńćąśóęłŻŹŃĆĄŚÓĘŁ]+$/i';
    //imie
    if(!preg_match($pattern, "$_POST[name]")){
      $_SESSION['flag']=false;
      $_SESSION['name_e']='Imię może składać się wyłącznie z liter';
    }
    $name_len= mb_strlen($_POST['name']);
    if($name_len<2 || $name_len>25){
      $_SESSION['flag']=false;
      $_SESSION['name_e']='Niepoprawna długość imienia';
    }
    //nazwisko
    if(!preg_match($pattern, "$_POST[sec_name]")){
      $_SESSION['flag']=false;
      $_SESSION['name_e']='Nazwisko może składać się wyłącznie z liter';
    }
    $sec_name_len = mb_strlen($_POST['sec_name']);
    if($sec_name_len<2 || $sec_name_len>30){
      $_SESSION['flag']=false;
      $_SESSION['sec_name_e']='Niepoprawna długość nazwiska';
    }
    //email
    $emailS=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if($_POST['email']!=$emailS){
      $_SESSION['email_e']='Niepoprawny email!';
      $_SESSION['flag']=false;
      $_SESSION['email_flag']=false;
    }
    if (!filter_var($emailS,FILTER_VALIDATE_EMAIL)){
      $_SESSION['email_e']='Niepoprawny email!';
      $_SESSION['flag']=false;
      $_SESSION['email_flag']=false;
    }
    //nr telefonu
    $dl_nr = mb_strlen($_POST['phone_num']);
    if($dl_nr<9 || $dl_nr>11){
      $_SESSION['flag']=false;
      $_SESSION['phone_num_e']='Niepoprawna długość numeru.';
    }
    if (!ctype_digit($_POST['phone_num'])) {
      $_SESSION['flag']=false;
      $_SESSION['phone_num_e']='Numer może się składać wyłącznie z cyfr.';
    }
    //hasło
    if ((strlen($_POST['pass1'])<5) || (strlen($_POST['pass1'])>25)){
			$_SESSION['flag']=false;
			$_SESSION['pass_e']="Hasło musi posiadać od 5 do 25 znaków!";
		}

		if ($_POST['pass1']!=$_POST['pass2']){
      $_SESSION['flag']=false;
			$_SESSION['pass_e']="Podane hasła nie są identyczne!";
		}
  }

  //Start skryptu
  if (isset($_POST['submit'])) {
    validate();

    require_once('connect_data.php');
    $db_obj = @new mysqli($host,$user,$db_password,$db_name);
    if ($db_obj->connect_errno){
      echo "Błąd podczas rejestracji, proszę spróbować póżniej.";
      exit;
    }
    else{
        $db_obj->set_charset('utf8');
        if($_SESSION['email_flag']){
          $result = $db_obj->query("SELECT id_user FROM users WHERE email='$_POST[email]'");
          $ile=$result->num_rows;
          if($ile>0){
            $_SESSION['flag']=false;
            $_SESSION['email_e']='Istnieje już taki e-mail w bazie';
          }
        }
        if ($_SESSION['flag']) {
          $pass_hash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
          $que="INSERT INTO users VALUES(null, '$_POST[name]', '$_POST[sec_name]', '$_POST[phone_num]', 'u', '$_POST[email]', '$pass_hash')";
          if(!$result=$db_obj->query($que)){
              echo "Błąd zapytania!";
          }
          else {
            header('Location: login.php?login=3');
          }
        }
      }
  }
 ?>

<form action="" method="post">
  <?php
    if(isset($_SESSION['name_e'])){
      echo "<p class='center'>$_SESSION[name_e]</p>";
      unset($_SESSION['name_e']);
    }
  ?>
  <input type="text" name="name" placeholder="Imię" class="login_input" <?php if(isset($_POST['name'])) echo "value='$_POST[name]'" ?> required>

  <?php
    if(isset($_SESSION['sec_name_e'])){
      echo "<p class='center'>$_SESSION[sec_name_e]</p>";
      unset($_SESSION['sec_name_e']);
    }
  ?>
  <input type="text" name="sec_name" placeholder="Nazwisko" class="login_input" <?php if(isset($_POST['sec_name'])) echo "value='$_POST[sec_name]'" ?> required>

  <?php
    if(isset($_SESSION['email_e'])){
      echo "<p class='center'>$_SESSION[email_e]</p>";
      unset($_SESSION['email_e']);
    }
  ?>
  <input type="email" name="email" placeholder="E-mail"  class="login_input" <?php if(isset($_POST['email'])) echo "value='$_POST[email]'" ?> required>

  <?php
    if(isset($_SESSION['phone_num_e'])){
      echo "<p class='center'>$_SESSION[phone_num_e]</p>";
      unset($_SESSION['phone_num_e']);
    }
  ?>
  <input type="text" name="phone_num" placeholder="Numer telefonu" class="login_input" <?php if(isset($_POST['phone_num'])) echo "value='$_POST[phone_num]'" ?> required>

  <?php
    if(isset($_SESSION['pass_e'])){
      echo "<p class='center'>$_SESSION[pass_e]</p>";
      unset($_SESSION['pass_e']);
    }
  ?>
  <input type="password" name="pass1" placeholder="Hasło" class="login_input" required>
  <input type="password" name="pass2" placeholder="Powtórz hasło" class="login_input" required>

  <?php
    if(isset($_POST['submit']))
      if ((!isset($_POST['real_data'])) || (!isset($_POST['regulations'])))
        echo '<p class="center">Wszystkie pola muszą być zaznaczone.</p>';

    ?>
  <div id="checkboxes">
    <input type="checkbox" required name="real_data" id="checkbox" <?php if(isset($_POST['real_data'])) echo "checked" ?>>
    <label for="dane">Oświadczam, że dane podane w formularzu są prawdziwe.</label><br>
    <input type="checkbox" required name="regulations" id="checkbox" <?php if(isset($_POST['regulations'])) echo "checked" ?>>
    <label for="regulations">Oświadczam, że zapoznałem się z regulaminem.</label><br>
    <input id="submit" type="submit" name="submit" value="Zarejestruj się">
  </div>
</form>
