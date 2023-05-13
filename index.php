
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  
    <style>
    .error {color: #FF0000;}
    </style>
    
    <?php 
            $nameErr = $emailErr = $subErr = $bodyErr = "";
            $name = $email = $sub = $body = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
            }
            if (empty($_POST["email"])) {
                $emailErr = "Name is required";
            } else {
                $email = test_input($_POST["email"]);
            }
            if (empty($_POST["subject"])) {
                $subErr = "Name is required";
            } else {
                $sub= test_input($_POST["subject"]);
            }
            if (empty($_POST["text"])) {
                $bodyErr = "Name is required";
            } else {
                $body = test_input($_POST["text"]);
            }

            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        sendMail($name,$email,$sub,$body,$emailErr);

  ?>
 
    
</head>
<body>  
    

            <div class="contact" style="align-items:center;color:blue,justify-content:center;" >
                    <!-- form fields -->
                    <h1> Contact us</h1>
                    
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

                        <input type="text" class="form-control form-control-lg"  name="name" placeholder="Name" required>
                        <span class="error"> <?php echo $nameErr;?></span>
                        
                        <input type="email" class="form-control mt-3" placeholder="Email" name="email" required>
                        <span class="error"> <?php echo $emailErr;?></span>
                        
                        <input type="text" class="form-control mt-3" placeholder="Subject" name="subject" required>
                        <span class="error"> <?php echo $subErr;?></span>
                        
                        <div class="mb-3 mt-3">
                            <textarea class="form-control" rows="5" id="comment" name="text" placeholder="Project Details"></textarea>
                        </div>
                        <span class="error"> <?php echo $bodyErr;?></span>
                        <button type="submit" class="btn btn-success mt-3" name="submit" >Contact Me</button>
                    </form>
                    
                    
                </div>


         
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($name,$email,$sub,$body,$emailErr){
    if($email==""){
        $emailErr="please fill email";
        return;
    }

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings

   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPDebug =0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '208r1a05d1@cmrec.ac.in';                     //SMTP username
    $mail->Password   = 'cxqvlmkldhwdtivo';                               //SMTP password
    $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('208r1a05d1@cmrec.ac.in', 'Developers ');
    $mail->addAddress($email, $name);     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<script>alert('Message has been sent');</script>";
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
}

}
?>




</body>

</html>


