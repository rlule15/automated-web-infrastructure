<?php
    require_once "resources/php/config.php";
    require_once "resources/php/cars/carclass.php";

    // Ensure that carID is provided in the URL
    if (isset($_GET['id'])) {
        $carID = intval($_GET['id']);  // Get carID from the URL and ensure it's an integer
    } else {
        echo "<div id='currentCar'><h1>Car ID is missing.</h1></div>";
        exit;
    }

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch car details (year, make, and model) from the database
    $sql = "SELECT carYear, carMake, carModel FROM cars WHERE carID = ?";
    $stmtCar = $conn->prepare($sql);
    $stmtCar->bind_param("i", $carID);
    $stmtCar->execute();
    $resultCar = $stmtCar->get_result();

    if ($resultCar->num_rows > 0) {
        $row = $resultCar->fetch_assoc(); // Fetch the result as an associative array
        $car = new Car(
            $carID,
            null, // No image required for this context
            $row['carMake'],
            $row['carModel'],
            $row['carYear']
        );
        echo '<div id="currentCar">
                <h1>Current Car:</h1>
                <h1>' . htmlspecialchars($car->carYear) . ' ' . 
                    htmlspecialchars($car->carMake) . ' ' . 
                    htmlspecialchars($car->carModel) . '</h1>
            </div>';
    } else {
        echo "<div id='currentCar'><h1>No car found for the provided Car ID.</h1></div>";
    }

    $stmtCar->close();
    $conn->close();
?>
