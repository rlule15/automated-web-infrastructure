<?php
    require_once "resources/php/config.php";
    require_once "resources/php/cars/carclass.php";

    // Ensure that carID is provided in the URL
    if (isset($_GET['id'])) {
        $carID = intval($_GET['id']); // Get carID from the URL and ensure it's an integer
    } else {
        echo "<h2>Car ID is missing.</h2>";
        exit;
    }

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the car image and details from the database
    $sqlImage = "SELECT carImage, carMake, carModel FROM cars WHERE carID = ?";
    $stmtImage = $conn->prepare($sqlImage);
    $stmtImage->bind_param("i", $carID);
    $stmtImage->execute();
    $resultImage = $stmtImage->get_result();

    if ($resultImage->num_rows > 0) {
        $row = $resultImage->fetch_assoc();
        // Create a Car object using the fetched data
        $car = new Car(
            $carID,
            $row['carImage'],
            $row['carMake'],
            $row['carModel'],
            null // Year is not fetched for this context
        );

        // Display only the car image
        echo '<img src="resources/images/' . htmlspecialchars($car->carImage) . '" 
                alt="' . htmlspecialchars($car->carMake . ' ' . $car->carModel) . ' Image" width="200">';
    } else {
        echo "<h2>No image found for the provided Car ID.</h2>";
    }

    $stmtImage->close();
    $conn->close();
?>
