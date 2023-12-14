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
	<h3>Status 
	<?php if($_SESSION["Status"]=="Platinum")
			echo "Platinum";
		  else if ($_SESSION["Status"]=="Gold")
			echo "Gold";
		  else if ($_SESSION["Status"]=="Silver")
			echo "Silver";
		  else if ($_SESSION["Status"]=="Regular")
			echo "Regular";
	?>
	</h3>
	<div style="text-align: center;">
		<form  action="shop.php" method="post">
			<input class="menuBtn" type="submit" value="Back to the Product Page"/><br><br>
		</form>
	</div>
	
	<h3><u>Laptop Computers</u></h3>
	<table style="width:100%">
	  <tr>
		<th>Name</th>
		<th>Price</th> 
		<th>Offer Price</th>
		<th>Description</th>
		<th>CPU Type</th>
		<th>Battery Timing</th>
		<th>Weight</th>
		<th>Buy</th>
	  </tr>
	  
	<?php

		// Create connection
		$conn = new mysqli('localhost', 'root', '', 'NewarkITdb');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT P.PID, PName, PPrice, OfferPrice, Description, CPUType, BType, Weight from (Product P,Computer C, Laptop L) LEFT JOIN OFFER_PRODUCT O ON P.PID = O.PID where PType='Laptop' and P.PID = C.PID and C.PID = L.PID and PQuantity > 0";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['OfferPrice'] == null) {
					echo "<tr><td>".$row["PName"]."</td><td>$".$row["PPrice"]."</td><td>N/A</td><td>".$row["Description"]."</td><td>".$row["CPUType"]."</td><td>".$row["BType"]." min</td><td>".$row["Weight"]."lb</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='submit' value='Add to Cart' onclick='showMsg(".'"'.$row["PName"].'"'.");'/></form></td></tr>";
				} else {
					echo "<tr><td>".$row["PName"]."</td><td>$".$row["PPrice"]."</td><td>$".$row["OfferPrice"]."</td><td>".$row["Description"]."</td><td>".$row["CPUType"]."</td><td>".$row["BType"]." min</td><td>".$row["Weight"]."lb</td><td><form action='addTo.php' method='post'> <input type='hidden' name='PID' value='".$row["PID"]."'/><input type='submit' value='Add to Cart' onclick='showMsg(".'"'.$row["PName"].'"'.");'/></form></td></tr>";
				}
			}
			echo "</table>";
		} else {
			echo "No Result Found";
		}
		echo "<br><p>*Offer Price is only applicable to Gold and Platinum customers</p>";
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