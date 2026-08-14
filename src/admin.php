<?php
    require_once "resources/php/config.php";

    // Start the session
    session_start();

    // Check if a user session exists
    if (!isset($_SESSION['username'])) {
        // If no session exists, redirect to the login page or show an error message
        header("Location: login.html");
        exit;
    }
    $conn = new mysqli($hn, $un, $pw, $db);

    // 1. Fetch all users
    $sqlUsers = "SELECT * FROM users";
    $resultUsers = $conn->query($sqlUsers);

    // 2. Fetch all cars
    $sqlCars = "SELECT * FROM cars";
    $resultCars = $conn->query($sqlCars);

    // 3. Fetch all service maintenance records
    $sqlServices = "SELECT * FROM car_maintenance_issues";
    $resultServices = $conn->query($sqlServices);
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
    </head>
    <body>

        <h1>Admin Dashboard</h1>

        <a href="index.php">Back</a>
        <!-- Users Table -->
        <h2>Users Information</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $resultUsers->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['UserID']) . "</td>
                            <td>" . htmlspecialchars($row['UserFirstName']) . "</td>
                            <td>" . htmlspecialchars($row['UserLastName']) . "</td>
                            <td>" . htmlspecialchars($row['Username']) . "</td>
                            <td>
                                <form action='resources/php/admin/deleteuser.php' method='post'>
                                    <input type='hidden' name='userID' value='" . $row['UserID'] . "'>
                                    <input type='submit' value='Delete'>
                                </form>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Cars Table -->
        <h2>Car Information</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Car Year</th>
                    <th>Car Make</th>
                    <th>Car Model Plate</th>
                    <th>Car Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $resultCars->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CarID']) . "</td>
                            <td>" . htmlspecialchars($row['carYear']) . "</td>
                            <td>" . htmlspecialchars($row['carMake']) . "</td>
                            <td>" . htmlspecialchars($row['carModel']) . "</td>
                            <td>" . htmlspecialchars($row['carImage']) . "</td>
                            <td>
                                <form action='resources/php/admin/deletecar.php' method='post'>
                                    <input type='hidden' name='carID' value='" . $row['CarID'] . "'>
                                    <input type='submit' value='Delete'>
                                </form>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Services Table -->
        <h2>Service Maintenance Information</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Service Type</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Mileage</th>
                    <th>Car ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $resultServices->fetch_assoc()) {
                        // Start by displaying the row with existing data
                        echo "<tr>
                                <td>" . htmlspecialchars($row['recordID']) . "</td>
                                <td>" . htmlspecialchars($row['serviceType']) . "</td>
                                <td>" . htmlspecialchars($row['serviceDate']) . "</td>
                                <td id='description-" . $row['recordID'] . "'>" . htmlspecialchars($row['serviceDescription']) . "</td>
                                <td id='mileage-" . $row['recordID'] . "'>" . number_format($row['serviceMileage']) . "</td>
                                <td>" . number_format($row['CarID']) . "</td>
                                <td>
                                    
                                    <!-- Delete Form -->
                                    <form action='resources/php/admin/deleteservice.php' method='post' style='display:inline-block;'>
                                        <input type='hidden' name='recordID' value='" . $row['recordID'] . "'>
                                        <input type='submit' value='Delete'>
                                    </form>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>

    </body>
    </html>

<?php
    $conn->close();
?>
