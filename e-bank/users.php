<?php
session_start();

include "api/connect.php";

$user_id = $_SESSION['userId'];

$sql = "SELECT * FROM users";

$q = $conn->query($sql);

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

    <script>
        function del(id){
            console.log(id);
            $.post('scriptDeleteUser.php', {
				id: id
			}, function(data) {
				$('#response').html(data);
                if (data){
                    $('#responseDelete').html("<div class='alert alert-success' >Korisnik je izbrisan</div>");
                }
                
			});
        }
    
    </script>
</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>	
    <div class="container">
        <div id="responseDelete"></div>
            <div id="response">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Mail</th>
                            <th>Kontakt</th>
                            <th>Izbriši</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($line = $q->fetch_object()) {  ?>
                            <tr>
                                <td><?php echo $line->id; ?></td>
                                <td><?php echo $line->name; ?></td>
                                <td><?php echo $line->surname; ?></td>
                                <td><?php echo $line->mail; ?></td>
                                <td><?php echo $line->phone; ?></td>
                                <td><button onclick="del(<?php echo $line->id; ?>)">izbriši</button></td>
                            </tr>
                        <?php  } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>

</html>