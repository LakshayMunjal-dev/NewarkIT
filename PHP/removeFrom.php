<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$CID = $_SESSION["CID"];
$BID = "";
$PID = $_POST["PID"];

function deleteProduct($conn, $BID, $PID) {
	$sql = "DELETE FROM APPEARS_IN WHERE BID = '".$BID."' and PID = '".$PID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

deleteProduct($conn, $BID, $PID);
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>