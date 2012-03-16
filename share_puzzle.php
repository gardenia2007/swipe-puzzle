<?php
	require_once("config.php");
	require_once("weibooauth.php");
	require_once("tools.php");
	session_start();
	db_setup();
	$weibo_client = new WeiboClient(WB_AKEY, WB_SKEY, $_SESSION['last_key']['oauth_token'], $_SESSION['last_key']['oauth_token_secret']);
	$file_name = $_GET["file_name"];
	$new_weibo = "我通过拼板工厂http://www.wbpuzzle.com创建了一个新的拼板游戏，赶快挑战一下，寻找童年的回忆！";
	$sql = "select creater from pic_path where name='$file_name'";
	$result = mysql_query($sql);
	$creater = mysql_result($result, 0, 0);
	//echo $creater . "<br>";
	$puzzle_url = WEB_ROOT . "show.php?" . "pic=$file_name";
	$new_weibo = $new_weibo . $puzzle_url;
	//echo $new_weibo . $puzzle_url;
	$weibo_client->update($new_weibo);
	$route = "show.php?" . "pic=$file_name";
	redirect($route);
?>
