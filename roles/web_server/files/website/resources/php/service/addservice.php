<?php
    require_once "../tools.php";
    require_once "../config.php";

    // Get carID from the hidden field
    if (isset($_POST['carID'])) {
        $carID = intval($_POST['carID']);
    } else {
        echo "<h2>Car ID is missing.</h2>";
        exit;
    }

    if (isset($_POST['serviceType']) && 
        isset($_POST['serviceDescription']) && 
        isset($_POST['carMileage']) && 
        isset($_POST['serviceMaintenanceDate']
        )) {

        $conn = new mysqli($hn, $un, $pw, $db);

        // Sanitize the input data to prevent SQL injection
        $recordID = null;
        $serviceType = sanitize($conn, $_POST['serviceType']);
        $serviceDescription = sanitize($conn, $_POST['serviceDescription']);
        $carMileage = (int)$_POST['carMileage'];
        $serviceMaintenanceDate = $_POST['serviceMaintenanceDate'];

        $stmt = $conn->prepare('INSERT INTO car_maintenance_issues VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssi', $recordID, $serviceType, $serviceMaintenanceDate, $serviceDescription, $carMileage,  $carID);
        $stmt->execute();
        $stmt->close();

        $conn->close();

        header('Location: ../../../carInfo.php?id=' . $carID);
    }
?>







