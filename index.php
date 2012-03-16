<?php

session_start();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );
$keys = $o->getRequestToken();
//echo APP_ROOT . "callback.php" . "<br>";
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , WEB_ROOT . 'callback.php');

$_SESSION['keys'] = $keys;


?>
<html>
<head>
	<title>拼板工厂-wbpuzzle.com</title>
	<link rel="stylesheet" type="text/css" href="static/css/style.css" media="screen" />
</head>
<div id="welcome_words">
	<div id="welcome_words_left_side">
		<div id="welcome_words_left_side_text">
			<h2>欢迎来到拼板工厂！<br>创建自己的拼板游戏，寻找童年的回忆！</h2>
		</div>
	</div>
	<div id="welcome_words_right_side">
		<a href="<?=$aurl?>" id="login_button"></a>
	</div>
</div>
</html>
