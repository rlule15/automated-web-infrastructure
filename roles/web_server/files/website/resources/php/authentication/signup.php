<?php
require_once "../config.php";
require_once "../tools.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ("Connection Failed");

if(isset($_POST['firstName']) && 
isset($_POST['lastName']) && 
isset($_POST['username']) && 
isset($_POST['password'])){
    
    $firstName = sanitize($conn,$_POST['firstName']);
    $lastName = sanitize($conn,$_POST['lastName']);
    $username = sanitize($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = NULL;
    $isAdmin = 1;

    $stmt = $conn->prepare('INSERT INTO Users VALUES(?, ?, ?, ?, ?, ?)');

    $stmt->bind_param('ssssss', $id, $firstName, $lastName, $username, $password, $isAdmin);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: ../../../login.html');
    
}
?>