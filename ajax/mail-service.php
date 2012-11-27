<?php

/***** FILE INFO *********

File:       /ajax/mail-service.php

Client:     Martin Agency
Project:    Little Pee Boy

Create:     2011-12-15
By:         FGP

Create:     2011-12-15
By:         FGP


**************************/

// DEBUG
//error_log('(mail-service.php) Mail Processing Log: ENTER SCRIPT',0);

if(isset($_POST['s']) &&
   isset($_POST['r']) &&
   isset($_POST['u'])){

    $ip           = $_SERVER['REMOTE_ADDR'];
    $sender       = $_POST['s']; // SENDER
    $recipient    = $_POST['r']; // RECIPIENT
    $shortUrl     = $_POST['u']; // SHORT_URL


    /* DEBUG
    error_log('(mail-service.php) Mail Processing Log: IP = '. $ip,0);
    error_log('(mail-service.php) Mail Processing Log: SENDER = '.$sender,0);
    error_log('(mail-service.php) Mail Processing Log: EMAIL = '.$recipient,0);
    error_log('(mail-service.php) Mail Processing Log: MSG = '.$shortUrl,0);
    */

    // TODO - SCRUB MESSAGE VARIABLES $sender, $recipient

    $to      = $sender;  //'fpadgett@gmail.com';

    $subject = "Someone pee'd on you";

    ////////////////////////////////////////////////////
    //
    // $message = 'FROM: '.$name.'\r\n'.'\r\nMESSAGE:\r\n'.$msg.'\r\nIP ADDRESS:\r\n'+$ip;
    //
    // Works without IP Addy, but not with the variable.  (see above) ( this is a brilliant statment... lol )
    //
    // Returns a 0 (zero). I think it has something to do with
    // the local machine dev environment.
    //
    //////////////////////////////////////////////////

    /*



    */


    $message    = 'FROM: ' . $sender . "\n";
    $message    .= 'URL: ' . $shortUrl . "\n";
    $message    .= 'MESSAGE:'."\n";
    $message    .=  wordwrap($msg,70);

    $headers    = 'From: ' . $sender . "\r\n" .
                  'Reply-To: ' . $email . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();

    try{
        mail($to, $subject, $message, $headers);
        error_log('(mail-service.php) Mail Processing Log: '.$message, 0);
        echo 1;
    }
    catch (Exception $e){
        error_log('(mail-service.php) Mail Processing Error: ' . $e->getMessage(), 0);
        echo -2;
    }


}

else {
    echo(-1);
}



?>
