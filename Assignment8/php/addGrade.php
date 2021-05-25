<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
session_start();
if (isset($_POST['submit'])){

    $studentId = $_POST['id'];
    $grade = $_POST['grade'];
    $courseId = $_SESSION['courseId'];

    $con = mysqli_connect("127.0.0.1", "root", "", "students");

    $sql = "INSERT INTO students.grades(studentId,courseId,grade) VALUES ('" . $studentId . "','" . $courseId . "','" . $grade . "')";
    mysqli_query($con, $sql);

    header('location: add.php');

    mysqli_close($con);
}

?>