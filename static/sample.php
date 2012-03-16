<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<title>微博贴 - WBTie.com </title> 
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" /> 
</head>
<body>
	<div id="wrapper">
		<div style="margin: 0 auto; position: relative; width: 680px">
			<div id="workspace">
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="js/seedrandom.js"></script>
	<script type="text/javascript" src="js/SwipePuzzle.js"></script>
	<script type="text/javascript">
$(function(){
	var puzzle = new SwipePuzzle('#workspace', {
		image : 'http://localhost/swipe-puzzle/static/images/2.jpg',
		blankBg : 'http://localhost/swipe-puzzle/static/css/img/block-bg.png',
		rows : 4,
		cols : 5,
		blockWidth : 100,
		blockHeight:100 
	});

	puzzle.shuffle('cool-');
});
	</script>
</body>
</html>
