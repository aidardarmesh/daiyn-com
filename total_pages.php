<?php
	require("db.php");

	$sql = "SELECT total_pages FROM orders_epay WHERE id=24";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		echo $row["total_pages"];
	}