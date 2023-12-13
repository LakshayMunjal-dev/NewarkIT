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
	</div>
	<h3>Checkout</h3>
	<h3><u>Select Shipping Address</u></h3>
	<table style="width:100%">
	  <tr>
		<th>Shipping Address Name</th>
		<th>Recipient Name</th> 
		<th>Address</th> 
		<th>Select</th>
	  </tr>
	  
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

		$sql = "SELECT * FROM `SHIPPING_ADDRESS` WHERE CID = '".$_SESSION["CID"]."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row["SAName"]."</td><td>".$row["RecepientName"]."</td><td>".$row["SNumber"]." ".$row["Street"].", ".$row["City"].", ".$row["Zip"].", ".$row["State"].", ".$row["Country"]."</td><td><form action='addShippingAddress.php' method='post'> <input type='hidden' name='SAName' value='".$row["SAName"]."'/><input type='submit' value='Select'/></form></td></tr>";
			}
			echo "</table>";
		} else {
			echo "No Result Found";
		}
		$conn->close();
	?>
	</table>
	
	
	<script type="text/javascript">
		$(document).ready(function() {

			
		});
		
		function showMsg(pname) {
			alert(pname + " added Successfully in the cart");
		}
	</script>
</body>
</html>