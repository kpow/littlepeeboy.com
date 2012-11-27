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
//error_log('(twitter-intent-proxy.php) Mail Processing Log: ENTER SCRIPT',0);

// Retrieve IP Address for Audit, SPAM blocking, and Honeypot
$ip = $_SERVER['REMOTE_ADDR'];

// get query string data
$twintent =$_SERVER['QUERY_STRING'];
 
// redirect to twintent 
//header( "Location: https://twitter.com/intent/tweet?$twintent" ) ;

header( 'Location: http://www.twitter.com/intent/tweet?'.$twintent);

?>