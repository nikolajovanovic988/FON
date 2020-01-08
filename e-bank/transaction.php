<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}

include "api/connect.php";

$userid=$_SESSION['userId'];

$sql = "SELECT users.name, users.surname, transactions.id, transactions.recipient_id, transactions.amount, transactions.date 
    FROM transactions 
        JOIN accounts on accounts.id = transactions.sender_id JOIN users ON users.account_id=accounts.id WHERE users.id='$userid'";

$table = $conn->query($sql);

$array=array();
while ($line=$table->fetch_object()){
	$array[] = $line;
}

$length = count($array);
for ($i = 0; $i < $length; $i++) {
    $rec = $array[$i]->recipient_id;
    $array[$i]->recipient_id = getRecipient($rec);
}

function getRecipient($recipient){
    include "api/connect.php";

    $sql = "SELECT name, surname FROM users WHERE id = '$recipient'";

  

        if ($q = $conn->query($sql)){
            $obj = $q->fetch_object();
            if (isset($obj->name)){
                $name = $obj->name . " " . $obj->surname;
                return $name;
            } else {
                return "Korisnik Izbrisan";
            }
            
        } else {
            return "Greska sa bazom";
        };  
};

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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	

</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>

	<div class="container">
		<table id="example" class="display" width="100%"></table>
	</div>
    
</body>

<script type="text/javascript">
	var dataSet = [
    <?php foreach($array as $value) {?>
        [
            "<?php echo $value->id; ?>",
            "<?php echo $value->name . " " . $value->surname; ?>",
            "<?php echo $value->recipient_id; ?>", 
            "<?php echo $value->amount; ?>", 
            "<?php echo $value->date; ?>" 
        ],
    <?php }; ?>
];
 
$(document).ready(function() {
    $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "Br. transakcije" },
            { title: "Posiljalac" },
            { title: "Primalac" },
            { title: "Iznos" },
            { title: "Datum" },
        ]
    } );
} );
</script>

</html>