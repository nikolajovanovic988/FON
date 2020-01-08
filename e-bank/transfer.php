<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}
include "api/connect.php";
$userid=$_SESSION['userId'];

$sql = "SELECT accounts.*, users.*, currency.cur FROM users 
    JOIN accounts ON accounts.id = users.account_id 
    JOIN currency ON currency.id = accounts.currency_id WHERE users.id !='$userid'";

$table = $conn->query($sql);

$sql1 = "SELECT * FROM currency";

$currencyOption = $conn->query($sql1);

function getCurValue($cur)
{
    $konvertor = file_get_contents("https://api.exchangeratesapi.io/latest");
    $konvertor = json_decode($konvertor);

    if ($cur == "USD"){
        $dollar_rate = 119 / ($konvertor->rates->USD);
        return round($dollar_rate, 2);
        
    } else if ($cur == "CHF"){
        $chf_rate = 119 / ($konvertor->rates->CHF);
        return round($chf_rate, 2);
    } else {
        return 1;
    }
}


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
        function search() {

            var name = $('#name').val();

            $.post('search.php', {
                name: name
            }, function(data) {
                $('#response').html(data);
            });
        }

        function transfer(id, cur) {
            var account_id = id;
            var amount = $('#amount' + account_id + '').val();

            var obj = new Object();
            obj.account_id = account_id;
            obj.amount = amount;
            obj.cur = cur;
            var jsonstring = JSON.stringify(obj);
            console.log(jsonstring);
            $.post("api/transferMoney", jsonstring, function(data) {
                $('#tranResponse').html(data[0]);
                $('#amount' + account_id + '').val('');
            });
        }
    </script>

</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>

    <div class="container">
        <h3>Banka uzima 2%</h3>
        <div class="col-lg-8 col-xs-12">
            <div id="tranResponse"></div>
            <div id="response">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Mail</th>
                            <th>Broj Računa</th>
                            <th>Valuta kor.</th>
                            <th>Iznos</th>
                            <th>Kurs</th>
                            <th>Prebaci novac</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($line = $table->fetch_object()) {  ?>
                            <tr>
                                <td><?php echo $line->account_id; ?></td>
                                <td><?php echo $line->name; ?></td>
                                <td><?php echo $line->surname; ?></td>
                                <td><?php echo $line->mail; ?></td>
                                <td><?php echo $line->number; ?></td>
                                <td><?php echo $line->cur; ?></td>
                                <td><input type="text" name="amount" id="amount<?php echo $line->account_id; ?>" size="4"></td>
                                <td><?php echo getCurValue($line->cur); ?></td>
                                <td><button onclick="transfer(<?php echo $line->account_id; ?>, <?php echo getCurValue($line->cur); ?>)">Pošalji</button></td>
                            </tr>
                        <?php  } ?>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12">
            <p>Unesite ime korisnika</p>
            <div class="form-group">
                <label for="exampleInputPassword1">Ime:</label>
                <input type="text" class="form-control" id="name" placeholder="Ime...">
            </div>

            <button onclick="search();" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pretrazi</button>
        </div>

    </div>


</body>

</html>