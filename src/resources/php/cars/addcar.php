<?php
    require_once "../config.php";
    require_once "../tools.php";

    if (isset($_POST['carYear']) &&
        isset($_POST['carMake']) &&
        isset($_POST['carModel']) &&
        $_FILES) {
            $conn = new mysqli($hn, $un, $pw, $db);

            $year = (int)$_POST['carYear'];
            $make = sanitize($conn, $_POST['carMake']);
            $model = sanitize($conn, $_POST['carModel']);
            $id = NULL;

            session_start();
            $owner = $_SESSION['username'];

            $query = "SELECT UserID FROM users where username = '$owner'";
            $result = $conn->query($query);

            $rows = $result->num_rows;

            foreach($result as $item){
                $ownerID = $item['UserID'];
            }

            switch($_FILES['imageUpload']['type']){
                case 'image/jpeg': $ext = 'jpg'; break;
                case 'image/gif': $ext = 'gif'; break;
                case 'image/png': $ext = 'png'; break;
                case 'image/tiff': $ext = 'tiff'; break;
                default:           $ext = ''; break;
            }

            if($ext) {
                $image = "$owner$model$year.$ext";
                $n = "../../images/$image";
                move_uploaded_file($_FILES['imageUpload']['tmp_name'],$n);
            }

            $stmt = $conn->prepare('INSERT INTO cars VALUES(?,?,?,?,?)');
            $stmt->bind_param('sssss',$id, $year, $make, $model, $image);
            $stmt->execute();
            $newCarID = $conn->insert_id;
            $stmt->close();


            $stmt = $conn->prepare('INSERT INTO ownership VALUES(?,?,?)');
            $stmt->bind_param('sss',$id,$ownerID,$newCarID);
            $stmt->execute();
            $stmt->close();

            $conn->close();

            header('Location: ../../../index.php');
        }
?>