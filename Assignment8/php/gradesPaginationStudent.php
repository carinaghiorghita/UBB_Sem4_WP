<?php
session_start();
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");

$con = mysqli_connect("127.0.0.1", "root", "", "students");

$userId = $_SESSION['id'];
//$userId = 1;
$query = "SELECT * FROM students.grades INNER JOIN students.course ON students.grades.courseId=students.course.id WHERE studentId='$userId'";
$result = mysqli_query($con, $query);
$number_of_rows = mysqli_num_rows($result);
if($number_of_rows>0){
    $requested_users = array();
    for ($i = 0; $i < $number_of_rows; $i++) {
        $row = mysqli_fetch_array($result);
        array_push($requested_users, array(
            "name" => $row['name'],
            "grade" => (int)$row['grade']));
    }
    mysqli_free_result($result);
    echo json_encode($requested_users);
}
$con->close();
?>
