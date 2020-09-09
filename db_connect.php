<?PHP
$user= "Kontaktformular";
$pass = "Kontaktformular132";

try
{
	$dbh = new PDO('mysql:host=localhost;dbname=projektwebanwendung;charset=utf8', $user, $pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>