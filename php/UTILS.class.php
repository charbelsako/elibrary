<?php

class UTILS{

	public static function write_log($message) {

		$str= "\n".date("Y-m-d H:i:s")." : " .$message;
		file_put_contents('log.txt', $str, FILE_APPEND);
	}
	
	public static function check_permission()
	{
		session_start();
	
		if(!isset($_SESSION['permission']))
			header('Location: index.php');
		elseif($_SESSION['permission']!=2)
				header('Location: index.php');
		
	}
	
}
?>