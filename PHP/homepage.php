<php
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
		<form  action="shop.php" method="post">
			<input class="menuBtn" type="submit" value="Start Shopping"/><br><br>
		</form>
		
		<form  action="basket.php" method="post">
			<input class="menuBtn" type="submit" value="Show the Cart"/><br><br>
		</form>
		
		<form  action="transactionHistory.php" method="post">
			<input class="menuBtn" type="submit" value="Show Transactions"/><br><br>
		</form>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
	
	</script>
</body>
</html>