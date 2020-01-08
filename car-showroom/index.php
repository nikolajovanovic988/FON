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

        <div class="col-12">
            <form class="form-inline my-2 my-lg-0 pt-3">
                <input class="form-control mr-sm-2 " type="text" placeholder="Search" id="search" onkeyup="searchInput()" size="35">
            </form>
        </div>

        <div id="dataContainer">
    
        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


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


            function searchInput() {
            var val = $('#search').val();

            var div = $("#dataContainer").html('');

            searchRequest = $.ajax({
                type: "GET",
                url: "base.php",
                data: {
                    allValue: val
                },
                dataType: "text",

                success: function(response) {
                    var searchValues = JSON.parse(response)
                    console.log(searchValues);

                    for (value in searchValues) {

                        div.append(
                            '<div class = "pb-3 pt-3 row"> ' +
                                '<div class = "col-5">' +
                                    '<img src="' + searchValues[value].Picture + '" class = "w-100" alt="">' +
                                '</div>' +
                                '<div class = "col-5 mt-3"> ' +
                                    '<p> <b>Driver:</b> ' + searchValues[value].Name + ' ' + searchValues[value].Surname + ' </p> ' +
                                    '<p> <b>Mail:</b> ' + searchValues[value].Mail + ' <b>Phone:</b> ' + searchValues[value].Phone + ' </p> ' +
                                    '<p> <b>Car:</b> ' + searchValues[value].Car + ' </p> ' +
                                    '<p> <b>Year:</b> ' + searchValues[value].Year + ' <b>Color:</b>  ' + searchValues[value].Color + '</p> ' +
                                    '<b>Dors:</b>  ' + searchValues[value].Dors + '</p> ' +
                                '</div>' +
                                '<div class = "col-2 mt-3"> ' +
                                    '<button type="button" class="btn btn-primary" id="id'+ searchValues[value].DriverID +'" >Edit</button>' +
                                '</div>' +
                            '</div>');

                            var id = searchValues[value].DriverID;
                            var ev= "#id";
                            var concat = ev.concat(id);
                            document.querySelectorAll(concat).forEach(item => {
                                item.addEventListener('click', event => {
                                    
                                    var str = item.id.substring(2, item.id.length)
            
                                    window.location = 'http://localhost/AcademyExam/edit.php?driverID=' + str;
                                })
                            }); 
                    }
                }
            });

        }

        setTimeout(function() {

            var div = $("#dataContainer").html('');

            for (value in drivers) {

                div.append(
                    '<div class = "pb-3 pt-3 row"> ' +
                        '<div class = "col-5">' +
                            '<img src="' + carsinfo[findCarInfo(drivers[value].DriverID)].Picture + '" class = "w-100" alt="">' +
                        '</div>' +
                        '<div class = "col-5 mt-3"> ' +
                            '<p> <b>Driver:</b> ' + drivers[value].Name + ' ' + drivers[value].Surname + ' </p> ' +
                            '<p> <b>Mail:</b> ' + drivers[value].Mail + ' <b>Phone:</b> ' + drivers[value].Phone + ' </p> ' +
                            '<p> <b>Car:</b> ' + cars[findCar(drivers[value].DriverID)].Car + ' </p> ' +
                            '<p> <b>Year:</b> ' + carsinfo[findCarInfo(drivers[value].DriverID)].Year + ' <b>Color:</b>  ' + carsinfo[findCarInfo(drivers[value].DriverID)].Color + '</p> ' +
                            '<b>Dors:</b>  ' + carsinfo[findCarInfo(drivers[value].DriverID)].Dors + '</p> ' +
                        '</div>' +
                        '<div class = "col-2 mt-3"> ' +
                            '<button type="button" class="btn btn-primary" id="id'+ drivers[value].DriverID +'" >Edit</button>' +
                        '</div>' +
                    '</div>');

                    var id = drivers[value].DriverID;
                    var ev= "#id";
                    var concat = ev.concat(id);
                    document.querySelectorAll(concat).forEach(item => {
                        item.addEventListener('click', event => {
                            
                            var str = item.id.substring(2, item.id.length)
	
                            window.location = 'http://localhost/AcademyExam/edit.php?driverID=' + str;
                        })
                    }); 
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