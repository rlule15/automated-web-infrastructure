<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/pageStyles.css">
    <title>Home Page</title>
</head>
<body>
    <div id="heading">
        <h1 id="content"></h1>
    </div>
    <div id="options">
        <h2>What would you like to do?</h2>
        <div id="btnStyle">
            <form>
                <a href="login.html"><input type="button" value="Login" id="loginBtn"></a>
                <a href="signup.html" ><input type="button" value="Sign Up" id="signUpBtn"></a>
                <a href="addCar.html" ><input type="button" value="Add Car" id="addCarBtn"></a>
                <a href="admin.php" ><input type="button" value="Admin" id="adminBtn"></a>
                <input type="button" value="Sign Out" id="signOutBtn">
            </form>
        </div>
    </div>

    <div id="addedCars">
        <?php
        require_once "resources/php/cars/getcars.php";
        // Check if there are cars to display
        if (!empty($cars)) {
            foreach ($cars as $car) {
                echo '<figure>';
                echo '<a href="carInfo.php?id=' . $car->CarID . '">';
                echo '<img src="resources/images/' . $car->carImage . '" alt="' . $car->carMake . ' ' . $car->carModel . ' Image" width="200">';
                echo '</a>';
                echo '<figcaption>' . $car->carYear . ' ' . $car->carMake . ' ' . $car->carModel . '</figcaption>';
                echo '</figure>';
            }
        } else {
            echo '<p>No cars available to display.</p>';
        }
        ?>
    </div>

    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript">
        onLoad();
    </script>
</body>
</html>
