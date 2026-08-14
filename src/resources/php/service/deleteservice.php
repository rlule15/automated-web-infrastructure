<?php
    require_once "../config.php";

    // Delete record logic
    if (isset($_POST['recordID'])) {
        $conn = new mysqli($hn, $un, $pw, $db);

        // Sanitize and prepare the recordID
        $recordID = $_POST['recordID'];

        //Get the carID related to the recordID
        $sql = "SELECT carID FROM car_maintenance_issues WHERE recordID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $recordID);  // 'i' for integer
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if a carID is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $carID = $row['carID'];  // Retrieve the carID

            //Delete the record from the database
            $sql_delete = "DELETE FROM car_maintenance_issues WHERE recordID = ?";
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("i", $recordID);
            $stmt->execute();

            //Redirect to the car info page
            $stmt->close();
            $conn->close();

            header('Location: ../../../carInfo.php?id=' . $carID);
        } else {
            echo "No matching record found.";
        }
    }
?>