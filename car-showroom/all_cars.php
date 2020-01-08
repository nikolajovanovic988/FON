<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include 'nav.php' ?>

        <div class="w-100">
            <img class="mySlides" src="https://www.hvwautoacparts.com/data/watermark/20180919/5ba20e1d6ead0.jpg" style="width:100%">
            <img class="mySlides" src="http://www.directoryofdestinations.com/wp-content/uploads/2018/11/Saintes-general-view-1920x535.jpg" style="width:100%">
            <img class="mySlides" src="https://cdn.needacar.co.nz/nac/banner/1920x535.jpg" style="width:100%">
        </div>

        <div class="col-12 mt-3">

            <form class="form-inline my-2 my-lg-0 float-left">
                <input class="form-control mr-sm-2 " type="text" placeholder="Search" id="search" onkeyup="searchInput()" size="35">
            </form>

            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal" onclick="addOptions()">Add Car</button>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Driver</h4>
                        </div>
                        <div class="modal-body">
                            <form action="base.php" method="post">
                                <input type="text" name="carManufacturer" placeholder="Manufacturer" required><br>
                                <input type="url" name="carPicture" placeholder="Image URL Location" required><br>
                                <input type="text" name="carColor" placeholder="Color" required><br>
                                <input type="number" name="carYear" placeholder="Year" required><br>
                                <input type="number" name="carDors" placeholder="Number of Dors" required><br>
                                <p>Driver:</p><select name="driverID" id="myDropdown" required>

                                </select><br>
                                <input type="submit" value="Add" class="mt-3">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="dataContainer">


        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        var cars;
        // get values for cars
        $.post("base.php", {
                tableList: "Car"
            })
            .done(function(data) {
                cars = JSON.parse(data);
            });

        var carsinfo;
        // get values for carsInfo
        $.post("base.php", {
                tableList: "CarInfo"
            })
            .done(function(data) {
                carsinfo = JSON.parse(data);
            });


        var drivers;
        // get values for drivers
        $.post("base.php", {
                tableList: "Driver"
            })
            .done(function(data) {
                drivers = JSON.parse(data);
            });

        function addOptions() {

            var div = $("#myDropdown").html('');

            for (value in drivers) {

                div.append('<option value="' + drivers[value].DriverID + '">' + drivers[value].Name + ' ' + drivers[value].Surname + ' - ' + drivers[value].Mail + '</option>');
            }

            document.getElementById("myDropdown").selectedIndex = -1;
        }

        function searchInput() {
            var val = $('#search').val();

            var div = $("#dataContainer").html('');

            searchRequest = $.ajax({
                type: "GET",
                url: "base.php",
                data: {
                    carValue: val
                },
                dataType: "text",

                success: function(response) {
                    var searchValues = JSON.parse(response)

                    for (value in searchValues) {

                        div.append(
                            '<div class = "pb-3 pt-3 row col-12"> ' +
                            '<div class = "col-5">' +
                            '<img src="' + searchValues[value].Picture + '" class = "w-100" alt="">' +
                            '</div>' +
                            '<div class = "col-5 mt-3"> ' +
                            '<p> <b>Car:</b> ' + searchValues[value].Car + ' </p> ' +
                            '<p> <b>Year:</b> ' + searchValues[value].Year + ' <b>Color:</b>  ' + searchValues[value].Color + '</p> ' +
                            '<b>Dors:</b>  ' + searchValues[value].Dors + '</p> ' +
                            '</div>' +
                            '<div class = "col-2 mt-3"> ' +
                            '</div>' +
                            '</div>');
                    }
                }
            });

        }

        setTimeout(function() {



            var div = $("#dataContainer").html('');

            for (value in cars) {

                div.append(
                    '<div class = "pb-3 pt-3 row col-12"> ' +
                    '<div class = "col-5">' +
                    '<img src="' + carsinfo[findCarInfo(cars[value].CarID)].Picture + '" class = "w-100" alt="">' +
                    '</div>' +
                    '<div class = "col-5 mt-3"> ' +
                    '<p> <b>Car:</b> ' + cars[value].Car + ' </p> ' +
                    '<p> <b>Year:</b> ' + carsinfo[findCarInfo(cars[value].CarID)].Year + ' <b>Color:</b>  ' + carsinfo[findCarInfo(cars[value].CarID)].Color + '</p> ' +
                    '<b>Dors:</b>  ' + carsinfo[findCarInfo(cars[value].CarID)].Dors + '</p> ' +
                    '</div>' +
                    '<div class = "col-2 mt-3"> ' +
                    '</div>' +
                    '</div>');
            }

        }, 300);

        // return array position in carsInfo, for car
        function findCarInfo(carID) {

            for (value in carsinfo) {
                if (carsinfo[value].CarID == carID) {
                    return value;
                }
            }

        }
    </script>

    <!-- For pictures, time switch -->
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000);
        }
    </script>

</body>

</html>