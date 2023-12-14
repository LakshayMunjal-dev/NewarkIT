<?php
session_start();
?>
<html>
<head>
    <title>Online Computer Store</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<style type="text/css">
table, th, td {
    border: 1px #00008B;
	color: #ADD8E6;
	text-align:center;
}
body {
    background-color: #8A307F;
}
h1, h2, h3 {
	text-align: center;
	color : #79A7D3;
}

.menuBtn {
	width:250px;
	height:30px;
	font-weight:bold;
	font-size:15px;
}
input {
	color : #6883BC;
}

p {
	color : #EA738D;
}
</style>
</head>
<body>
	<h1>Newark-IT - Online Computer Store</h1>
	<h2>Welcome <?php echo $_SESSION["CName"];  ?></h2>
	
	<div style="text-align: center;">
		<form  action="basket.php" method="post">
			<input class="menuBtn" type="submit" value="Back to the Cart"/><br><br>
		</form>
		
		<form  action="checkout1.php" method="post">
			<input class="menuBtn" type="submit" value="Back to Select Shipping Address"/><br><br>
		</form>
		
		<form  action="checkout2.php" method="post">
			<input class="menuBtn" type="submit" value="Back to Select Credit Card"/><br><br>
		</form>
	</div>
	<h3>Checkout</h3>
	<h3>*** Review Your Purchase ***</h3>
	
	<div>
		<h3><u>Product Details</u></h3>
		<table style="width:100%">
		  <tr>
			<th>Name</th>
			<th>Description</th>
			<th>Price Sold</th>
			<th>Quantity</th>
		  </tr>
		  
		<?php

			// Create connection
			$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			$totalPrice = 0;
			$sql = "SELECT P.PID, P.PName, A.PriceSold, A.Quantity, P.PQuantity, P.Description, T.BID FROM PRODUCT P, TRANSACTION T, APPEARS_IN A where P.PID = A.PID AND T.BID = A.BID and T.TTag is NULL and T.CID = '".$_SESSION["CID"]."';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$totalPrice += ($row["PriceSold"] * $row['Quantity']);
					echo "<tr><td>".$row["PName"]."</td><td>".$row["Description"]."</td><td>$".$row["PriceSold"]."</td><td>".$row["Quantity"]."</td></tr>";
				}
				echo "</table>";
			} else {
				echo "No Result Found";
			}
			$conn->close();
		?>
	<br><br></div>
	<div>
	  
	<?php

		// Create connection
		$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM SHIPPING_ADDRESS S, TRANSACTION T WHERE T.TTag IS NULL AND T.CID = S.CID AND T.SAName = S.SAName AND T.CID = '".$_SESSION["CID"]."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<div><h3><u>Your Shipping Address for this Purchase</u></h3>
			<table style='width:100%'>
			  <tr>
				<th>Shipping Address Name</th>
				<th>Recipient Name</th> 
				<th>Address</th>	
			  </tr>";
			while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row["SAName"]."</td><td>".$row["RecepientName"]."</td><td>".$row["SNumber"]." ".$row["Street"].", ".$row["City"].", ".$row["State"].", ".$row["Country"].", ".$row["Zip"]."</td></tr>";
				}
			echo "</table></div>";
		} else {
			echo "No Result Found";
		}
		$conn->close();
	?>
	<br>
	<div>
	<?php

		// Create connection
		$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM CREDIT_CARD C, TRANSACTION T WHERE T.TTag is NULL and T.CCNumber = C.CCNumber and T.CID = '".$_SESSION["CID"]."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<div><h3><u>Your Credit Card Information for this Purchase</u></h3>
			<table style='width:100%'>
			  <tr>
				<th>Credit Card Number</th>
				<th>Security Code</th> 
				<th>Owner Name</th>
				<th>Card Type</th>
				<th>Card Address</th>
				<th>Expiry Date</th>				
			  </tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["CCNumber"]."</td><td>".$row["SecNumber"]."</td><td>".$row["OwnerName"]."</td><td>".$row["CCType"]."</td><td>".$row["CCAddress"]."</td><td>".$row["ExpDate"]."</td></tr>";
			}
			echo "</table></div>";
		} else {
			echo "No Result Found";
		}
		echo "<div style='text-align: center; padding-top:15px;'>";
				echo "<h1 style='color:red;'> Total Payment: $".$totalPrice."</h1>";
				echo "<form  action='transactionDetails.php' method='post'><input class='menuBtn' type='submit' value='Checkout' onclick='showMsg();'/></form>";
				echo "</div>";
		$conn->close();
	?>	
	
	
	<script type="text/javascript">
		$(document).ready(function() {

			
		});
		
		function showMsg() {
			alert("Checkout Successfully!");
		}
	</script>
</body>
</html>