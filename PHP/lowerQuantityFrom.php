<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$CID = $_SESSION["CID"];
$PID = $_POST["PID"];
$BID = $_POST["BID"];

function decreaseProductCount($conn, $BID, $PID) {
	$sql = "UPDATE APPEARS_IN SET Quantity = Quantity - 1 WHERE BID = '".$BID."' AND PID = '".$PID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

decreaseProductCount($conn, $BID, $PID);
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>