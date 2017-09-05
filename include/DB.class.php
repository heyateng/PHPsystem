<?php 

/**
* 
*/
class DB
{

	public static function getDB(){
		@$mysqli = new mysqli(DB_HOST,DB_NAME,DB_PASS,DB_SDBS);
		if(mysqli_connect_errno()){
			echo "数据库连接错误。错误信息：".mysqli_connect_error();
			exit();
		}else{
			$mysqli->set_charset("utf8");
			return $mysqli;
		}
		
	}

	public static function unDB(&$result,&$db){
		if(is_object($result)){
			$result->free();
		}
		$result = null;
		if(is_object($db)){
			$db->close();
		}
		$db = null;
	}

}




?>