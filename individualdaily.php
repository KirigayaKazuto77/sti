<!DOCTYPE html>
<html>
<head>
<title>Overview - Employee Payroll</title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

	<button onclick="document.location='index.html'">Home</button>
	<br>
	<br>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];

$DailyTableName = "daily_empid_" . $EmpID;
$WeeklyTableName = "weekly_empid_" . $EmpID;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM overview WHERE EmpID = '$EmpID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Employee ID No.</th>
    			<th>First Name</th>
    			<th>Middle Name</th>
    			<th>Last Name</th>
    			<th>Hourly Rate (PHP)</th>
    		</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        	<tr>
        		<td>" . $row["EmpID"]. "</td>
        		<td>" . $row["FirstName"]. "</td>
        		<td>" . $row["MiddleName"]. "</td>
        		<td>" . $row["LastName"]. "</td>
        		<td>" . $row["HourlyRate"]. "</td>
        	</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();




echo "<br><br><br><br> Employee's Daily Record";





$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $DailyTableName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Week No.</th>
    			<th>Day No. Of The Week</th>
    			<th>Daily Total Time</th>
    			<th>Date In</th>
    			<th>Time In</th>
    			<th>Date Out</th>
    			<th>Time Out</th>
    		</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        	<tr>
        		<td>" . $row["WeekNo"] . "</td>
        		<td>" . $row["DayNoOfWeek"] . "</td>
        		<td>" . $row["DailyTotalTime"] . "</td>
        		<td>" . $row["MonthIn"] . "/" . $row["DayIn"] . "/" . $row["YearIn"] . "</td>
        		<td>" . $row["HourIn"] . ":" . $row["MinuteIn"] . "</td>
        		<td>" . $row["MonthOut"] . "/" . $row["DayOut"] . "/" . $row["YearOut"] . "</td>
        		<td>" . $row["HourOut"] . ":" . $row["MinuteOut"] . "</td>
        	</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();


?>

</body>
</html>