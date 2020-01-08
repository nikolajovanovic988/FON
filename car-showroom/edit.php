<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>

</head>

<body>

    <form action="base.php" method="post">
        <input type="hidden" name="driverID" id="driverID" value="">
        <input type="hidden" name="carID" id="carID" value="">
        <input type="hidden" name="carInfoID" id="carInfoID" value="">
        <input type="text" name="carManuf" id="carManuf" value="" required><br>
        <input type="url" name="carPicture" id="carPicture" value="" required><br>
        <input type="text" name="carColor" id="carColor" value="" required><br>
        <input type="number" name="carYear" id="carYear" value="" required><br>
        <input type="number" name="carDors" id="carDors" value="" required><br>
        <input type="text" name="driverN" id="driverN" value="" required><br>
        <input type="text" name="driverSurname" id="driverSurname" value="" required><br>
        <input type="email" name="driverMail" id="driverMail" value="" required><br>
        <input type="text" name="driverPhone" id="driverPhone" value="" required><br>

        <input type="submit" value="Edit">
    </form>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>

<script>
    var drivers;
    var cars;
    var carsinfo;

    // get values for drivers
    $.post("base.php", {
            tableList: "Driver"
        })
        .done(function(data) {
            drivers = JSON.parse(data);
        });

    // get values for cars
    $.post("base.php", {
            tableList: "Car"
        })
        .done(function(data) {
            cars = JSON.parse(data);
        });

    // get values for carsInfo
    $.post("base.php", {
            tableList: "CarInfo"
        })
        .done(function(data) {
            carsinfo = JSON.parse(data);
        });





    setTimeout(function() {

        window.some_variable = '<?= $_GET['driverID'] ?>';

        for (value in drivers) {

            if (drivers[value].DriverID == window.some_variable) {
                document.getElementById("driverID").value = drivers[value].DriverID;
                document.getElementById("driverN").value = drivers[value].Name;
                document.getElementById("driverSurname").value = drivers[value].Surname;
                document.getElementById("driverMail").value = drivers[value].Mail;
                document.getElementById("driverPhone").value = drivers[value].Phone;

                document.getElementById("carManuf").value = cars[findCar(drivers[value].DriverID)].Car;
                document.getElementById("carID").value = cars[findCar(drivers[value].DriverID)].CarID;

                document.getElementById("carInfoID").value = carsinfo[findCarInfo(drivers[value].DriverID)].CarInfoID;
                document.getElementById("carPicture").value = carsinfo[findCarInfo(drivers[value].DriverID)].Picture;
                document.getElementById("carColor").value = carsinfo[findCarInfo(drivers[value].DriverID)].Color;
                document.getElementById("carYear").value = carsinfo[findCarInfo(drivers[value].DriverID)].Year;
                document.getElementById("carDors").value = carsinfo[findCarInfo(drivers[value].DriverID)].Dors;

                
            }

        }

    }, 300);

    // return array position in cars, for driver
    function findCar(driverID) {

        for (value in cars) {
            if (cars[value].DriverID == driverID) {
                return value;
            }
        }

    }

    // return array position in carsInfo, for driver
    function findCarInfo(driverID) {

        let carValue = findCar(driverID);

        for (value in carsinfo) {
            if (carsinfo[value].CarID == cars[carValue].CarID) {
                return value;
            }
        }

    }
</script>

</html>