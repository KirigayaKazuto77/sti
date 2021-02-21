<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stiexam";

$EmpID = $_POST['EmpID'];
$TimeOutFull = $_POST['TimeOut'];
$DateOutFull = $_POST['DateOut'];


date_default_timezone_set("Asia/Manila");

$date = new DateTime(date($DateOutFull));
$WeekNo = (int)$date->format("W");


$currDay = date($DateOutFull); // "l"
$DayNoOfWeek = (int)date('N', strtotime($currDay));


$d = date_parse_from_format("Y/m/d", $DateOutFull);
$t = date_parse_from_format("H:i", $TimeOutFull);

$MonthOut = (int)$d["month"];
$DayOut = (int)$d["day"];
$YearOut = (int)$d["year"];
$HourOut = (int)$t["hour"];
$MinuteOut = (int)$t["minute"];



$DailyTableName = "daily_empid_" . $EmpID;
$WeeklyTableName = "weekly_empid_" . $EmpID;



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $sql = "UPDATE $DailyTableName SET 
        		MonthOut = '$MonthOut', 
        		DayOut = '$DayOut', 
        		YearOut = '$YearOut',
        		HourOut = '$HourOut',
        		MinuteOut = '$MinuteOut'
        		WHERE  WeekNo = $WeekNo AND DayNoOfWeek = $DayNoOfWeek";

			if (mysqli_query($conn, $sql)) {
			  echo "Time Out Edit Successfully | ";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    } 
    else {

		echo "Employee ID No. Does Not Exists";
		header("refresh:2; url=index.html");
    }

mysqli_close($conn);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $MonthRet = mysqli_query($conn, "SELECT MonthIn FROM $DailyTableName WHERE DayNoOfWeek = '$DayNoOfWeek' AND WeekNo = '$WeekNo'");
        $MonthIn = $MonthRet->fetch_row()[0] ?? false;
    } 
    else {

        echo "Employee ID No. Does Not Exists";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $DayRet = mysqli_query($conn, "SELECT DayIn FROM $DailyTableName WHERE DayNoOfWeek = '$DayNoOfWeek' AND WeekNo = '$WeekNo'");
        $DayIn = $DayRet->fetch_row()[0] ?? false;
    } 
    else {

        echo "Employee ID No. Does Not Exists";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $YearRet = mysqli_query($conn, "SELECT YearIn FROM $DailyTableName WHERE DayNoOfWeek = '$DayNoOfWeek' AND WeekNo = '$WeekNo'");
        $YearIn = $YearRet->fetch_row()[0] ?? false;
    } 
    else {

        echo "Employee ID No. Does Not Exists";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $HourRet = mysqli_query($conn, "SELECT HourIn FROM $DailyTableName WHERE DayNoOfWeek = '$DayNoOfWeek' AND WeekNo = '$WeekNo'");
        $HourIn = $HourRet->fetch_row()[0] ?? false;
    } 
    else {

        echo "Employee ID No. Does Not Exists";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $MinuteRet = mysqli_query($conn, "SELECT MinuteIn FROM $DailyTableName WHERE DayNoOfWeek = '$DayNoOfWeek' AND WeekNo = '$WeekNo'");
        $MinuteIn = $MinuteRet->fetch_row()[0] ?? false;
    } 
    else {

        echo "Employee ID No. Does Not Exists";
        header("refresh:2; url=index.html");
    }

mysqli_close($conn);




$FullDateIn = new DateTime($YearIn . "-" . $MonthIn . "-" . $DayIn . " " . $HourIn . ":" . $MinuteIn);
//echo $FullDateIn . " | ";
$FullDateOut = new DateTime($YearOut . "-" . $MonthOut . "-" . $DayOut . " " . $HourOut . ":" . $MinuteOut);
//echo $FullDateOut . " | ";

$interval = $FullDateIn->diff($FullDateOut);
$DailyTotalTime = (int)$interval->format('%h');




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $sql = "UPDATE $DailyTableName SET 
        		DailyTotalTime = '$DailyTotalTime' 
        		WHERE  WeekNo = $WeekNo AND DayNoOfWeek = $DayNoOfWeek";

			if (mysqli_query($conn, $sql)) {
			  echo "Edit Time In Successfully ";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    } 
    else {

		echo "Employee ID No. Does Not Exists";
		header("refresh:2; url=index.html");
    }

mysqli_close($conn);




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$WeeklyTotalTimeRet = mysqli_query($conn, "SELECT SUM(DailyTotalTime) FROM $DailyTableName WHERE WeekNo = '$WeekNo'");
$WeeklyTotalTime = $WeeklyTotalTimeRet->fetch_row()[0] ?? false;

mysqli_close($conn);



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 $result = mysqli_query($conn, "SELECT * FROM overview WHERE EmpID = '$EmpID'");
    if (mysqli_num_rows($result) > 0){
        $HourlyRateRet = mysqli_query($conn, "SELECT HourlyRate FROM overview WHERE EmpID = '$EmpID'");
		$HourlyRate = $HourlyRateRet->fetch_row()[0] ?? false;
    } 
    else {

		echo "Employee ID No. Does Not Exists";
		header("refresh:2; url=index.html");
    }

mysqli_close($conn);







/////////////////////////// OVERTIME ///////////////////////////
if ($WeeklyTotalTime > 40) {
	$TotalOverTime = $WeeklyTotalTime - 40;
}
else {
	$TotalOverTime = 0;
}

if ($WeeklyTotalTime > 40) {
	$WeeklyAdditionalPay = $TotalOverTime * ($HourlyRate * 1.5);
}
else {
	$WeeklyAdditionalPay = 0;
}

/////////////////////////// UNDERTIME ///////////////////////////
if ($WeeklyTotalTime < 40) {
	$TotalUnderTime = 40 - $WeeklyTotalTime;
}
else {
	$TotalUnderTime = 0;
}

if ($WeeklyTotalTime < 40) {
	$WeeklyDeduction = $TotalUnderTime * $HourlyRate;
}
else {
	$WeeklyDeduction = 0;
}

/////////////////////////// PAY COMPUTATION ///////////////////////////
if ($WeeklyTotalTime > 40) {
	$WeeklyTotalPay = (40 * $HourlyRate) + $WeeklyAdditionalPay;
}
else if ($WeeklyTotalTime == 40) {
	$WeeklyTotalPay = (40 * $HourlyRate);
}
else {
	$WeeklyTotalPay = (40 * $HourlyRate) - $WeeklyDeduction;
}




$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM $WeeklyTableName WHERE WeekNo = '$WeekNo'");
    if (mysqli_num_rows($result) > 0){
        $sql = "UPDATE $WeeklyTableName SET 
        		WeekNo = '$WeekNo',
        		WeeklyTotalTime = '$WeeklyTotalTime', 
        		TotalOverTime = '$TotalOverTime', 
        		TotalUnderTime = '$TotalUnderTime',
        		WeeklyDeduction = '$WeeklyDeduction',
        		WeeklyAdditionalPay = '$WeeklyAdditionalPay',
        		WeeklyTotalPay = '$WeeklyTotalPay'
        		WHERE  WeekNo = $WeekNo";

			if (mysqli_query($conn, $sql)) {
			  echo " | Weekly Update Successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    } 
    else {

		$sql = "INSERT IGNORE INTO $WeeklyTableName(WeekNo, WeeklyTotalTime, TotalOverTime, TotalUnderTime, WeeklyDeduction, WeeklyAdditionalPay, WeeklyTotalPay) VALUES('$WeekNo', '$WeeklyTotalTime', '$TotalOverTime', '$TotalUnderTime', '$WeeklyDeduction', '$WeeklyAdditionalPay', '$WeeklyTotalPay')";

		if (mysqli_query($conn, $sql)) {
			  echo " | Weekly Insert Successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
    }

mysqli_close($conn);







header("refresh:2; url=index.html");
?>