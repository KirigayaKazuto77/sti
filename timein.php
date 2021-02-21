<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];

date_default_timezone_set("Asia/Manila");

$date = new DateTime(date("Y-m-d"));
$WeekNo = (int)$date->format("W");

$currDay = date("l");
$DayNoOfWeek = (int)date('N', strtotime($currDay));

$MonthIn = (int)date("m");
$DayIn = (int)date("d");
$YearIn = (int)date("Y");
$HourIn = (int)date("H");
$MinuteIn = (int)date("i");


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
        $sql = "INSERT INTO $DailyTableName(WeekNo, DayNoOfWeek, MonthIn, DayIn, YearIn, HourIn, MinuteIn) VALUES('$WeekNo', '$DayNoOfWeek', '$MonthIn', '$DayIn', '$YearIn', '$HourIn', '$MinuteIn')";

			if (mysqli_query($conn, $sql)) {
			  echo "Time In Successfully";
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