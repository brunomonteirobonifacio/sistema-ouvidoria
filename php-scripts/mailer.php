<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                              //Enable verbose debug output
    $mail->isSMTP();                                                                    //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                                        //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                                           //Enable SMTP authentication
    $mail->Username   = 'naoresponda.ouvidoria@outlook.com';                            //SMTP username
    $mail->Password   = 'teste@sistema4Ouvidoria';                                      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                    //Enable implicit TLS encryption
    $mail->Port       = 995;                                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}