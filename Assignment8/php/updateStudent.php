<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
session_start();
        $studentId = $_POST['id'];
        $grade = $_POST['grade'];
        $courseId = $_SESSION['courseId'];

        $con = mysqli_connect("127.0.0.1", "root", "", "students");

        $sql = "UPDATE students.grades SET grade = '" . $grade . "' WHERE studentId = '" . $studentId . "' AND courseId = '" . $courseId . "'";
        mysqli_query($con, $sql);

        header('location: update.html');

        mysqli_close($con);

?>