<?php
    require_once "../config.php";
    require_once "../tools.php";

    $conn = new mysqli($hn, $un, $pw, $db);

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = sanitize($conn, $_POST['username']);
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = '$username'";

        $result = $conn->query($query);
        if(!$result) die("Database access failed");

        foreach($result as $item){
            if(password_verify($password, $item['Password'])){
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['UserID'] = $item['UserID'];
                header('Location: ../../../index.php');
            }else{
                echo "Incorrect password";
            }
        }
    }
?>