<?php
    // get_car_info.php
    require_once "resources/php/config.php";

    // Get the carID from the URL
    if (isset($_GET['id'])) {
        $carID = intval($_GET['id']);
    } else {
        // Handle the case where carID is not provided
        echo "<h2>Car ID is missing.</h2>";
    }

    $conn = new mysqli($hn, $un, $pw, $db);

    // Modify the query to use the dynamic carID
    $sql = "SELECT * FROM car_maintenance_issues WHERE carID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      
      // Table headers
      echo '<thead>
              <tr>
                  <th id="type">Issue or Maintenance</th>
                  <th id="listDate">Date Noticed/Done</th>
                  <th id="listDesc">Description of Issue/Maintenance</th>
                  <th id="listMileage">Mileage</th>
                  <th id="listActions"></th>
              </tr>
            </thead>';
      
      // Table body
      echo '<tbody>';
      while ($row = $result->fetch_assoc()) {
        $formattedMileage = number_format($row['serviceMileage']);

        echo '<tr>
                <td>' . htmlspecialchars($row['serviceType']) . '</td>
                <td>' . htmlspecialchars($row['serviceDate']) . '</td>
                <td>' . htmlspecialchars($row['serviceDescription']) . '</td>
                <td>' . $formattedMileage . '</td>
                <td>
                <!-- Edit Button to Toggle the Edit Form -->
                    <form action="" method="get" style="display:inline-block;">
                        <input type="hidden" name="id" value="' . $carID . '">
                        <input type="hidden" name="editRecordID" value="' . $row['recordID'] . '">
                        <input type="submit" value="Edit">
                    </form>

                    <!-- Delete Form -->
                    <form action="resources/php/service/deleteservice.php" method="post">
                        <input type="hidden" name="recordID" value="' . $row['recordID'] . '">
                        <input type="submit" value="Delete">
                    </form>
                    
                </td>
              </tr>';
              if (isset($_GET['editRecordID']) && $_GET['editRecordID'] == $row['recordID']) {
                echo "<tr>
                        <td colspan='6'>
                            <form action='resources/php/admin/updateservice.php' method='post'>
                                <input type='hidden' name='id' value='" . $carID . "'>
                                <input type='hidden' name='recordID' value='" . $row['recordID'] . "'>
                                
                                <label for='serviceDescription-" . $row['recordID'] . "'>Description:</label>
                                <input type='text' name='serviceDescription' id='serviceDescription-" . $row['recordID'] . "' value='" . htmlspecialchars($row['serviceDescription']) . "' required>
                                
                                <label for='serviceMileage-" . $row['recordID'] . "'>Mileage:</label>
                                <input type='number' name='serviceMileage' id='serviceMileage-" . $row['recordID'] . "' value='" . htmlspecialchars($row['serviceMileage']) . "' required>
                    
                                <button type='submit'>Update</button>
                    
                                <!-- Cancel Button to remove the edit form -->
                                <button type='button' onclick='window.location.href=\"carInfo.php?id=$carID\";'>Cancel</button>
                            </form>
                        </td>
                      </tr>";
            }
      }
      echo '</tbody>';
      echo '</table>';
    } else {
      echo '<div id="userNote">
              <p>No issues or maintenance found.</p>
            </div>';
    }

    $conn->close();
?>


