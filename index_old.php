<?php 
// Start YOURLS engine
require_once( dirname(__FILE__).'/includes/load-yourls.php' );	

require 'twitter/tmhOAuth.php';
require 'twitter/tmhUtilities.php';

$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => 'cbTHGGeMDlbJcVJKIeQyKQ',
  'consumer_secret' => '1YVLiA1T0ilUZRJHiTzSL2W8hHwfza4ZDnuwuviCws',
  'user_token'      => '414165112-guUJ1WmlM8y2lH6uZ6OngJxHBv6gq8RRhOCoj5Sk',
  'user_secret'     => 'VWkKds59QmqJ4xRts2s6O4UMDmD1zXkFGAPolTbNyM'
));						

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>little pee boy</title>
	
	<meta property="og:site_name" content="">
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	
	<meta property="og:image" href="">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="image_src" href="">

	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" href="<?php echo YOURLS_SITE; ?>/css/page_style.css">
	

	<script src="<?php echo YOURLS_SITE; ?>/js/libs/modernizr-2.0.min.js"></script>
	<script src="<?php echo YOURLS_SITE; ?>/js/libs/respond.min.js"></script>
</head>
<body>


<div id="container">
	
		<div id="main" role="main">
	
		<?php

	// Part to be executed if FORM has been submitted
	if ( isset($_REQUEST['url']) ) {

		$url     = yourls_sanitize_url( $_REQUEST['url'] );
		$keyword = isset( $_REQUEST['keyword'] ) ? yourls_sanitize_keyword( $_REQUEST['keyword'] ): '' ;
		$title   = isset( $_REQUEST['title'] ) ? yourls_sanitize_title( $_REQUEST['title'] ) : '' ;

		$return  = yourls_add_new_link( $url, $keyword, $title );
		
		$shorturl = isset( $return['shorturl'] ) ? $return['shorturl'] : '';
		$message  = isset( $return['message'] ) ? $return['message'] : '';
		$title    = isset( $return['title'] ) ? $return['title'] : '';
		
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
  			'status' => $shorturl." | #whatwouldstevedo | ".$title
		));	
		
		echo <<<RESULT
		<div id="form">
			
				
				<form method="post" action="">
					<p><label><input type="text" name="url" value="http://" size="20" /></label></p>
					<p><input type="submit" value="Shorten" /></p>
				</form>	
				
		<div id="shorturl"><a href="$shorturl" target="_blank">$shorturl</a></div>
RESULT;

		yourls_mini_share_box( $url, $shorturl, $title );

		echo '</div>';

	// Part to be executed when no form has been submitted
	} else {
	

		echo <<<HTML
		
		<div id="form">
			
				<form method="post" action="">
					<p><label><input type="text" name="url" value="http://" size="20" /></label></p>
					<p><input type="submit" value="Shorten" /></p>
				</form>	
		</div>
HTML;

	}

	?>

	
		</div>

</div><!--! end of #container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

<script src="<?php echo YOURLS_SITE; ?>/js/ZeroClipboard.js?v=<?php echo YOURLS_VERSION; ?>" type="text/javascript"></script>
<script type="text/javascript">ZeroClipboard.setMoviePath( '<?php echo YOURLS_SITE; ?>/js/ZeroClipboard.swf' );</script>
<script src="<?php echo YOURLS_SITE; ?>/js/share.js?v=<?php echo YOURLS_VERSION; ?>" type="text/javascript"></script>

<!-- scripts -->
<script src="js/script.js"></script>
<!-- end scripts-->

<script>
	var _gaq=[['_setAccount','UA-27072252-1'],['_trackPageview']]; 
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>
