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
$CCNumber = $_POST["CCNumber"];

function getBID($conn, $CID) {
	$sql = "SELECT BID FROM Cart where CID = '".$customerID."' and TStatus is NULL;";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
	else {
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['CartID'];
			}
		} else {
			return null;
		}
	}
	return null;
}

function addCreditCard($conn, $BID, $CCNumber) {
	$sql = "UPDATE TRANSACTION SET CCNumber = '".$CCNumber."' WHERE TRANSACTION.BID = '".$BID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

$BID = getBID($conn, $CID);
addCreditCardInCart($conn, $BID, $CCNumber);
$conn->close();
header('Location: ' . 'checkout3.php');
?>