<?php
    require_once "../config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recordID'])) {
        $recordID = $_POST['recordID'];

        $conn = new mysqli($hn, $un, $pw, $db);

        // Prepare and execute the delete query
        $sqlDelete = "DELETE FROM car_maintenance_issues WHERE recordID = ?";
        $stmt = $conn->prepare($sqlDelete);

        $stmt->bind_param("s", $recordID); 
        $stmt->execute();
        $stmt->close();

        // Redirect back to admin dashboard
        header("Location: ../../../admin.php");

    }
?>
