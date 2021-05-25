<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
session_start();

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json,true);
var_dump($data);
    $group = $data['group'];
    $course = $data['course'];
    echo $group;
    echo $course;

    $con = mysqli_connect("127.0.0.1", "root", "", "students");
    $sql1 = "SELECT id FROM students.course WHERE name = '$course'";
    $query = $con->query($sql1);
    if($query) {
        $row = mysqli_fetch_row($query);
        $courseId = $row[0];
        $_SESSION['courseId'] = $courseId;

        $_SESSION['group'] = $group;
        $_SESSION['course'] = $course;

//        $_SESSION['group'] = '923';
//        $_SESSION['course'] = 'Data Structures and Algorithms';
//        $_SESSION['courseId'] = 1;
    }
    $con->close();

?>