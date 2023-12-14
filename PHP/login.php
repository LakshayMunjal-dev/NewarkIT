<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Customer where Email = '".$_POST["email"]."';";
$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
else {
	if ($result->num_rows == 1) {
		session_start();
		$row = $result->fetch_assoc();
		$_SESSION["CID"] = $row["CID"];
		$_SESSION["Status"] = $row["Status"];
		$_SESSION["CName"] = $row["FName"]." ".$row["LName"];
		$conn->close();
		header('Location: homepage.php');
	} else {
		$conn->close();
		header('Location: index.php');
	}
}
?>