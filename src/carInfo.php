<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/pageStyles.css">
    <link rel="stylesheet" href="resources/css/addCarInfo.css">
    <title>Add Issue</title>
</head>
<body>
    <div id="currentCar">
        <?php
        require_once "resources/php/cars/getcurrentcar.php"
        ?>
    </div>
    <div id="options">
        <h2>What would you like to do?</h2>
        <div id="btnStyle">
        <a href="index.php"><input type="button" value="Home Page" id="homeBtn"></a>
        </div>
    </div>
    <div id="addIssue">
        <?php
        require_once "resources/php/cars/getcurrentcarimg.php"
        ?>
        <h3 id="infoType">Information</h3>
        <form action="resources/php/service/addservice.php" method="post" id="issueMeintenanceForm" enctype="multipart/form-data">
            <label for="serviceType">Choose Information Type</label>
            <select name="serviceType" id="serviceType" required>
                <option value="Issue">Issue</option>
                <option value="Maintenance" >Maintenance</option>
            </select>
            <label for="serviceDescription">Description of Issue/Maintenance:</label>
            <input type="text" name="serviceDescription" id="serviceDescription" required>
            <label for="carMileage">Mileage:</label>
            <input type="number" name="carMileage" id="carMileage" required min="0" max="999999">
            <label for="Date">Date noticed/done</label>
            <input type="date" name="serviceMaintenanceDate" id="serviceMaintenanceDate" required>
            
            <!-- Hidden field for carID -->
            <input type="hidden" name="carID" value="<?php echo $_GET['id']; ?>">

            <button type="submit">Add</button>
        </form>

    </div>
    <div id="issueMaintenanceList">
        <table id="issueTable">
           <?php
            require_once "resources/php/service/getservices.php";
            ?> 
        </table>
    </div>
</body>
</html>