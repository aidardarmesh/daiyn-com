<!DOCTYPE html>
<html>
<head>
	<title>qagaz daiyn admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<?php
	require("db.php");
	$sql_files = "SELECT * FROM files WHERE order_id=" . $_GET["order_id"];
	$result_files = $conn->query($sql_files);

	$sql_order = "SELECT * FROM orders_epay WHERE id=" . $_GET["order_id"];
	$result_order = $conn->query($sql_order);
?>

<body>
	<div class="container">
		<h2>Details of order <?php echo $_GET["order_id"] ?></h2>
		<table class="table">
<?php
	if($result_order->num_rows > 0){
		$row = $result_order->fetch_assoc();
		echo "<p>Phone: " . $row["phone"] . "</p>";
		echo "<p>Payment confirmed: " . $row["payment_confirmed"] . "</p>";
		echo "<p>Payment error: " . $row["payment_error"] . "</p>";
		echo "<p>Payment card: " . $row["payment_card"] . "</p>";
		echo "<p>Payment amount: " . $row["payment_amount"] . "</p>";
		echo "<p>Payment approval code: " . $row["payment_approval_code"] . "</p>";
		echo "<p>Payment reference: " . $row["payment_reference"] . "</p>";
		echo "<p>Payment approved: " . $row["payment_approved"] . "</p>";
		echo "<p>Approve error: " . $row["approve_error"] . "</p>";
		echo "<p><a href='/uploads/" . $_GET["order_id"] . "'>Directory</a></p>";
	}
?>
			<tr>
				<td></td>
			</tr>
		</table>
		<h2>Files in order <?php echo $_GET["order_id"] ?></h2>
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Hash</th>
					<th>Type</th>
					<th>Copies</th>
					<th>Pages</th>
					<th>Created at</th>
				</tr>
			</thead>
			<tbody>
<?php
	if($result_files->num_rows > 0){
		while($row_files = $result_files->fetch_assoc()){
			echo "<tr>";
			echo "<td>" . $row_files["id"] . "</td>";
			echo "<td>" . $row_files["name"] . "</td>";
			echo "<td>" . $row_files["hash"] . "</td>";
			echo "<td>" . $row_files["type"] . "</td>";
			echo "<td>" . $row_files["copies"] . "</td>";
			echo "<td>" . $row_files["pages"] . "</td>";
			echo "<td>" . $row_files["created_at"] . "</td>";
			echo "</tr>";
		}
	}
?>
			</tbody>
		</table>
	</div>
</body>
</html>