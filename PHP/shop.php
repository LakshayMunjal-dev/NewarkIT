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
		<form  action="desktop.php" method="post">
			<input class="menuBtn" type="submit" value="Desktop Computers"/><br><br>
		</form>
		<form  action="laptop.php" method="post">
			<input class="menuBtn" type="submit" value="Laptop Computers"/><br><br>
		</form>
		<form  action="printer.php" method="post">
			<input class="menuBtn" type="submit" value="Printers"/><br><br>
		</form>
		<form  action="accessories.php" method="post">
			<input class="menuBtn" type="submit" value="Accessories"/><br><br>
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			
		});
	</script>
</body>
</html>