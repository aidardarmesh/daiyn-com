<?php
if (!(empty($_POST['response']))) {
    require('db.php');
    require_once('paysys/kkb.utils.php');
    require("send_mail.php");

    $config_path = 'paysys/config.txt';

    $response = $_POST["response"];
    $result = process_response(stripslashes($response), $config_path);

    $time = date('Y-m-d H:i:s');
    $error = $card = $amount = $currency = $response_code = $approval_code = $reference = null;
    $order_id = empty($result['ORDER_ORDER_ID']) ? null : $result['ORDER_ORDER_ID'];
    if (is_array($result)) {
        if (in_array("ERROR", $result)) {
            $error = "TYPE: $result[ERROR_TYPE], CODE: $result[ERROR_CODE], DATA: $result[ERROR_CHARDATA], TIME: $result[ERROR_TIME]";
            $time = $result['ERROR_TIME'];
        }
        if (in_array("DOCUMENT", $result)) {
            $time = $result['RESULTS_TIMESTAMP'];
            $card = $result['PAYMENT_CARD'];
            $amount = $result['PAYMENT_AMOUNT'];
            $currency = $result['ORDER_CURRENCY'];
            $response_code = $result['PAYMENT_RESPONSE_CODE'];
            $approval_code = $result['PAYMENT_APPROVAL_CODE'];
            $reference = $result['PAYMENT_REFERENCE'];
        }
    } else {
        $error = 'INVALID_RESULT_FORMAT';
    }

    if ($result['CHECKRESULT'] != '[SIGN_GOOD]') {
        $error = $result['CHECKRESULT'];
    }

    $query = <<<QUERY
        UPDATE `orders_epay`
        SET `payment_confirmed`=?,
            `payment_error`=?,
            `payment_card`=?,
            `payment_amount`=?,
            `payment_currency`=?,
            `payment_response_code`=?,
            `payment_approval_code`=?,
            `payment_reference`=?
        WHERE id=?
QUERY;
    $stmt = $conn->prepare($query);

    $stmt->bind_param('sssdisssi', $time, $error, $card, $amount, $currency, $response_code, $approval_code, $reference, $order_id);
    $stmt->execute();

    // SENDING ORDER ID TO USER
    if($order_id != null){
        $result = $conn->query("SELECT email, price, payment_card, created_at, payment_reference, payment_response_code FROM `orders_epay` WHERE id=" . $order_id);
        if($result->num_rows > 0){
            while( $row = $result->fetch_assoc() ){
                $date = date_create($row["created_at"]);
                $year = date_format($date, "Y");
                $month = date_format($date, "n");
                $day = date_format($date, "d");
                $time = date_format($date, "H:i:s");
                switch($month){
                    case "1":
                        $month = "января";
                        break;
                    case "2":
                        $month = "февраля";
                        break;
                    case "3":
                        $month = "марта";
                        break;
                    case "4":
                        $month = "апреля";
                        break;
                    case "5":
                        $month = "мая";
                        break;
                    case "6":
                        $month = "июня";
                        break;
                    case "7":
                        $month = "июля";
                        break;
                    case "8":
                        $month = "августа";
                        break;
                    case "9":
                        $month = "сентября";
                        break;
                    case "10":
                        $month = "октября";
                        break;
                    case "11":
                        $month = "ноября";
                        break;
                    case "12":
                        $month = "декабря";
                        break;
                    default:
                        $month = "none";
                        break;
                }
                $created_at = $day . " " . $month . " " . $year . " г. " . $time;
                send_mail($row["email"], "Номер Вашего заказа", $order_id, $row["price"], $row["payment_card"], $created_at, $row["payment_reference"]);
            }
        }
    }

    // ACTUAL PAYMENT COMPLETING

    $xml = urlencode(process_complete($reference, $approval_code, $order_id, $currency, $amount, $config_path));
    $response = file_get_contents("https://epay.kkb.kz/jsp/remote/control.jsp?$xml");
    $result = process_response(stripslashes($response), $config_path);

    $error = null;
    $order_id = empty($result['PAYMENT_ORDERID']) ? null : $result['PAYMENT_ORDERID'];
    $approved = false;
    if (is_array($result)) {
        if (in_array("ERROR", $result)) {
            $error = "TYPE: $result[ERROR_TYPE], CODE: $result[ERROR_CODE], DATA: $result[ERROR_CHARDATA], TIME: $result[ERROR_TIME]";
            $time = $result['ERROR_TIME'];
        }
        if (in_array("DOCUMENT", $result) && !empty($result['RESPONSE_MESSAGE'])
            && strtolower($result['RESPONSE_MESSAGE']) == 'approved' && !empty($result['COMMAND_TYPE'])
            && strtolower($result['COMMAND_TYPE']) == 'complete') {
            $approved = true;
        }
    } else {
        $error = 'INVALID_RESULT_FORMAT';
    }

    if ($result['CHECKRESULT'] != '[SIGN_GOOD]') {
        $error = $result['CHECKRESULT'];
    }

    $query = 'UPDATE `orders_epay` SET `payment_approved`=NOW(), `approve_error`=? WHERE id=?';
    $stmt = $conn->prepare($query);

    $stmt->bind_param('si', $error, $order_id);
    $stmt->execute();
    $stmt->close();

    echo '0';
}
