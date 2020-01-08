<?php 

?>

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

        <div id="dataContainer" class="pt-3">
            <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name
                        </th>
                        <th class="th-sm">Surname
                        </th>
                        <th class="th-sm">Mail
                        </th>
                        <th class="th-sm">Phone
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name
                        </th>
                        <th>Surname
                        </th>
                        <th>Mail
                        </th>
                        <th>Phone
                        </th>
                    </tr>
                </tfoot>
            </table>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Driver</button>

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
                                <input type="text" name="driverName" placeholder="Name" required><br>
                                <input type="text" name="driverSurname" placeholder="Surname" required><br>
                                <input type="email" name="driverMail" placeholder="Mail" required><br>
                                <input type="text" name="driverPhone" placeholder="Phone" required><br>
                                <input type="submit" value="Add">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>


    <script>
        var drivers;
        // get values for drivers
        $.post("base.php", {
                tableList: "Driver"
            })
            .done(function(data) {
                drivers = JSON.parse(data);
            });

        setTimeout(function() {

            for (value in drivers) {

                var table = $('#selectedColumn').DataTable();

                table.row.add([
                    drivers[value].Name,
                    drivers[value].Surname,
                    drivers[value].Mail,
                    drivers[value].Phone
                ]).draw(false);

            }

        }, 300);


        $(document).ready(function() {
            $('#selectedColumn').DataTable();

        });
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