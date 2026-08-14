<?php
    require_once "../config.php";

    // Capture the form data
    $recordID = intval($_POST['recordID']);
    $serviceDescription = $_POST['serviceDescription'];
    $serviceMileage = $_POST['serviceMileage'];
    $carid = intval($_POST['id']); // This should be $carid, since you're passing it as 'id' from the form

    // Create a new database connection
    $conn = new mysqli($hn, $un, $pw, $db);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to update the record
    $sql = "UPDATE car_maintenance_issues SET serviceDescription = ?, serviceMileage = ? WHERE recordID = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("sii", $serviceDescription, $serviceMileage, $recordID);

    $stmt->execute();
    header("Location: ../../../carInfo.php?id=$carid"); // Pass carID to the next page

    $stmt->close();
    $conn->close();
?>
