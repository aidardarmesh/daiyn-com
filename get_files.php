<?php
	require("db.php");

	if( isset($_POST["order_number"]) && isset($_POST["name"]) ){
		$data = [];
		$files = [];
		$counter = 0;

		// CHECKING IF TERMINAL IS REGISTERED SYSTEM
		$sql = "SELECT id FROM terminals WHERE name='" . $_POST["name"] . "'";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			// TERMINAL IS REGISTERED
			// CHECKING IF ORDER EXISTS
			$sql = "SELECT total_pages FROM orders_epay WHERE id=" . $_POST["order_number"];
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				// ORDER EXISTS
				$row = $result->fetch_assoc();
				$data["total_pages"] = $row["total_pages"];

				// GETTINGS FILES
				$sql = "SELECT hash, type, copies, pages FROM files WHERE order_id=" . $_POST["order_number"];
				$result = $conn->query($sql);

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
			        	$files[$counter]["hash"] = $row["hash"];
			        	$files[$counter]["type"] = $row["type"];
			        	$files[$counter]["copies"] = $row["copies"];
			        	$files[$counter]["pages"] = $row["pages"];
			        	$counter++;
			    	}
			    	$data["files"] = $files;
				}
			} else {
				// ORDER DOES NOT EXIST
				$data["total_pages"] = 0;
				$data["files"] = [];
			}

			// SENDING DATA BACK
			echo json_encode($data);
			$conn->close();
		} else {
			// TERMINAL IS NOT REGISTERED
			echo "0";
		}
	} else {
		echo "404";
	}