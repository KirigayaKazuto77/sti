<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];
//$FirstName = $_POST['FirstName'];
//$MiddleName = $_POST['MiddleName'];
//$LastName = $_POST['LastName'];
$HourlyRate = $_POST['HourlyRate'];

$DailyTableName = "daily_empid_" . $EmpID;
$WeeklyTableName = "weekly_empid_" . $EmpID;


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $sql = "UPDATE overview SET HourlyRate = '$HourlyRate' WHERE EmpID = '$EmpID'";

			if (mysqli_query($conn, $sql)) {
			  echo "Hourly Rate Edited Successfully ";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    } 
    else {

		echo "Employee ID No. Does Not Exists";
		header("refresh:2; url=index.html");
    }

mysqli_close($conn);

header("refresh:2; url=index.html");
?>