<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('../../PHPMailer/src/Exception.php');
require('../../PHPMailer/src/PHPMailer.php');
require('../../PHPMailer/src/SMTP.php');
require('../../PHPMailer/src/OAuth.php');

$datos = $_POST;
$direccion = $_POST['direccion'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos, TRUE).PHP_EOL, FILE_APPEND );

$mail = new PHPMailer;                              //Create a new PHPMailer instance
$mail->isSMTP();                                    //Tell PHPMailer to use SMTP

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

$mail->Host = 'smtp.gmail.com';         //Set the hostname of the mail server
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;

$mail->Username = "lgaq94@gmail.com";
$mail->Password = "77375026";
$mail->setFrom($direccion, 'Luis Gallego');       //Set who the message is to be sent from
$mail->addAddress($direccion, 'John Doe');        // Direccion y quien lo envia
$mail->Subject = $asunto;                           // Asunto
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//$msg = "<h1>hola</h1>";
$mail->msgHTML($mensaje);                                                   // Mensaje
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
    echo 0;
} else {
    echo 1;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
//function save_mail($mail)
//{
//    //You can change 'Sent Mail' to any other folder or tag
//    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
//    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
//    $imapStream = imap_open($path, $mail->Username, $mail->Password);
//    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
//    imap_close($imapStream);
//    return $result;
//}

?>