<?php
session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
}

include "api/connect.php";

$sql = "SELECT EXTRACT(DAY FROM date) AS day , 
                EXTRACT(MONTH FROM date) AS month, 
                EXTRACT(YEAR FROM date) AS year, 
                amount 
                  FROM transactions";
$q = $conn->query($sql);

$array = array();

while ($line = $q->fetch_object()) {

  $bool = false;

  for ($count = 0; $count < count($array); $count++) {
    if ($array[$count]->day == $line->day && $array[$count]->month == $line->month && $array[$count]->year == $line->year) {
      $array[$count]->amount += $line->amount;
      $bool = true;
    }
  }

  if ($bool) {
    // Do nothing
  } else {
    $array[] = $line;
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



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {
      packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Day", "Zarada", {
          role: "style"
        }],
        <?php for ($count = 0; $count < count($array); $count++) {  ?>
          ["<?php echo "Datum: " . $array[$count]->day . " " . $array[$count]->month . " " . $array[$count]->year; ?>", <?php echo $array[$count]->amount - (($array[$count]->amount * 100) / 102); ?>, 'silver'],
        <?php  } ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
        {
          calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation"
        },
        2
      ]);

      var options = {
        title: "Prikaz zarade banke po danima",
        height: 400,
        bar: {
          groupWidth: "95%"
        },
        legend: {
          position: "none"
        },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
    }
  </script>
</head>

<body style="background-color: 	#b4b2b2">
  <?php include "nav.php"; ?>

  <div class="container">
    <div id="columnchart_values" style="width: 100%; height: 100%;"></div>
  </div>


</body>

</html>