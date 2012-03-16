<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>拼板工厂！-wbpuzzle.com</title>
	<link rel="stylesheet" type="text/css" href="static/css/style.css" media="screen" />
</head>
<body>
<?php
	require_once("config.php");
	require_once("tools.php");
	db_setup();
	//echo "<h1>show.php works!</h1>";
	$file_name = $_GET["pic"];
	$sql = "select creater from pic_path where name='$file_name'";
	$result = mysql_query($sql);
	$creater = mysql_result($result, 0, 0);
	if(empty($creater))
	{
		$creater = "有心人士";
	}
	//$creater = isset($_GET['creater']) ? $_GET["creater"] : "有心人士";
	//session_start();
	//echo PIC_ROOT . $file_name . "<br>";
?>
<div id="wrapper">
	<div style="margin: 0 auto; position: relative; width: 680px; height: 450px">
		<div id="workspace">
		</div>
	</div>
	<?php if(isset($_SESSION["last_key"])): ?>
	<div id="words_is_login" style="margin: 0 auto; width: 680px">
		<span style="color: blue">创建成功！您的拼板游戏出炉啦</span><br>
		赶快分享给好友！<input type="text" style="width: 500px; background: #F5F5F5" value="<?php echo WEB_ROOT . "show.php?" . "pic=$file_name"?>"/><br>
		<a href="<?php echo WEB_ROOT . "share_puzzle.php?" . "file_name=$file_name"; ?>">分享到我的微博</a>
	</div>
	<?php else: ?>
	<div id="words_not_login" style="margin: 0 auto; width: 680px">
		<span style="color: blue">此拼板由<?php echo $creater; ?>创建</span><br>
		<span style="color: red"><a href="<?php echo WEB_ROOT . "index.php"; ?>">啊啊！我也要创建我的拼板！</a></span>
	</div>
	<?php endif; ?>
</div>
<script type="text/javascript" src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="static/js/seedrandom.js"></script>
<script type="text/javascript" src="static/js/SwipePuzzle.js"></script>
<script type="text/javascript">
	$(function()
	{
		var puzzle = new SwipePuzzle('#workspace', {
			image : '<?php echo PIC_ROOT . $file_name; ?>',
			blankBg : '<?php echo WEB_ROOT . "static/css/img/block-bg.png"; ?>',
			rows : 4,
			cols: 5,
			blockWidth : 100,
			blockHeight : 100
		});
		puzzle.shuffle("cool-");
	});
</script>

<!--<img src="<?php echo PIC_ROOT . $file_name; ?>" width="500px" height="400px" /> -->
</body>
</html>
