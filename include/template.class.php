<?php

/**
* 
*/
class Template
{
	public 		$tplFilePath;
	public 		$parFilePath;
	private  	$vars 				= array();

	
	function __construct(){
		if(!is_dir(TPL_PATH)){exit("<h1>配置错误(模板目录不存在)</h1><hr><h3>模板目录templates未建立或未配置。请进行配置。</h3>");}
		if(!is_dir(TPL_C_PATH)){exit("<h1>配置错误(编译目录不存在)</h1><hr><h3>编译目录templates_c未建立或未配置。请进行配置。</h3>");}
		if(!is_dir(CACHE)){exit("<h1>配置错误(缓存目录不存在)</h1><hr><h3>缓存目录cache未建立或未配置。请进行配置。</h3>");}
	}

	public function display($tplFileName){

		$this->tplFilePath = TPL_PATH.$tplFileName;
		if(!file_exists($this->tplFilePath)){exit("<h1>运行错误(模板文件无法找到)</h1><hr><h3>模板文件".$tplFileName."未建立。请建立模板文件并放入相应模板目录中(/templates)。</h3>");}
		$this->parFilePath = TPL_C_PATH.md5($tplFileName).$tplFileName.".php";

		if(1/*!file_exists($this->parFilePath) || filemtime($this->tplFilePath)>filemtime($this->parFilePath)*/){
			$parser = new Parser($this->tplFilePath);
			$parser->compile($this->parFilePath);
		}
		

		require $this->parFilePath;
	}

	public function assign($var,$value){
		if(isset($var) && !empty($var)){
			$this->vars[$var] = $value;
		}else{
			exit("<h1>运行错误(注入变量有误)</h1><hr><h3>变量名未设置或变量名为空。</h3>");
		}
	}
}







?>