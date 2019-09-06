<?php
	if(isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["data"])){
		require("db.php");
		require_once("paysys/kkb.utils.php");
		require("create_hash.php");
		require("pages_number.php");

		// MAKING RECORD IN DATABASE
		$stmt = $conn->prepare("INSERT INTO orders_epay (email, phone, price) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $email, $phone, $price);
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$price = 20;
		$stmt->execute();
		$config_path = "paysys/config.txt";
		$currency_id = "398";

		// GETTING ORDER ID BACK
		$order_id = $stmt->insert_id;

		// MAKING DIRECTORY AND PLACING FILES THERE
		$dir = "uploads/" . $order_id . "/";
		if(mkdir($dir)){
			// DECODING DATA JSON
			$data = (array)json_decode($_POST["data"]);

			// COUNTER
			$counter = 0;

			// TOTAL PAGES
			$total_pages = 0;

			// MOVING FILES INTO DIRECTORY
			foreach($data as $key => $child){
				// CREATING FUTURE NAME OF FILE
				$hash = create_hash(8);
				$file_name = basename($_FILES["files"]["name"][$counter]);
				$hash_dir = $dir . $hash . '.' . $child->type;

				// ACTUAL FILE MOVE
				if(move_uploaded_file($_FILES["files"]["tmp_name"][$counter], $hash_dir)){
					// PREPARATION OF INSERTING DATA TO DB
					$stmt = $conn->prepare("INSERT INTO files (order_id, name, hash, type, copies, pages) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("isssii", $order_id, $file_name, $hash, $child->type, $child->copies, $pages);
					if($child->type == "pdf"){
						// IDENTIFIYNG NUMBER OF PAGES IN FILE
						$pages = pages_number_pdf($hash_dir);
						$total_pages += $pages * $child->copies;
					} else if($child->type == "doc" || $child->type == "docx"){
						$pages = pages_number_word($hash_dir);
						$total_pages += $pages * $child->copies;
					}
					$stmt->execute();
				} else {
					echo "file " . $file_name . " is not moved";
				}
				$counter++;
			}

			// COUNTING TOTAL PRICE
			$price = $total_pages * 20;

			// UPDATING PRICE OF ORDER ID RECORD
			$sql = "UPDATE `orders_epay` SET `total_pages`=?, `price`=? WHERE id=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('iii', $total_pages, $price, $order_id);
			$stmt->execute();
	    	$stmt->close();
		} else {
			echo "impossible to make directory " . $dir;
		}

		// MAKING XML FOR FRONT
		$content = process_request($order_id, $currency_id, $price, $config_path);

		echo json_encode([
			'email' => $email,
			'signed_order' => $content,
			'order_id' => $order_id,
		]);
	} else {
		echo '404';
	}