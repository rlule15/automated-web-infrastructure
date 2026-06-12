<?php
    require_once "../config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['carID'])) {
        $carID = $_POST['carID'];

        $conn = new mysqli($hn, $un, $pw, $db);

        // Prepare and execute the delete query
        $sqlDelete = "DELETE FROM cars WHERE CarID = ?";
        $stmt = $conn->prepare($sqlDelete);
        if ($stmt) {
            $stmt->bind_param("s", $carID); // Use "s" for a string parameter
            $stmt->execute();
            $stmt->close();
        }

        // Redirect back to admin dashboard
        header("Location: ../../../admin.php");
        exit;
    }
?>
