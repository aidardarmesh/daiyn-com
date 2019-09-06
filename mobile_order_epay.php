<?php
	if(isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["state"]) ){
		require("db.php");
		require_once("paysys/kkb.utils.php");
		require("create_hash.php");
		require("pages_number.php");
		require("makepdf.php");

		// GETTING FIRST AND ONLY FILE
		if($_POST["state"] == "-2"){
			// MAKING RECORD IN DATABASE
			$stmt = $conn->prepare("INSERT INTO orders_epay (email, phone, price) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $email, $phone, $price);
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			$price = 20;
			$total_pages = 0;
			$stmt->execute();
			$config_path = "paysys/config.txt";
			$currency_id = "398";

			// GETTING ORDER ID BACK
			$order_id = $stmt->insert_id;

			if(mkdir("uploads/" . $order_id)){
				// MOVING FILE INTO DIRECTORY
				$hash = create_hash(8);
				$file_name = basename($_FILES["file"]["name"]);
				$type = $_POST["type"];
				$copies = $_POST["copies"];
				// BECAUSE PNG IS NOT SUPPORTED BY FPDF
				if($type == "png"){
					$hash_dir = "uploads/" . $order_id . "/" . $hash . ".jpeg";
				} else {
					$hash_dir = "uploads/" . $order_id . "/" . $hash . "." . $type;
				}

				if( move_uploaded_file($_FILES["file"]["tmp_name"], $hash_dir) ){
					// PREPARATION OF INSERTING DATA TO DB
					$stmt = $conn->prepare("INSERT INTO files (order_id, name, hash, type, copies, pages) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("isssii", $order_id, $file_name, $hash, $type, $copies, $pages);
					if($type == "pdf"){
						// IDENTIFIYNG NUMBER OF PAGES IN FILE
						$pages = pages_number_pdf($hash_dir);
						$total_pages = $pages * $copies;
					} else if($type == "doc" || $type == "docx"){
						$pages = pages_number_word($hash_dir);
						$total_pages += $pages * $copies;
					} else if($type == "jpg" || $type == "jpeg" || $type == "png"){
						$pages = $copies;
						$total_pages = $copies;
						makepdf($hash_dir, 
								$_POST["padding"],
								$_POST["rotated"],
								$_POST["images_number"],
								$_POST["rel_w"],
								$_POST["rel_h"],
								"uploads/" . $order_id . "/" . $hash . ".pdf");
						$type = "pdf";
					}
					$stmt->execute();
				} else {
					echo "file " . $file_name . " is not moved";
				}

				// TRYING TO FIND FULL PRICE
				$price = $total_pages * 20;

				// UPDATING PRICE OF ORDER ID RECORD
				$sql = "UPDATE `orders_epay` SET `total_pages`=?, `price`=? WHERE id=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('iii', $total_pages, $price, $order_id);
				$stmt->execute();
		    	$stmt->close();

		    	// MAKING XML FOR FRONT
				$content = process_request($order_id, $currency_id, $price, $config_path);

				echo json_encode([
					'email' => $email,
					'signed_order' => $content,
					'order_id' => $order_id,
				]);
			} else {
				echo "impossible to make directory " . $dir;
			}
		} else if($_POST["state"] == "-1"){
			// MAKING RECORD IN DATABASE
			$stmt = $conn->prepare("INSERT INTO orders_epay (email, phone, price) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $email, $phone, $price);
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			$price = 20;
			$total_pages = 0;
			$stmt->execute();

			// GETTING ORDER ID BACK
			$order_id = $stmt->insert_id;

			if(mkdir("uploads/" . $order_id)){
				// MOVING FILE INTO DIRECTORY
				$hash = create_hash(8);
				$file_name = basename($_FILES["file"]["name"]);
				$type = $_POST["type"];
				$copies = $_POST["copies"];
				// BECAUSE PNG IS NOT SUPPORTED BY FPDF
				if($type == "png"){
					$hash_dir = "uploads/" . $order_id . "/" . $hash . ".jpeg";
				} else {
					$hash_dir = "uploads/" . $order_id . "/" . $hash . "." . $type;
				}

				if( move_uploaded_file($_FILES["file"]["tmp_name"], $hash_dir) ){
					// PREPARATION OF INSERTING DATA TO DB
					$stmt = $conn->prepare("INSERT INTO files (order_id, name, hash, type, copies, pages) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("isssii", $order_id, $file_name, $hash, $type, $copies, $pages);
					if($type == "pdf"){
						// IDENTIFIYNG NUMBER OF PAGES IN FILE
						$pages = pages_number_pdf($hash_dir);
						$total_pages = $pages * $copies;
					} else if($type == "doc" || $type == "docx"){
						$pages = pages_number_word($hash_dir);
						$total_pages += $pages * $copies;
					} else if($type == "jpg" || $type == "jpeg" || $type == "png"){
						$pages = $copies;
						$total_pages = $copies;
						makepdf($hash_dir, 
								$_POST["padding"],
								$_POST["rotated"],
								$_POST["images_number"],
								$_POST["rel_w"],
								$_POST["rel_h"],
								"uploads/" . $order_id . "/" . $hash . ".pdf");
						$type = "pdf";
					}
					$stmt->execute();
				} else {
					echo "file " . $file_name . " is not moved";
				}

				// MAKING TXT WITH ORDER_ID AND TOTAL_PAGES FOR THIS ORDER
				file_put_contents("temp/" . $_POST["id_phone"] . ".txt", "ORDER_ID = " . $order_id . "\nTOTAL_PAGES = " . $total_pages);
			} else {
				echo "impossible to make directory " . $dir;
			}
		} else if($_POST["state"] == "0"){
			// GETTING ORDER_ID AND TOTAL_PAGES
			$data = parse_ini_file("temp/" . $_POST["id_phone"] . ".txt");
			$order_id = $data["ORDER_ID"];
			$total_pages = (int)$data["TOTAL_PAGES"];
			$add_total_pages = 0;

			// MOVING FILE INTO DIRECTORY
			$hash = create_hash(8);
			$file_name = basename($_FILES["file"]["name"]);
			$type = $_POST["type"];
			$copies = $_POST["copies"];
			// BECAUSE PNG IS NOT SUPPORTED BY FPDF
			if($type == "png"){
				$hash_dir = "uploads/" . $order_id . "/" . $hash . ".jpeg";
			} else {
				$hash_dir = "uploads/" . $order_id . "/" . $hash . "." . $type;
			}

			if( move_uploaded_file($_FILES["file"]["tmp_name"], $hash_dir) ){
				// PREPARATION OF INSERTING DATA TO DB
				$stmt = $conn->prepare("INSERT INTO files (order_id, name, hash, type, copies, pages) VALUES (?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("isssii", $order_id, $file_name, $hash, $type, $copies, $pages);
				if($type == "pdf"){
					// IDENTIFIYNG NUMBER OF PAGES IN FILE
					$pages = pages_number_pdf($hash_dir);
					$add_total_pages += $pages * $copies;
				} else if($type == "doc" || $type == "docx"){
					$pages = pages_number_word($hash_dir);
					$add_total_pages += $pages * $copies;
				} else if($type == "jpg" || $type == "jpeg" || $type == "png"){
					$pages = $copies;
					$add_total_pages = $copies;
					makepdf($hash_dir, 
							$_POST["padding"],
							$_POST["rotated"],
							$_POST["images_number"],
							$_POST["rel_w"],
							$_POST["rel_h"],
							"uploads/" . $order_id . "/" . $hash . ".pdf");
					$type = "pdf";
				}
				$stmt->execute();
			} else {
				echo "file " . $file_name . " is not moved";
			}

			// UPDATING DATA IN TXT
			$total_pages += $add_total_pages;
			file_put_contents("temp/" . $_POST["id_phone"] . ".txt", "ORDER_ID = " . $order_id . "\nTOTAL_PAGES = " . $total_pages);
		} else if($_POST["state"] == "1"){
			// GETTING ORDER_ID AND TOTAL_PAGES
			$data = parse_ini_file("temp/" . $_POST["id_phone"] . ".txt");
			$order_id = $data["ORDER_ID"];
			$total_pages = (int)$data["TOTAL_PAGES"];
			$add_total_pages = 0;

			// MOVING FILE INTO DIRECTORY
			$hash = create_hash(8);
			$file_name = basename($_FILES["file"]["name"]);
			$type = $_POST["type"];
			$copies = $_POST["copies"];
			// BECAUSE PNG IS NOT SUPPORTED BY FPDF
			if($type == "png"){
				$hash_dir = "uploads/" . $order_id . "/" . $hash . ".jpeg";
			} else {
				$hash_dir = "uploads/" . $order_id . "/" . $hash . "." . $type;
			}

			if( move_uploaded_file($_FILES["file"]["tmp_name"], $hash_dir) ){
				// PREPARATION OF INSERTING DATA TO DB
				$stmt = $conn->prepare("INSERT INTO files (order_id, name, hash, type, copies, pages) VALUES (?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("isssii", $order_id, $file_name, $hash, $type, $copies, $pages);
				if($type == "pdf"){
					// IDENTIFIYNG NUMBER OF PAGES IN FILE
					$pages = pages_number_pdf($hash_dir);
					$add_total_pages += $pages * $copies;
				} else if($type == "doc" || $type == "docx"){
					$pages = pages_number_word($hash_dir);
					$add_total_pages += $pages * $copies;
				} else if($type == "jpg" || $type == "jpeg" || $type == "png"){
					$pages = $copies;
					$add_total_pages = $copies;
					makepdf($hash_dir, 
							$_POST["padding"],
							$_POST["rotated"],
							$_POST["images_number"],
							$_POST["rel_w"],
							$_POST["rel_h"],
							"uploads/" . $order_id . "/" . $hash . ".pdf");
					$type = "pdf";
				}
				$stmt->execute();
			} else {
				echo "file " . $file_name . " is not moved";
			}

			$total_pages += $add_total_pages;
			$price = $total_pages * 20;

			// UPDATING PRICE OF ORDER ID RECORD
			$sql = "UPDATE `orders_epay` SET `total_pages`=?, `price`=? WHERE id=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('iii', $total_pages, $price, $order_id);
			$stmt->execute();
		    $stmt->close();

		    // MAKING XML FOR FRONT
		    $config_path = "paysys/config.txt";
			$currency_id = "398";
			$content = process_request($order_id, $currency_id, $price, $config_path);

			echo json_encode([
				'email' => $_POST["email"],
				'signed_order' => $content,
				'order_id' => $order_id,
			]);

			// DELETING TXT
			unlink("temp/" . $_POST["id_phone"] . ".txt");
		} else {
			echo "state is not set";
		}
	} else {
		echo "404";
	}
