<!DOCTYPE html>

<html>
<head>
	<title>Anmelden</title>
	<link rel="Stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="Stylesheet" type="text/css" href="css/styleregistrierenundanmelden.css">
</head>
</html>
<section id="registrieren" class="registrieren">
<form action="" method="post">

  Doch erst <a href="registrieren.php">registrieren?</a>
  <br>
  <br>

  Deine EMail:<br>
  <input type="email" name="nutzeremail" placeholder="EMail"><br>
  Dein Passwort:<br>
  <input type="nutzerpassword" name="nutzerpasswort" placeholder="Passwort"><br>
  <input type="submit" name="absenden" value="Absenden"><br>
</form>
<?php

$db = new mysqli('localhost','Kontaktformular','Kontaktformular132','projektwebanwendung');
if($db->connect_error):
  echo $db->connect_error;
endif;

if(isset($_POST['absenden'])):
  $nutzeremail = strtolower($_POST['nutzeremail']);
  $nutzerpasswort = $_POST['nutzerpasswort'];
  $nutzerpasswort = md5($nutzerpasswort);

  $search_user = $db->prepare("SELECT id FROM users WHERE nutzeremail = ? AND nutzerpasswort = ?");
  $search_user->bind_param('s',$nutzeremail);//$search_user->bind_param('ss',$nutzeremail,$nutzerpasswort);
  $search_user->execute();
  $search_result = $search_user->get_result();

  if($search_result->num_rows == 1):
    $search_object = $search_result->fetch_object();

    $_SESSION['user'] = $search_object->id;
    //header('Location: /tutorials/login/');
      else:
    echo 'Deine Angaben sind leider nicht korrekt!';
  endif;
endif;