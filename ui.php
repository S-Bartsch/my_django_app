<?php
// Als Daten müssen folgende nacheinander eingetragen werden
// Host | Meist localhost
// Benutzer | Benutzername der Datenbank
// Passwort | Passwort der Datenbank. Wenn keins vorhanden einfach leer lasssen
// Datenbank | Name der Datenbank
$db = new mysqli('localhost','Kontaktformular','Kontaktformular132','projektwebanwendung');
if($db->connect_error):
  echo $db->connect_error;
endif;

$search_user = $db->prepare("SELECT * FROM users WHERE id = ?");
$search_user->bind_param('i',$_SESSION['user']);
$search_user->execute();
$search_result = $search_user->get_result();

if($search_result->num_rows == 1):
  $search_object = $search_result->fetch_object();

  if(isset($_POST['abmelden'])):
    session_destroy();
    header('Location: /Kontaktformular/');
  endif;

echo 'Willkommen zurück, '.$search_object->benutzername.'!<br>';
echo '<form action="" method="post"><input type="submit" name="abmelden" value="Abmelden"></form>';

endif;
