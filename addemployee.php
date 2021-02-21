<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];
$FirstName = $_POST['FirstName'];
$MiddleName = $_POST['MiddleName'];
$LastName = $_POST['LastName'];
$HourlyRate = $_POST['HourlyRate'];

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
		echo "Employee ID No. Already Exists";
		header("refresh:2; url=index.html");
    } 
    else {
        $sql = "INSERT IGNORE INTO overview(EmpID, FirstName, MiddleName, LastName, HourlyRate) VALUES('$EmpID', '$FirstName', '$MiddleName', '$LastName', '$HourlyRate')";

			if (mysqli_query($conn, $sql)) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    }


mysqli_close($conn);





$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$createw = "CREATE TABLE `" . $DailyTableName . "`( ".
            				"WeekNo INT(2) NOT NULL, ".
            				"DayNoOfWeek INT(1) NOT NULL, ".
            				"DailyTotalTime INT(2) NOT NULL, ".
							"MonthIn INT(2), ".
							"DayIn INT(2), ". 
							"YearIn INT(4), ".
							"HourIn INT(2), ". 
							"MinuteIn INT(2), ".
							"MonthOut INT(2), ". 
							"DayOut INT(2), ". 
							"YearOut INT(4), ".
							"HourOut INT(2), ". 
							"MinuteOut INT(2)); ";

if (mysqli_query($conn, $createw)) {
	echo " | New record created successfully";
} 
else {
	echo "Error: " . $createw . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);





$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$create = "CREATE TABLE `" . $WeeklyTableName . "`( ".
            				"WeekNo INT(2) NOT NULL PRIMARY KEY, ".
            				"WeeklyTotalTime INT(3) NOT NULL, ".
							"TotalOverTime INT(3), ". 
							"TotalUnderTime INT(3), ". 
							"WeeklyDeduction INT(20), ". 
							"WeeklyAdditionalPay INT(20), ". 
							"WeeklyTotalPay INT(20)); ";

if (mysqli_query($conn, $create)) {
	echo " | New record created successfully";
} 
else {
	echo "Error: " . $create . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);



header("refresh:2; url=index.html");
?>