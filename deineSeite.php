<!DOCTYPE html>

<html>
<head>
	<title>Kontakt-Formular</title>
	<link rel="Stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="Stylesheet" type="text/css" href="css/styleDeineSeite.css">
</head>
<body>

<section id="contact" class="contact">
<div class="container large">
	<div class="title">
		<h2>Deine Seite</h2>
		<p>Hier koennen Sie neue Anfragen stellen und ihre bereits versandten Nachrichten einsehen.</p>
	</div>
	<div class="row input">
		<div class="col-md-6">
			<ul class="list-unstyled">

		</div>
		<div class="col-md-6">
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=projektwebanwendung', 'Kontaktformular', 'Kontaktformular132');

        $sql = "SELECT nachricht from tbl_kontaktformular WHERE test@test.de = EMail";

        foreach ($pdo->query($sql) as $row) {
            echo $row['Name']." ".$row['EMail']."<br>";
            echo "Nachricht: ".$row['Nachricht']." ".$row['Datum']."<br>";
        }
?>

			<form action="index.php"method="POST">
				<fieldset>
				<legend>Daten eingeben</legend>
					<label>Name</label>
					<div class="row">
						<div class="col-md-7">
							<input type="text" name="name" class="form-control" autofocus>
						</div>
					</div>
					<label>Email <span class="yellow">*</span></label>
					<div class="row">
						<div class="col-md-7">
							<input type="email" name="email" class="form-control" required>
						</div>
					</div>
					<label>Nachricht <span class="yellow">*</span></label>
					<div class="row">
						<div class="col-md-11">
							<textarea rows="8" name="nachricht" class="form-control" required></textarea>
						</div>
					</div>
					<p>
						<button type="submit" name="abschicken" class="btn">Abschicken</button>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</section>
</body>
</html>
<?php

    if(isset($_POST['abschicken']))
    {

       require("include/db_connect.php");
       $name = $_POST['name'];
       $email = $_POST['email'];
       $nachricht = $_POST['nachricht'];
       $datum = date("Y-m-d H:i:s");

       echo "Hallo " . $name;
       echo "<br>";
       echo "Sie haben Ihre Nachricht abgeschickt: " . $nachricht;
       echo "<br>";
       echo "E-Mail: " . $email;
       echo "<br>";
       echo "<br>";
       echo "Vielen Dank, wir werden uns schnellstmöglich melden.";

		$sql = "INSERT INTO tbl_kontaktformular(Name, EMail, Nachricht, Datum) VALUES (:name, :email, :nachricht, :datum)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':nachricht', $nachricht);
		$stmt->bindValue(':datum', $datum);

		$stmt->execute();

   }
?>