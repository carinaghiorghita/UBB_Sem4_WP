<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
session_start();

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json,true);
var_dump($data);
    $username = $data['username'];
    $password = $data['password'];

    $con = mysqli_connect("127.0.0.1", "root", "", "students");
    $sql = "SELECT id,username,password,firstName FROM students.professor WHERE username = '$username' LIMIT 1";
    $query = $con->query($sql);
    if($query) {
        $row = mysqli_fetch_row($query);
        $userId= $row[0];
        $dbUserName = $row[1];
        $dbPassword = $row[2];
        $firstName = $row[3];
    }
    if($username == $dbUserName && $password == $dbPassword && $username != '') {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $userId;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['role'] = 'prof';

        //header('Location: professorhome.php');
    }
    else {
        echo "<b><i>Incorrect credentials</i><b>";
        //header('Location: professorlogin.html');

    }
    $con->close();


?>
