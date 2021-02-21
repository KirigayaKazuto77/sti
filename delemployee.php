<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];

$DailyTableName = "daily_empid_" . $EmpID;
$WeeklyTableName = "weekly_empid_" . $EmpID;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $sql = "DELETE FROM overview WHERE EmpID = '$EmpID'";

		if ($conn->query($sql) === TRUE) {
		  echo "Record deleted successfully";
		} else {
		  echo "Error deleting record: " . $conn->error;
		}

    } 
    else {
        echo "No record found";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$deletedaily = "DROP TABLE `$DailyTableName`";
   if (mysqli_query($conn, $deletedaily)) { 
     echo " | Table deleted successfully";
   } else { 
     echo " | Error: ". mysqli_error($conn); 
   }

mysqli_close($conn);



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$deleteweekly = "DROP TABLE `$WeeklyTableName`";
   if (mysqli_query($conn, $deleteweekly)) { 
     echo " | Table deleted successfully";
   } else { 
     echo " | Error: ". mysqli_error($conn); 
   }

mysqli_close($conn);


header("refresh:2; url=index.html");
?>