<?php
	session_start();
	include_once( "config.php" );
	include_once( "weibooauth.php" );
	include_once( "tools.php" );
	//get username
	$weibo_client = new WeiboClient(WB_AKEY, WB_SKEY, $_SESSION['last_key']['oauth_token'], $_SESSION['last_key']['oauth_token_secret']);
	$uid = $_SESSION['last_key']['user_id'];
	$user_profile = $weibo_client->show_user($uid);
	$user_name = $user_profile["name"];
	//echo "username: " . $user_profile["name"] . "<br>";
	//print_r($user_profile);
	//end getusername
	$type = $_FILES["file"]["type"];
	$size = $_FILES["file"]["size"];
	$error = $_FILES["file"]["error"];
	if((($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/pjpeg")
		|| ($type == "image/png")) && ($size < 1000000))
	{
		if($error > 0)
		{
			echo "Return Code: " . $error . "<br>";
		} 
		else
		{
			$file_name = time() . ".png";
			$file_path = APP_ROOT . "upload_pic/" . $file_name;
			$tmp_name = $_FILES['file']['tmp_name'];
			$old_pic = null;
			if(($type == "image/jpeg") || ($type == "image/pjpeg"))
			{
				$old_pic = imageCreateFromJPEG($tmp_name);
			}
			else if($type == "image/png")
			{
				$old_pic = imageCreateFromPNG($tmp_name);
			}
			else if($type == "image/gif")
			{
				$old_pic = imageCreateFromGIF($tmp_name);
			}
			$old_width = imageSx($old_pic);
			$old_height = imageSy($old_pic);
			$new_width = PIC_WIDTH;
			$new_height = PIC_HEIGHT;
			$new_pic = imageCreateTrueColor($new_width, $new_height);
			$black_pic = imageColorAllocate($new_pic, 255, 255, 255);
			imageFilledRectangle($new_pic, 0, 0, $new_width, $new_height, $black_pic);
			imageCopyResampled($new_pic, $old_pic, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
			//save new image
			imagePNG($new_pic, $file_path);
			//end save new image
			imageDestroy($new_pic);
			imageDestroy($old_pic);
			
			db_setup();
			$sql = "insert into pic_path values('', '$file_name', '$user_name')"; 
			$result = mysql_query($sql);
			//echo "done!";
			$route = "show.php?" . "pic=$file_name";
			redirect($route);
		}
	}
	else
	{
		echo "<h2>UpLoad invalid</h2>";
	}
?>
