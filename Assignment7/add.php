<?php 
session_start();
if (isset($_POST['group'])){
    $group = $_POST['group'];
    $course = $_POST['course'];
    $_SESSION['group'] = $group;
    $_SESSION['course'] = $course;

    $con = mysqli_connect("127.0.0.1", "root", "", "students");
	$sql1 = "SELECT id FROM students.course WHERE name = '$course'";
    $query = $con->query($sql1);
    if($query) {
    	$row = mysqli_fetch_row($query);
    	$courseId = $row[0];
    	$_SESSION['courseId'] = $courseId;

	}
	mysqli_close($con);
}

if (isset($_POST['submit'])){

	//echo var_dump($_POST);
	$studentId = $_POST['id'];
	$grade = $_POST['grade'];
	$courseId = $_SESSION['courseId'];

    $con = mysqli_connect("127.0.0.1", "root", "", "students");

	$sql = "INSERT INTO students.grades(studentId,courseId,grade) VALUES ('" . $studentId . "','" . $courseId . "','" . $grade . "')";
	//echo var_dump($sql);
	mysqli_query($con, $sql);

    header('location: professorhome.php');

	mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update grades</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>
<div>
<h3>Grades for group <?php echo $_SESSION['group']; ?>, course <?php echo $_SESSION['course']; ?></h3>
	
<?php
	$group = $_SESSION['group'];
	$course = $_SESSION['course'];
	$courseId = $_SESSION['courseId'];	

	if (isset($_GET['pageno1'])) {
            $pageno1 = $_GET['pageno1'];
        } else {
            $pageno1 = 1;
        }
        $no_of_records_per_page = 4; 
        $offset = ($pageno1-1) * $no_of_records_per_page;

	$con = mysqli_connect("127.0.0.1", "root", "", "students");

	$total_pages_sql = "SELECT COUNT(*) FROM students.grades INNER JOIN students.course ON students.grades.courseId=students.course.id INNER JOIN students.student ON students.grades.studentId = students.student.id WHERE studentGroup='$group' AND name='$course'";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

	$query = "SELECT * FROM students.grades INNER JOIN students.course ON students.grades.courseId=students.course.id INNER JOIN students.student ON students.grades.studentId = students.student.id WHERE studentGroup='$group' AND name='$course' LIMIT $offset, $no_of_records_per_page";

	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result)>0){
	    echo "<table border = \"1\">";
	    echo "<tr>";
	    echo "<th>Student ID</th>";
	    echo "<th>Student first name</th>";
	    echo "<th>Student last name</th>";
	    echo "<th>Grade</th>";
	    echo "</tr>";
	    while ($row = mysqli_fetch_array($result)){
	        echo "<tr>";
	        echo "<th>".$row['studentId']."</th>";
	        echo "<th>".$row['firstName']."</th>";
	        echo "<th>".$row['lastName']."</th>";
	        echo "<th>".$row['grade']."</th>";
	        echo "</tr>";
	    }
	    echo "</table>";
	}

	$con->close(); 
?>
<br>
<ul class="pagination">
	<li><a href="?pageno1=1">First</a></li>&emsp;
    <li class="<?php if($pageno1 <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno1 <= 1){ echo '#'; } else { echo "?pageno1=".($pageno1 - 1); } ?>">Prev</a>
    </li>&emsp;
    <li class="<?php if($pageno1 >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno1 >= $total_pages){ echo '#'; } else { echo "?pageno1=".($pageno1 + 1); } ?>">Next</a>
    </li>&emsp;
    <li><a href="?pageno1=<?php echo $total_pages; ?>">Last</a></li>&emsp;
</ul>
</div>
<div>
<h3>Students in group <?php echo $group; ?></h3>
<?php
	$group = $_SESSION['group'];
	$course = $_SESSION['course'];
	$courseId = $_SESSION['courseId'];	

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
<br>
<ul class="pagination">
	<li><a href="?pageno=1">First</a></li>&emsp;
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>&emsp;
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>&emsp;
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>&emsp;
</ul>
</div>

<form method="post" action="add.php">
    <input type="text" name = "id" placeholder="Student ID">
    <br>
    <input type="text" name="grade" placeholder="New grade">
    <br>
    <input type="submit" name="submit" value="Add">
</form>
</body>
</html>