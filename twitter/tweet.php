<?php

/**
 * Tweets a message from the user whose user token and secret you use.
 *
 * Although this example uses your user token/secret, you can use
 * the user token/secret of any user who has authorised your application.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      https://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 3) From the application details page copy the access token and access token
 *      secret into the place in this code marked with (A_USER_TOKEN
 *      and A_USER_SECRET)
 * 4) Visit this page using your web browser.
 *
 * @author themattharris
 */

require 'tmhOAuth.php';
require 'tmhUtilities.php';
$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => '6ohcZIZnKHSEzeWBRytd3w',
  'consumer_secret' => '4CWm4GKfhmn8U1CkckISZKaJdpO4D6XyFTJ0JPeH3A',
  'user_token'      => '437679831-UGp3q8Qv6L08vgL2a9YSuROTkLUOiwZPm3KTZfq5',
  'user_secret'     => 'Z92F0JLhIRaee2uhnI1D0JBqn7I6jQPqTcnqmbZ0FA'
));

$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
  'status' => $_POST['status']
));


/*
if ($code == 200) {
  tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
} else {
  tmhUtilities::pr($tmhOAuth->response['response']);
}
*/



?>