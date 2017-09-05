<?php
header("Content-Type:text/html;charset=utf-8");
//定义根目录
define("ROOT_PATH",dirname(__FILE__));
//定义信息输出文件
define("INFO_PATH",ROOT_PATH."/info.php");
//引入配置信息
require ROOT_PATH."/config/profile.inc.php";
//是否开启缓存
define("IS_CACHE",true);
//判断是否开启缓冲区
IS_CACHE ? ob_start():null;
//魔术方法，自动引入类文件
function __autoload($className){
	if(substr($className,-10) =="Controller" ){
		//引入控制器类
		
	}elseif (substr($className,-5) =="Model" ) {
		//引入模型类
		require ROOT_PATH."/model/".strtolower($className).".class.php";
	}else {
		//引入其他类文件
		require ROOT_PATH."/include/".strtolower($className).".class.php";
	}
}
//实例化模板类
$tpl = new Template();

?>