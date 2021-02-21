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




echo "<br><br><br><br> Employee's Weekly Record";





$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $WeeklyTableName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    		<tr>
    			<th>Week No.</th>
    			<th>Weekly Total Time</th>
    			<th>Total OverTime</th>
    			<th>Total UnderTime</th>
    			<th>Total Weekly Deduction</th>
    			<th>Total Weekly Additional Pay</th>
    			<th>Weekly Total Pay</th>
    		</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        	<tr>
        		<td>" . $row["WeekNo"] . "</td>
        		<td>" . $row["WeeklyTotalTime"] . "</td>
        		<td>" . $row["TotalOverTime"] . "</td>
                <td>" . $row["TotalUnderTime"] . "</td>
                <td>" . $row["WeeklyDeduction"] . "</td>
                <td>" . $row["WeeklyAdditionalPay"] . "</td>
                <td>" . $row["WeeklyTotalPay"] . "</td>
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