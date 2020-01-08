<?php
require 'flight/Flight.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$json_data = file_get_contents("php://input");
Flight::set('json_data', $json_data);



Flight::route('/', function () {
	echo "Hello World!";
});

Flight::route('POST /login', function () {
	session_start();
	include "connect.php";
	header("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');
	$data_json = Flight::get("json_data");
	$data = json_decode($data_json);
	if ($data == null) {
		responseError("Nema podataka.");
	} else {

		if (!property_exists($data, 'name')) {
			responseError("Pogrešni podaci prosleđeni.");
		} else {
			$name = $conn->real_escape_string($data->name);
			$password = $conn->real_escape_string($data->password);

			if (empty($name) || empty($password)) {
				responseError("Popunite oba polja");
			} else {
				$password = md5($password);

				$sql = "SELECT * FROM users where password = '$password' AND name = '$name'";

				if ($q = $conn->query($sql)) {

					if(mysqli_num_rows($q)>0) {
						$line = $q->fetch_object();

						$_SESSION['userId'] = $line->id;
						$_SESSION['userName'] = $line->name;
						$_SESSION['userAdmin'] = $line->admin;
						$_SESSION['userAccount'] = $line->account_id;

						$array = array("success");
						$json_response = json_encode($array, JSON_UNESCAPED_UNICODE);
						echo $json_response;
						return false;
					} else {
						responseError("Pogresan username i password");
					}
				} else {
					responseError("Greška sa bazom!");
				}
			}
		}
	}
});

Flight::route('POST /registerUser', function () {
	session_start();
	include "connect.php";
	header("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');
	$data_json = Flight::get("json_data");
	$data = json_decode($data_json);
	if ($data == null) {
		responseError("Nema podataka.");
	} else {
		if (!property_exists($data, 'name')) {
			responseError("Pogrešni podaci prosleđeni.");
		} else {
			$name = $conn->real_escape_string($data->name);
			$surname = $conn->real_escape_string($data->surname);
			$mail = $conn->real_escape_string($data->mail);
			$phone = $conn->real_escape_string($data->phone);
			$password = $conn->real_escape_string($data->password);

			if (empty($name) || empty($surname) || empty($password) || empty($mail) || empty($phone)) {
				responseError("Sva polja moraju biti popunjena.");
				
			} else {
				$password = md5($password);
				$number = rand(100,1000) . "-" . rand(1000000,10000000) . "-" .rand(10,100);
				$currency_id = $conn->real_escape_string($data->currency);

				$sql = "INSERT INTO accounts(number, date, 	currency_id) VALUES ('$number', NOW(), '$currency_id')";

				if ($q1 = $conn->query($sql)) {

					$korisnik_id = $conn->insert_id;

					
					$sql1 = "INSERT INTO users (name, surname, mail, phone, password, 	account_id) 
							VALUES ('" . $name . "', '" . $surname . "', '" . $mail . "', '" . $phone . "', '" . $password . "', '" . $korisnik_id . "')";
					if ($q = $conn->query($sql1)) {
						responseSuccess("Uspesno ste se registrovali! Sada je potrebno da se prijavite.");
					} else {
						responseError("Greška sa bazom!");
					}

				} else {
					responseError("Greška sa bazom accounts!");
				}
				
			}
		}
	}
});

Flight::route('POST /transferMoney', function () {
	session_start();
	include "connect.php";
	header("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');
	$data_json = Flight::get("json_data");
	$data = json_decode($data_json);
	if ($data == null) {
		responseError("Nema podataka.");
	} else {
		if (!property_exists($data, 'amount')) {
			responseError("Pogrešni podaci prosleđeni.");
		} else {
			$account_id = $conn->real_escape_string($data->account_id);
			$amount = $conn->real_escape_string($data->amount);
			$curVal = $conn->real_escape_string($data->cur);

			if (empty($account_id) || empty($amount)) {
				responseError("Sva polja moraju biti popunjena.");
				
			} else if (!is_numeric($amount)){
				responseError("Iznos mora biti broj!");
			} else {

				$user_account_id = $_SESSION['userAccount'];
				$sql = "SELECT * FROM accounts WHERE id = '$user_account_id'";

				

				if ($q = $conn->query($sql)) {

					$line = $q->fetch_object();
					$newAmount = $line->amount - ($amount * 1.02);

					$sql1 = "UPDATE accounts SET amount = '$newAmount' WHERE id = '$user_account_id'";

					if ($q1 = $conn->query($sql1)) {

						$sql2 = "SELECT * FROM accounts WHERE id = '$account_id'";


						

						if ($q2 = $conn->query($sql2)) {
							$line1 = $q2->fetch_object();
							$newAmount1 = $line1->amount + $amount;

							$sql3 = "UPDATE accounts SET amount = '$newAmount1' WHERE id = '$account_id'";

							if ($q3 = $conn->query($sql3)) {

								$sql4 = "SELECT * FROM users WHERE account_id = $account_id";
								$q4 = $conn->query($sql4);
								$line2 = $q4->fetch_object();
								$recipient_id = $line2->id;

								setTransaction($user_account_id, $recipient_id, $amount);

								responseSuccess("Novac uspešno poslat");
							} else {
								responseError("Greška sa bazom!");
							}
							
						} else {
							responseError("Greška sa bazom!");
						}

					} else {
						responseError("Greška sa bazom!");
					}

				} else {
					responseError("Greška sa bazom!");
				}
				
			}
		}
	}
});
/*
Flight::route('GET /getCurrency', function ($rsd) {
	session_start();
	include "connect.php";
	header("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');

	$sql = "SELECT * FROM currency";

	if ($q = $conn->query($sql)) {
		$array = array();
		while ($line = $q->fetch_object()) {
			$array[] = $line;
		}
		echo json_encode($array);
		return false;
	} else {
		$array = array("greška");
		echo json_encode($array);
		return false;
	}
});
*/
function responseError($res)
{
	$array = array("<div class='alert alert-danger'>$res</div>");
	$json_response = json_encode($array, JSON_UNESCAPED_UNICODE);
	echo $json_response;
	return false;
}

function responseSuccess($res)
{
	$array = array("<div class='alert alert-success'>$res</div>");
	$json_response = json_encode($array, JSON_UNESCAPED_UNICODE);
	echo $json_response;
	return false;
}

function setTransaction($sender_id, $recipient_id, $amount)
{
	include "connect.php";
	$sql = "INSERT INTO transactions(sender_id, recipient_id, amount, date) 
			VALUES ('$sender_id', '$recipient_id', '$amount', NOW())";
	$conn->query($sql);
}





Flight::start();
