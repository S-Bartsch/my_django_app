<!DOCTYPE html>

<html>
<head>
	<title>Registrieren</title>
	<link rel="Stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="Stylesheet" type="text/css" href="css/styleregistrierenundanmelden.css">
</head>
</html>
<section id="registrieren" class="registrieren">
<form action="" method="post">
    Doch lieber <a href="anmelden.php">anmelden</a>?
    <br>
    <br>
    Deine EMail:<br>
    <input email="email" name="nutzeremail" placeholder="EMail"><br>
    <br>
    Dein Passwort:<br>
    <input type="password" name="nutzerpasswort" placeholder="Passwort"><br>
    Widerhole dein Passwort:<br>
    <input type="password" name="nutzerpasswort_widerholen" placeholder="Passwort"><br>
    <input type="submit" name="absenden" value="Absenden"><br>
</form>
<?php

$db = new mysqli('localhost','Kontaktformular','Kontaktformular132','projektwebanwendung');

if($db->connect_error):
    echo $db->connect_error;
endif;

if(isset($_POST['absenden'])):

    $nutzeremail = $_POST['nutzeremail'];
    $nutzerpasswort = $_POST['nutzerpasswort'];
    $nutzerpasswort_widerholen = $_POST['nutzerpasswort_widerholen'];
/*      //leider habe ich die suche, ob die email bereits genutzt wurde nicht zum laufen bekommen, da beim bind_param ein fehler aufgekommen ist den ich nicht korregieren kann
    $search_user = $db->prepare("SELECT id FROM users WHERE nutzeremail = ?");
    $search_user->bind_param('s',$nutzeremail);
    $search_user->execute();
    $search_result = $search_user->get_result();

    if($search_result->num_rows == 0):
*/
        if($nutzerpasswort == $nutzerpasswort_widerholen):
            $nutzerpasswort = md5($nutzerpasswort); //md5($nutzerpasswort)= bietet mehr sicherheit
            $insert = $db->prepare("INSERT INTO users (nutzeremail,nutzerpasswort) VALUES (?,?)");
            $insert->bind_param('ss',$nutzeremail,$nutzerpasswort);
            $insert->execute();
            if($insert !== false):
                echo 'Dein Account wurde erfolgreich erstellt!';
                echo 'Willst du dich <a href="anmelden.php">anmelden</a>?';
            endif;
        else:
            echo 'Deine Passwörter stimmen nicht überein!';
        endif;
/*    else:
        echo 'Die genutze EMailadresse wurde bereits verwendet!';
        echo 'Willst du dich <a href="anmelden.php">anmelden</a>?';
    endif;
*/
endif;