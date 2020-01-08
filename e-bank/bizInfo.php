<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}

$xml=simplexml_load_file("http://www.b92.net/info/rss/biz.xml");

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

</head>

<body style="background-color: 	#b4b2b2">
    <?php include "nav.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron">
					<h1 class="display-4">BIZ INFO</h1>
					<p class="lead">Sve informacije na jednom mestu!</b></p>
					<hr class="my-4">
					<p>Osvezeno: <?php echo $xml->channel->pubDate; ?></p>
				</div>
			</div>
		</div>
		<?php 
			foreach ($xml->channel->item as $i) {
				?>
					<div class="row well">
						<div class="col-lg-12">
							<h1>
								<?php echo $i->title; ?>
							</h1>
							<p><?php echo $i->description; ?></p>
							<a class="btn btn-block btn-primary" target="_blank" href="<?php echo $i->link; ?>"> Otvori vest</a>
						</div>
					</div>
				<?php
			}
		 ?>
	</div>

	
	
</body>

</html>