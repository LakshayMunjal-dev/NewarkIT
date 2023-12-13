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
		<form  action="homepage.php" method="post">
			<input class="menuBtn" type="submit" value="Back to the Home Page"/><br><br>
		</form>
	</div>
	
	<h3><u>My Cart</u></h3>
  
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

		$sql = "SELECT P.PID, P.PName, A.PriceSold, A.Quantity, P.PQuantity, P.Description, T.BID from PRODUCT P, TRANSACTION T, APPEARS_IN A where P.PID = A.PID AND T.BID = A.BID and T.TTag is NULL and T.CID = '".$_SESSION["CID"]."';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table style='width:100%'>
			  <tr>
				<th>Name</th>
				<th>Description</th>
				<th>Price Sold</th>
				<th>Quantity</th>
				<th>Update Quantity</th>
				<th>Delete</th>
			  </tr>";
			$totalPrice = 0;
			while($row = $result->fetch_assoc()) {
				$totalPrice += ($row["PriceSold"] * $row['Quantity']);
				if($row["PQuantity"] > 0 && $row["Quantity"] > 1) {
					echo "<tr><td>".$row["PName"]."</td><td>".$row["Description"]."</td><td>$".$row["PriceSold"]."</td><td>".$row["Quantity"]."</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='submit' value=' + '/></form><form action='lowerQuantityFrom.php' method='post'><input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' - '/></form></td></td><td><form action='removeFrom.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' x '/></form></td></tr>";
				} else if($row["PQuantity"] > 0 && $row["Quantity"] == 1) {
					echo "<tr><td>".$row["PName"]."</td><td>".$row["Description"]."</td><td>$".$row["PriceSold"]."</td><td>".$row["Quantity"]."</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='submit' value=' + '/></form><form action='lowerQuantityFrom.php' method='post'><input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input style='border: gray;' type='submit' value=' - ' disabled='disable'/></form></td></td><td><form action='removeFrom.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' x '/></form></td></tr>";
				} else if($row["PQuantity"] == 0 && $row["Quantity"] > 1) {
					echo "<tr><td>".$row["PName"]."</td><td>".$row["Description"]."</td><td>$".$row["PriceSold"]."</td><td>".$row["Quantity"]."</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input style='border: gray;' type='submit' value=' + ' disabled='disable'/></form><form action='lowerQuantityFrom.php' method='post'><input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' - '/></form></td></td><td><form action='removeFrom.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' x '/></form></td></tr>";
				} else if($row["PQuantity"] == 0 && $row["Quantity"] == 1) {
					echo "<tr><td>".$row["PName"]."</td><td>".$row["Description"]."</td><td>$".$row["PriceSold"]."</td><td>".$row["Quantity"]."</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input style='border: gray;' type='submit' value=' + ' disabled='disable'/></form><form action='lowerQuantityFrom.php' method='post'><input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input style='border: gray;' type='submit' value=' - ' disabled='disable'/></form></td></td><td><form action='removeFrom.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value=' x '/></form></td></tr>";
				}
			}
			echo "</table>";
			
			echo "<div style='text-align: center;'>";
			echo "<h2> Total Price: $".$totalPrice."</h2>";
			echo "<form  action='checkout1.php' method='post'><input class='menuBtn' type='submit' value='Proceed To Checkout'/></form>";
			echo "</div>";
		} else {
			echo "<h3>No Cart Exists, Please choose Start Shopping From main menu and add products in Cart!</h3>";
		}
		$conn->close();
	?>
	</table>
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
	</script>
</body>
</html>