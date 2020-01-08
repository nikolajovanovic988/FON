<?php


    class Controller {
        
        // Get table list
        function getTableList($table){

            include 'connect.php';
            $sql="SELECT * FROM $table";
	        $q=$conn->query($sql);
	        $niz = array();
	        while($red=$q->fetch_object()) {
		        $niz[] = $red;
	        }
	
	        echo json_encode($niz);
	        return false;
        }

        // Delete table row
        function deleteRow($table, $id, $column){
            include 'connect.php';
            $sql="DELETE FROM $table WHERE $column='$id';";
	        $conn->query($sql);
        }

        // Get Car and CarInfo select
        function selectCar($value){
            include 'connect.php';
            $sql="SELECT * FROM CarInfo, Car WHERE (Car LIKE '%$value%' OR Color LIKE '%$value%' OR Year LIKE '%$value%' OR Dors LIKE '%$value%') AND (Car.CarID = CarInfo.CarID);";
	        $q=$conn->query($sql);
	        $niz = array();
	        while($red=$q->fetch_object()) {
		        $niz[] = $red;
	        }
	
	        echo json_encode($niz);
	        return false;
        }

        // Get All Select
        function selectAll($value){
            include 'connect.php';
            $sql="SELECT * FROM CarInfo, Car, Driver WHERE (Phone LIKE '%$value%' OR Mail LIKE '%$value%' OR Surname LIKE '%$value%' OR Name LIKE '%$value%' 
                                                            OR Car LIKE '%$value%' 
                                                            OR Color LIKE '%$value%' OR Year LIKE '%$value%' OR Dors LIKE '%$value%') 
                                                            AND (Car.CarID = CarInfo.CarID) 
                                                            AND (Car.DriverID = Driver.DriverID);";
	        $q=$conn->query($sql);
	        $niz = array();
	        while($red=$q->fetch_object()) {
		        $niz[] = $red;
	        }
	
	        echo json_encode($niz);
	        return false;
        }
        
        // Get table row
        function getTableRow($table, $id, $column){
            include 'connect.php';
            $sql="SELECT * FROM $table WHERE $column = $id";
	        $q=$conn->query($sql);
	        $niz = array();
	        while($red=$q->fetch_object()) {
		        $niz[] = $red;
	        }
	
	        echo json_encode($niz);
	        return false;
        }

        // Insert into Car table new values
        function addNewCar($driverID, $car){
            include 'connect.php';
            $sql="INSERT INTO Car (DriverID, Car)
            VALUES ('$driverID', '$car');";
            $conn->query($sql);
            
            $sql = "SELECT CarID FROM Car WHERE DriverID = '$driverID' AND Car = '$car'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            return $row["CarID"];


        }
      
        // Insert into CarInfo table new values
        function addCarInfo($carID, $color, $year, $dors, $picture){
            include 'connect.php';
            $sql="INSERT INTO CarInfo (CarID, Color, Year, Dors, Picture)
            VALUES ('$carID', '$color', '$year', '$dors', '$picture');";
	        $conn->query($sql);
        }

        // Insert into Driver table new values
        function addDriver($name, $surname, $mail, $phone){
            include 'connect.php';
            $sql="INSERT INTO Driver (Name, Surname, Mail, Phone)
            VALUES ('$name', '$surname', '$mail', '$phone');";
	        $conn->query($sql);
        }

        // Update
        function updateDriver($driverID, $name, $surname, $mail, $phone){
            include 'connect.php';
            $sql="UPDATE Driver
                SET Name = '$name', Surname= '$surname', Mail = '$mail', Phone = '$phone'
                WHERE DriverID = $driverID;";
	        $conn->query($sql);
        }
        function updateCar($carID, $car){
            include 'connect.php';
            $sql="UPDATE Car
                SET Car = '$car'
                WHERE CarID = $carID;";
	        $conn->query($sql);
        }
        function updateCarInfo($carInfoID, $color, $year, $dors, $picture){
            include 'connect.php';
            $sql="UPDATE CarInfo
                SET Color = '$color', Year = '$year', Dors = '$dors', Picture = '$picture'
                WHERE CarInfoID = $carInfoID;";
	        $conn->query($sql);
        }
    }


    $controller = new Controller();
?>