<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'composer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'composer/vendor/phpmailer/phpmailer/src/SMTP.php';

function sendEmail($recipientEmail, $recipientName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Cài đặt biến server
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'banhaiduong167@gmail.com';
        $mail->Password   = 'hqyy knyy eeio irdj';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Phần in hóa đơn
        $mail->setFrom('banhaiduong167@gmail.com', 'Hải Dương');
        $mail->addAddress($recipientEmail, $recipientName);

        // Nội dung
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo 'Hóa đơn đã được gửi';
    } catch (Exception $e) {
        echo "Mail không thể gửi, lỗi File: {$mail->ErrorInfo}";
    }
}


function generateEmailBody() {
    ob_start();
    include "view/user/bill.php";
    return ob_get_clean();
}

// Now call your sendEmail function
sendEmail('duongbhph41427@fpt.edu.vn', 'Recipient Name', 'Your Booking Details', "test");
?>
