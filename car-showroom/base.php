<?php

    include 'controller.php';

    if (isset($_POST['tableList'])) {

        $controller->getTableList($_POST['tableList']);

    } else if (isset($_POST['tableRow'])){

    } else if (isset($_POST['carManufacturer'])){

        $controller->addCarInfo($controller->addNewCar($_POST['driverID'], $_POST['carManufacturer'])
                                , $_POST['carColor'], $_POST['carYear'], $_POST['carDors'], $_POST['carPicture']);

        header("Location: http://localhost/AcademyExam/all_cars.php", true, 301);
        exit();

    } else if (isset($_POST['driverName'])){

        $controller->addDriver($_POST['driverName'], $_POST['driverSurname'], $_POST['driverMail'], $_POST['driverPhone']);

        header("Location: http://localhost/AcademyExam/drivers.php", true, 301);
        exit();

    } else if (isset($_POST['driverID'])){

        $carID = $_POST['carID'];
        $carManufacturer = $_POST['carManuf'];
        $controller->updateCar($carID, $carManufacturer);

        $carInfoID = $_POST['carInfoID'];
        $carPicture = $_POST['carPicture'];
        $carColor = $_POST['carColor'];
        $carYear = $_POST['carYear'];
        $carDors = $_POST['carDors'];
        $controller->updateCarInfo($carInfoID, $carColor, $carYear, $carDors, $carPicture);

        $driverID = $_POST['driverID'];
        $driverName = $_POST['driverN'];
        $driverSurname = $_POST['driverSurname'];
        $driverMail = $_POST['driverMail'];
        $driverPhone = $_POST['driverPhone'];
        $controller->updateDriver($driverID, $driverName, $driverSurname, $driverMail, $driverPhone);
        
        header("Location: http://localhost/AcademyExam/index.php", true, 301);
        exit();

    } else if (isset($_GET['carValue'])){

        $controller->selectCar($_GET['carValue']);

    } else if (isset($_GET['allValue'])){

        $controller->selectAll($_GET['allValue']);

    }


    

?>