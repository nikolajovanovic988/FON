<?php
    session_start();

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
        function login(){

            var name = $('#name').val();
            var password = $('#password').val();

			var obj = new Object();
			obj.name = name;
			obj.password= password;
			var jsonstring = JSON.stringify(obj);

			$.post("api/login", jsonstring, function (data) {
                if (data == "success"){
                    window.location.assign("index.php");
                } else {
                    $('#logResponse').html(data);
                }
			});
        }
    </script>
</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>
        
    <div class="container">
        <div class="col-lg-3 col-xs-12"></div>
        <div class="col-lg-6 col-xs-12">
            <p>Unesite ime i šifru!</p>
            <div id="logResponse"></div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="name" placeholder="Ime..." aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id="password" placeholder="Šifra..." aria-describedby="basic-addon1">
            </div>
            <br>
            <button class="btn btn-primary" onclick="login();"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Login!</button>
        </div>
        <div class="col-lg-3 col-xs-12"></div>

    </div>
</body>

</html>