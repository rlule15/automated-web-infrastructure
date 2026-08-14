<?php
    require_once "resources/php/config.php";
    require_once "resources/php/tools.php";
    require_once "carclass.php";

    $conn = new mysqli($hn, $un, $pw, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch car details from the database
    $sql = "SELECT carID, carYear, carMake, carModel, carImage FROM cars";
    $result = $conn->query($sql);

    // Check if there are any cars in the database
    $cars = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ensure the object is created properly using the correct array keys
            $cars[] = new Car(
                $row['carID'], 
                $row['carImage'], 
                $row['carMake'], 
                $row['carModel'], 
                $row['carYear']
            );
        }
    }
    $conn->close();
?>


