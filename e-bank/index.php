<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}

include "api/connect.php";

$user_id = $_SESSION['userId'];

$sql = "SELECT users.name, users.surname, accounts.number, accounts.date, accounts.amount, currency.cur 
FROM users 
	JOIN accounts ON users.account_id = accounts.id 
	JOIN currency ON currency.id = accounts.currency_id
		WHERE users.id = $user_id";

$q = $conn->query($sql);
$user = $q->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-banking</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4">Zdravo,<?php echo $user->name ." " . $user->surname; ?>!</h1>
			<p class="lead">Tvoj broj računa je: <b><?php echo $user->number?></b> . Registrovan: <b><?php echo $user->date?></b></p>
			<hr class="my-4">
			<p>Trenutni status na tvom računu je: <b><?php echo $user->amount?> <?php echo $user->cur?></b></p>
			<p>Procenat banke je 2%</p>
			<p class="lead">
			</p>
		</div>
	</div>

	
	
</body>

</html>