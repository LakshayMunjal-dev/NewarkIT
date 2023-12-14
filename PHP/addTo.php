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
$BID = null;

function getBID($conn, $CID, $PID) {
	$sql = "SELECT BID FROM TRANSACTION WHERE CID = '".$CID."' AND TTag is NULL;";
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

function createNewBasket($conn, $CID) {
$sql = "INSERT INTO TRANSACTION (BID, CID, SAName, CCNumber, TTag, TDate) VALUES (NULL, '".$CID."', NULL, NULL, NULL, NULL)";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

function isProductAlreadyInTheBasket($conn, $BID, $PID) {
$sql = "SELECT * FROM APPEARS_IN WHERE BID = '".$BID."' and PID = '".$PID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
	else {
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	return false;
}

function increaseProductCount($conn, $BID, $PID) {
	$sql = "UPDATE APPEARS_IN SET Quantity = Quantity + 1 WHERE BID = '".$BID."' and PID = '".$PID."';";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

function getProductPrice($conn, $PID) {
	$status = $_SESSION["Status"];
	$Price = "";
	$sql = "";
	if($status == "Gold" || $status == "Platinum") {
		$sql = "SELECT OfferPrice FROM OFFER_PRODUCT WHERE PID = ".$PID.";";
		$result = $conn->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		} else {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$Price = $row['OfferPrice'];
					break;
				}
			} else {
				$Price = "";
			}
		}
	} 
	if($Price == ""){
		$sql = "SELECT PPrice FROM Product WHERE PID = ".$PID.";";
		$result = $conn->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		} else {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$Price = $row['PPrice'];
				}
			} else {
				return null;
			}
		}
	}
	return $Price;
	
}

function insertProductInCart($conn, $BID, $PID) {
	$Price = getProductPrice($conn, $PID);
	$sql = "INSERT INTO APPEARS_IN (BID, PID, Quantity, PriceSold) VALUES (".$BID.", ".$PID.", '1', ".$Price.");";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
}

$BID = getBID($conn, $CID, $PID);

if($BID == null) {
	createNewCart($conn, $CID);
	$BID = getBID($conn, $CID, $PID);
}

if(isProductAlreadyInTheCart($conn, $BID, $PID)){
	increaseProductCount($conn, $BID, $PID);
} else {
	insertProductInCart($conn, $BID, $PID);
}
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>