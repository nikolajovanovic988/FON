<?php
session_start();

include "api/connect.php";

$sql = "SELECT * FROM currency";

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
        function registration() {
            var name = $('#nameReg').val();
            var surname = $('#surname').val();
            var password = $('#passwordReg').val();
            var mail = $('#mail').val();
            var phone = $('#phone').val();
            var currency = $('#currency').val();

			var obj = new Object();
			obj.name = name;
			obj.surname= surname;
			obj.password= password;
            obj.mail = mail;
			obj.phone= phone;
            obj.currency = currency;
			var jsonstring = JSON.stringify(obj);

			$.post("api/registerUser", jsonstring, function (data) {
                console.log(data[0]);
                $('#regResponse').html(data);
			});
        }
    </script>
</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>

    <div class="container">
        <div class="col-lg-3 col-xs-12"></div>
        <div class="col-lg-6 col-xs-12">
            <p>Unesite sve podtake!</p>
            <div id="regResponse"></div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="nameReg" placeholder="Ime..." aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="surname" placeholder="Prezime..." aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                <input type="password" class="form-control" id="passwordReg" placeholder="Šifra..." aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                <input type="email" class="form-control" id="mail" placeholder="E-mail..." aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></span>
                <input type="text" class="form-control" id="phone" placeholder="Telefon..." aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span></span>
                <select type="checkbox" class="form-control" id="currency" placeholder="Valuta..." aria-describedby="basic-addon1">
                    <?php while ($line = $q->fetch_object()) { ?>
                        <option value="<?php echo $line->id; ?>"><?php echo $line->cur; ?></option>
                    <?php }?>
                </select>
            </div>
            <br>
            <button class="btn btn-primary" onclick="registration();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registruj se!</button>
        </div>
        <div class="col-lg-3 col-xs-12"></div>

    </div>
</body>

<script>
/*
    $(document).ready(function() {
        $.post("api/getCurrency", function(data) {
            console.log(data);
            if (data = "greška") {
                $('regResponse').html("<div class='alert alert-danger' >Greška sa bazom!</div>")
            } else {
                currency = JSON.parse(data);
                console.log(currency);
            }
        });
    })*/
</script>

</html>