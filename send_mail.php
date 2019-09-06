<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require "phpmailer/src/PHPMailer.php";
	require "phpmailer/src/Exception.php";
	require "phpmailer/src/SMTP.php";

	function send_mail($recipient, $subject, $order_id, $price, $payment_card, $created_at, $payment_reference){
		$mail = new PHPMailer(true);

		try{
			// SETTINGS
			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "qagaz.daiyn@gmail.com";
			$mail->Password = "fc4ZPszk";
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;

			// RECIPIENTS
            $mail->CharSet = "UTF-8";
			$mail->setFrom("qagaz.daiyn@gmail.com", "Сервис печатающих терминалов qagaz daiyn");
			$mail->addAddress($recipient);

			// CONTENT
			$mail->isHTML(true);
			$mail->Subject = $subject;
$mail->Body = <<<MESSAGE
<meta charset="utf-8">
<table cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#f1f1f1" border="0">
    <tbody>
        <tr>
            <td style="font-size:0;line-height:0" colspan="5" height="32">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="center">
                <table cellpadding="0" cellspacing="0" width="550" bgcolor="#ffffff" border="0">
                    <tbody><tr>
                        <td style="font-size:0;line-height:0" colspan="5">
                            <img src="https://daiyn.com/images/top.jpg" alt="image description" height="20" width="100%" border="0">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="30">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td colspan="3" valign="top" width="495">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody><tr>
                                    <td style="font:12px/22px Arial,san-serif;color:#000000;white-space:nowrap" valign="top"></td>
                                    <td style="font-size:0;line-height:0" align="right">
                                        <a href="https://daiyn.com/" target="_blank">
                                            <img src="https://daiyn.com/images/mail_logo.png" alt="Logo" border="0">
                                        </a>
                                    </td>
                                    <td style="font-size:0;line-height:0" width="35">&nbsp;</td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="30">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:28px/28px Arial,san-serif;color:#000" width="440"><b>Квитанция</b></td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="11">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:14px/19px Arial,san-serif;color:#010101" width="440">Благодарим Вас за успешный платеж на сайте <a style="color:#5585e5" href="https://daiyn.com/" target="_blank">daiyn.com</a>.</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="40" align="center">
                            <img src="https://daiyn.com/images/border.jpg" alt="image description" height="2" width="500" border="0">
                        </td>
                    </tr>
                        <tr>
                            <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                            <td style="font:10px/18px Arial,san-serif;color:#a3a3a3" width="440">НОМЕР ЗАКАЗА:</td>
                            <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                            <td style="font:18px/18px Tahoma,Geneva,sans-serif;color:#010101" width="440">$order_id</td>
                            <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="15">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:10px/18px Arial,san-serif;color:#a3a3a3" width="440">СУММА:</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:18px/18px Tahoma,Geneva,sans-serif;color:#010101" width="440">$price KZT</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="15">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:10px/18px Arial,san-serif;color:#a3a3a3" width="440">КАРТА:</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:18px/18px Tahoma,Geneva,sans-serif;color:#010101" valign="top" width="440"><img src="https://daiyn.com/images/visa.jpg" alt="image description" border="0"> $payment_card</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="15">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:10px/18px Arial,san-serif;color:#a3a3a3" width="440">ДАТА И ВРЕМЯ:</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:18px/18px Tahoma,Geneva,sans-serif;color:#010101" valign="top" width="440">$created_at</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="15">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td width="440">
                            <a href="https://vk.com/qagaz.daiyn" target="_blank"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/vk_grey.png"></a>
                            <a href="https://t.me/qagazdaiyn"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/tg_grey.png"></a>
                            <a href="https://www.youtube.com/channel/UCdVdMUEZ9LGwyoWQ_3UYBHA" target="_blank"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/youtube_grey.png"></a>
                            <a href="https://www.instagram.com/qagaz.daiyn/" target="_blank"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/inst_grey.png"></a>
                            <a href="https://api.whatsapp.com/send?phone=77086273347"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/wp_grey.png"></a>
                            <a href="https://www.facebook.com/qagaz.daiyn/" target="_blank"><img style="vertical-align: middle;margin-right: 20px;" src="https://daiyn.com/images/fb_grey.png"></a>
                        </td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="40" align="center">
                            <img src="https://daiyn.com/images/border.jpg" alt="image description" height="2" width="500" border="0">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:13px/17px Tahoma,Geneva,sans-serif;color:#585858" width="440" align="center">Если у Вас возникли дополнительные вопросы, служба поддержки <a style="color:#5585e5" href="https://daiyn.com/" target="_blank">daiyn.com</a> с радостью на них ответит, для этого вам могут потребоваться следующие данные:</td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="17">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                        <td style="font:13px/17px Tahoma,Geneva,sans-serif;color:#585858" width="440" align="center">
                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td style="font:10px/14px Arial,san-serif;color:#a3a3a3" width="440" align="center">РЕФЕРЕНС: <br> <b style="font:bold 13px/18px Tahoma,Geneva,sans-serif;color:#585858">$payment_reference</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2" style="font-size:0;line-height:0" width="55">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5" height="25">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:0;line-height:0" colspan="5">
                            <img src="https://daiyn.com/images/bottom.jpg" alt="image description" height="18" width="100%" border="0">
                        </td>
                    </tr>
                    <tr bgcolor="f1f1f1">
                        <td style="font-size:0;line-height:0" colspan="5" height="9">&nbsp;</td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <tr>
            <td style="font-size:0;line-height:0" colspan="5" height="32">&nbsp;</td>
        </tr>
    </tbody>
</table>
MESSAGE;

			// SEND
			$mail->send();
		} catch(Exception $e){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}