<?php
session_start();
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
$group = $_SESSION['group'];
$course = $_SESSION['course'];
$courseId = $_SESSION['courseId'];

//$group = '923';
//$course = 'Data Structures and Algorithms';
//$courseId = 1;

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 4;
$offset = ($pageno-1) * $no_of_records_per_page;

$con = mysqli_connect("127.0.0.1", "root", "", "students");

$total_pages_sql = "SELECT COUNT(*) FROM students.student WHERE studentGroup='$group'";
$result = mysqli_query($con,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$query = "SELECT * FROM students.student WHERE studentGroup='$group' LIMIT $offset, $no_of_records_per_page";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result)>0){
    echo "<table border = \"1\">";
    echo "<tr>";
    echo "<th>Student ID</th>";
    echo "<th>Student first name</th>";
    echo "<th>Student last name</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<th>".$row['id']."</th>";
        echo "<th>".$row['firstName']."</th>";
        echo "<th>".$row['lastName']."</th>";
        echo "</tr>";
    }
    echo "</table>";
}

$con->close();
?>