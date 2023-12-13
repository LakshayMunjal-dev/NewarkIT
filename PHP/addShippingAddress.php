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
$BID = "";
$SAName = $_POST["SAName"];

function getBID($conn, $CID) {
	$sql = "SELECT BID FROM TRANSACTION where CID = '".$CID."' and TTag is NULL;";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
	else {
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['BID'];
			}
		} else {
			return null;
		}
	}
	return null;
}

function addShippingAddress($conn, $BID, $SAName) {
	$sql = "UPDATE TRANSACTION SET SAName = '".$SAName."' WHERE TRANSACTION.BID = '".$BID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

$BID = getBID($conn, $CID);
addShippingAddress($conn, $BID, $SAName);
$conn->close();
header('Location: ' . 'checkout2.php');
?>