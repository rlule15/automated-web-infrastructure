<?php
    require_once "../config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userID'])) {
        $userID = $_POST['userID'];

        $conn = new mysqli($hn, $un, $pw, $db);

        // Prepare and execute the delete query
        $sqlDelete = "DELETE FROM users WHERE UserID = ?";
        $stmt = $conn->prepare($sqlDelete);
        if ($stmt) {
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            $stmt->close();
        }

        // Redirect back to admin dashboard
        header("Location: ../../../admin.php");
        exit;
    }
?>
