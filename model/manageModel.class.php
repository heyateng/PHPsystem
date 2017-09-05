<?php 

/**
* 管理员实体类
*/
class manageModel
{
	
	public function __construct(){
		# code...
	}

	//查询所有管理员
	public function getManage(){
		$db = DB::getDB();
		$sql = "SELECT * FROM cms_manage";
		$result = $db->query($sql);
		while ($result->fetch_object()) {
			$html[] = $result->fetch_object();
		}
		DB::unDB($result,$db);
		return $html;
	}

	//新增管理员
	public function addManage(){
		$db = DB::getDB();
		$sql = "SELECT * FROM cms_manage";
		$result = $db->query($sql);
		while ($result->fetch_object()) {
			$html[] = $result->fetch_object();
		}
		DB::ubDB($result,$db);
		return $html;
	}

	//修改管理员
	public function updateManage(){

	}

	//删除管理员
	public function deleteManage(){
		
	}
}








?>