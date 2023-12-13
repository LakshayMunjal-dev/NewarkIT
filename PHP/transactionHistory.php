?php
session_start();
?>
<html>
<head>
    <title>Online Computer Store</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<style type="text/css">

body {
    background-color: #8A307F;
}
h1, h2 {
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
	
	<h3><u>Transaction History</u></h3>
	<table style="width:100%">
	  <tr>
		<th>Card ID</th>
		<th>Shipping Address Name</th>
		<th>Credit Card</th>
		<th>Transaction Status</th>
		<th>Date</th>
		<th>View Details</th>

		
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

		$sql = "SELECT * FROM TRANSACTION T WHERE T.TTag is NOT NULL and T.CID = '".$_SESSION["CID"]."';";
		$result = $conn->query($sql);

		$ttag = "Getting Transaction Tag:";
		if ($result->num_rows > 0) {
			$totalPrice = 0;
			while($row = $result->fetch_assoc()) {					
				if($row["TTag"] == 'C')
					$ttag = "Checkout";
				else if($row["TTag"] == 'D')
					$ttag = "Delivered";
				else if($row["TTag"] == 'N')
					$ttag = "Not Delivered";
				echo "<tr><td>".$row["BID"]."</td><td>".$row["SAName"]."</td><td>$".$row["CCNumber"]."</td><td>".$ttag."</td><td>".$row["TDate"]."</td><td><form action='viewCartDetail.php' method='post'> <input type='hidden' name='BID' value='".$row["BID"]."'/><input type='submit' value='Show Details'/></form></td></tr>";
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
	</script>
</body>
</html>