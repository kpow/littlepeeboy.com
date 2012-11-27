<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>little pee boy</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=1000,initial-scale=1">

	<meta property="og:title" content="Little Pee Boy"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://litlepeeboy/"/>
    <meta property="og:image" content="http://littlepeeboy.com/images/peeboy.png"/>
    <meta property="og:site_name" content="Little Pee Boy"/>
    <meta property="og:description"
          content="Let Little Pee Boy help you get your message across. "/>

	<link rel="stylesheet" href="/css/styles.css">

	<script src="/js/libs/modernizr-2.0.min.js"></script>

</head>

<body>
    <div id="preloader">LOADING</div>

    <section id="main-container">


        <div id="content">

            <h1></h1>

            <form  action="" method="post" name="" id="" accept-charset="utf-8">

                <ul class="form-section">

                    <li class="form-line" id="id_1">

                        <!-- removed validate[required]" from classes -->
                        <textarea id="input_1" class="form-textarea" name="message" cols="40" rows="6"></textarea>

                    </li>

                    <li class="form-line clearfix">

                        <span style="float:left;">
                            <label class="form-label-left" id="label_3" for="input_3"></label>

                            <input type="text" class="form-textbox" id="input_3" name="yourEmail" size="20" />
                        </span>
                        <span style="float:right;" >
                            <label class="form-label-left" id="label_4" for="input_4"></label>
                            <input type="text" class="form-textbox" id="input_4" name="theirEmail" size="20" />
                        </span>
                    </li>

                    <li class="form-line">

                        <span style="float:left;">
                            <button id="preview" type="submit" class="preview-button"></button>
                            <button id="submit" type="submit" class="form-submit-button"></button>
                        </span>

                        <span style="float:right;">
                            <label class="form-label-left" id="label_6" for="input_6"></label>
                            <input type="text" class="form-textbox" id="input_6" name="theirTwitter" size="20" />
                        </span>

                    </li>

                </ul>
            </form>
        </div>

        <div id="sprite-container"></div>

        <canvas id="canvas" width="1000" height="600"></canvas>

        <nav id="nav-share">
            <ul>
                <li id="twitter">
                    <a href="https://twitter.com/#!/littlepeeboy" target="_blank"></a>
                </li>
                <li id="facebook">
                    <a href="#"></a>
                </li>
            </ul>
        </nav>
        
        <!-- fgp add -->
        <div id="thank-you" class="sys-msg hidden">
            <p><strong>Thank you for your submission.</strong></p>
            <p><a id="twit-link" href="https://twitter.com/intent/tweet?">Tweet</a></p>
        </div>
        <div id="fblike">
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Flittlebeeboy.com&amp;send=false&amp;layout=button_count&amp;width=300&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:21px;" allowTransparency="true"></iframe>
        </div>
        <div id="audio">
            <a href="#"></a>
        </div>
        <div id="replay" class="hidden">
            <a href="#"></a>
        </div>


        <!--
        <div id="replay-controls" class="sys-msg">
            <a href="#" id="replay" class="ui-button">repee</a><span> | </span>
            <a href="#" id="modify" class="ui-button">modify</a>
            <a href="http://littlepeeboy.com" id="create" class="ui-button hidden">create your own</a>
        </div>
        -->

        <!-- //end fgp add -->

    </section>

    
    <p>Vornona Font</p>

</body>

<script type="text/javascript">
    var rawInput = '<?php echo (isset($_GET['t']) ? $_GET['t'] : null); ?>';
</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.4.min.js"><\/script>')</script>
<script type="text/javascript" src="js/lpb.js"></script>
<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>
</html>
