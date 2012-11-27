<?php

/***** FILE INFO *********

File:       /services/mail-service.php

Client:     Martin Agency
Project:    Little Pee Boy

Create:     2011-12-15
By:         FGP

Update:     2011-12-16
By:         FGP

Change Log:

[2011-12-16 FGP] Modified process to craft a multi-part message

**************************/

// DEBUG
//error_log('(mail-service.php) Mail Processing Log: ENTER SCRIPT',0);

// Retrieve IP Address for Audit, SPAM blocking, and Honeypot
$ip = $_SERVER['REMOTE_ADDR'];

if( isset($_POST['s']) &&
    isset($_POST['r']) &&
    isset($_POST['u']) ){

    // Config

	$sender         = $_POST['s']; // SENDER
	$recipient      = $_POST['r']; // RECIPIENT
	$shortUrl       = $_POST['u']; // SHORT_URL
	$subject        = "A message from Little Pee Boy"; // SUBJECT LINE

	$email_html     = "<h1>Little Pee Boy has something to tell you</h1><p>Read your message here: <a href=3D\"$shortUrl\" target=3D\"_blank\">$shortUrl</a></p>";

	$email_plain    = "Little Pee Boy has something to tell you\n\nGet you message here: $shortUrl\n";

		
	/* YOU NEED CONFIGURE NOTHING MORE!!!! (Apart from the respond at the very bottom of this script!) */

	//# Is the OS Windows or Mac or Linux
	if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
	    $eol =  "\r\n";
	} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
	    $eol =  "\r";
	} else {
	    $eol =  "\n";
	}

	// Subject 
	$_emailer_subject = $subject;

	// Addressing
	$_emailer_to        = $recipient;
	$_emailer_from      = $sender;
	$_emailer_reply_to  = $sender;
	$_emailer_cc        = ''; //Optional
	$_emailer_bcc       = ''; //Optional

	$_emailer_subject = $_emailer_subject == '' ? 'No Subject' : $_emailer_subject; // Must have a subject
	if(!empty($_emailer_cc))
	    $_emailer_cc_do = "Cc: ".substr( $_emailer_cc , 0 , -2 ).$eol; // Remove the trailing ", "
	if(!empty($_emailer_bcc))
	    $_emailer_bcc_do = "Bcc: ".substr( $_emailer_bcc , 0 , -2 ).$eol;
	$_emailer_reply_to = $_emailer_reply_to == '' ? $_emailer_from : $_emailer_reply_to;
	$mid = md5( uniqid( time() ) ); // Generate a unique id for the email
	$host = str_replace( 'www' , '' , $_SERVER['HTTP_HOST'] ); // Remove the www for an "email address"

	//add From: header
	$headers = "From: $_emailer_from$eol";
	//specify MIME version 1.0
	$headers .= "Return-Path: $_emailer_reply_to$eol";
	$headers .= "$_emailer_cc_do";
	$headers .= "$_emailer_bcc_do";
	$headers .= "MIME-Version: 1.0$eol";
	$headers .= "Message-ID: <$mid@$host>$eol";
	$headers .= "X-Priority: 3$eol";
	$headers .= "X-MSMail-Priority: Normal$eol";
	$headers .= "X-Mailer: PHP$eol";
	$headers .= "Date: " . gmdate('D, d M Y H:i:s Z' , time() ) . $eol;

	//unique boundary this can be whatever you want... but try and make it imaginative :)
	$boundary = uniqid("littlepeeboy");

	//tell e-mail client this e-mail contains//alternate versions
	$headers .= "Content-type: multipart/alternative; boundary=\"$boundary\"".$eol.$eol;

	//plain text version of message
	$body = "--$boundary".$eol."Content-Type: text/plain; charset=\"ascii\"".$eol."Content-transfer-encoding: 8bit".$eol.$eol;
	$body .= $email_plain.$eol.$eol;

	//HTML version of message
	$body .= "--$boundary".$eol."Content-Type: text/html; charset=\"ascii\"".$eol."Content-Transfer-Encoding: quoted-printable".$eol.$eol;
	//$body .= chunk_split("$email_html").$eol.$eol;
	$body .= $email_html.$eol.$eol;
	# Finished
	$body .= "--$boundary--".$eol.$eol;  // finish with two eol's for better security.
	//send message
	
    try{

    	mail($_emailer_to, $_emailer_subject, $body, $headers);
        error_log('(mail-service.php) Mail Processing Log: Mail Sent', 0);
        echo 1;

        /*echo $body;*/
    }
    catch (Exception $e){
        error_log('(mail-service.php) Mail Processing Error: ' . $e->getMessage(), 0);
        echo -2;
    }
}

else {
    error_log('(mail-service.php) [SECURITY VIOLATION] Mail script access with improper post data. [IP: '.$ip.' ]', 0);
    echo -1;
}



?>
