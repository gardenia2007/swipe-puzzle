<html>
<head>
<title>拼板工厂-wbpuzzle.com</title>
<link rel="stylesheet" type="text/css" href="static/css/style.css" media="screen" />
<style type="text/css">
	#file
	{
		background: #F5F5F5;
	}
</style>
<head>
<body>
	<div id="create_area">
		<div id="create_area_top_area">
			<h2 style="padding-top: 10px; color: blue"><ins>授权完成,来创建你自己的拼板游戏吧</ins></h2>
		</div>
		<div id="create_area_bottom_area">
    		<form action="upload_and_create.php" method="post" enctype="multipart/form-data">
				<label for="file">图片名称：</label>
				<input type="file" name="file" id="file" /><br><br>
				<input type="submit" name="submit" value="出来吧！我的拼板！" />
    		</form>
		</div>
	</div>
</body>
</html>
