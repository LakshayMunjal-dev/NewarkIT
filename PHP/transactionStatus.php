<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$CID = $_SESSION["CID"];

function updateTransactionStatus($conn, $customerID) {
	$sql = "UPDATE TRANSACTION SET TTag = 'C' WHERE CID = '".$CID."' AND TTag IS NULL;";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

updateTransactionStatus($conn, $CID);
$conn->close();
header('Location: ' . 'homepage.php');
?>