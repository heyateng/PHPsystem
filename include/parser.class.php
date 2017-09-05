<?php

/**
* 	
*/
class Parser
{
	public $tplFilePath;
	public $tplContents;
	
	function __construct($tplFilePath){
		$this->tplFilePath = $tplFilePath;
		$this->tplContents = file_get_contents($this->tplFilePath);
	}

	public function compile($parFilePath){

		$this->parVar();
		$this->parIf();
		$this->parSwitch();
		$this->parInclude();
		$this->parComment();
		$this->parForEach();

		file_put_contents($parFilePath,$this->tplContents);
	}

	private function parVar(){
		$pattern = "/\{\\$(\w+)\}/";
		$this->tplContents = preg_replace($pattern,'<?php echo $this->vars[\'$1\'] ?>',$this->tplContents);
	}

	private function parIf(){
		$patternIf = "/\{if\s+\\$(\w+)\}/i";
		$patternEndIf = "/\{\/if\}/i";
		$patternElse = "/\{else\}/i";
		if(preg_match($patternIf,$this->tplContents)){
			if(preg_match($patternEndIf,$this->tplContents)){
				$this->tplContents = preg_replace($patternIf,'<?php if($this->vars[\'$1\']){ ?>',$this->tplContents);
				$this->tplContents = preg_replace($patternEndIf,'<?php } ?>',$this->tplContents);
				if(preg_match($patternElse,$this->tplContents)){
					$this->tplContents = preg_replace($patternElse,'<?php }else{ ?>',$this->tplContents);
				}
			}else{
				exit("<h1>运行错误(模板标签不正确)</h1><hr><h3>If模板标签未正确使用。请进行检查。</h3>");
			}
		}
	}

	private function parSwitch(){
		$patternSwitch = "/\{switch\s+\\$(\w+)\}/i";
		$patternCase = "/\{case\s+(\w+)\}/i";
		$patternBreak = "/\{\/case\}/i";
		$patternDefault = "/\{default\}/i";
		$patternDefaultEnd = "/\{\/default\}/i";
		$patternEndSwitch = "/\{\/switch\}/i";
		$patternBug = "/\{switch\s+\\$(\w+)\}\s*\{case/i";
		if(preg_match($patternSwitch,$this->tplContents)){
			$correct = preg_match($patternSwitch,$this->tplContents) && preg_match($patternCase,$this->tplContents) && preg_match($patternBreak,$this->tplContents) && preg_match($patternEndSwitch,$this->tplContents);
			if($correct){
				$this->tplContents = preg_replace($patternBug,'{switch $$1}{case',$this->tplContents);
				$this->tplContents = preg_replace($patternSwitch,'<?php switch($this->vars[\'$1\']){ ?>',$this->tplContents);
				$this->tplContents = preg_replace($patternCase,'<?php case \'$1\':?>',$this->tplContents);
				$this->tplContents = preg_replace($patternBreak,'<?php break;?>',$this->tplContents);
				$this->tplContents = preg_replace($patternEndSwitch,'<?php } ?>',$this->tplContents);
				if(preg_match($patternDefault,$this->tplContents)){
					$this->tplContents = preg_replace($patternDefault,'<?php default:?>',$this->tplContents);
				}
				if(preg_match($patternDefaultEnd,$this->tplContents)){
					$this->tplContents = preg_replace($patternDefaultEnd,'',$this->tplContents);
				}
			}else{
				exit("<h1>运行错误(模板标签不正确)</h1><hr><h3>Switch模板标签未正确使用。请进行检查。</h3>");
			}
		}
	}

	private function parInclude(){
		$patternInclude = "/\{include\s+(\'|\")([\w\.]+)(\'|\")\}/i";
		//preg_match($patternInclude,$this->tplContents,$h);
		if(preg_match($patternInclude,$this->tplContents)){
			$this->tplContents = preg_replace($patternInclude,"<?php include \"$2\"; ?>",$this->tplContents);
		}
	}

	private function parComment(){
		$patternComment = "/\{\#(.*)\#\}/";
		//preg_match($patternComment,$this->tplContents,$h);
		if(preg_match($patternComment,$this->tplContents)){
			$this->tplContents = preg_replace($patternComment,"<?php /*$1*/ ?>",$this->tplContents);
		}
	}

	private function parForEach(){
		$patternForEachStart = "/\{foreach\s+\\$(\w+)=>\\$(\w+)\}/i";
		$patternForEachEnd = "/\{\/foreach\}/i";
		$patternVar = "/\{\@(\w+)\}/";
		//preg_match($patternVar,$this->tplContents,$h);
		//print_r($h);
		if(preg_match($patternForEachStart,$this->tplContents)){
			$correct = preg_match($patternForEachStart,$this->tplContents) && preg_match($patternForEachEnd,$this->tplContents);
			if($correct){
				$this->tplContents = preg_replace($patternForEachStart,'<?php foreach ($this->vars[\'$1\'] as $$2){ ?>',$this->tplContents);
				$this->tplContents = preg_replace($patternForEachEnd,"<?php } ?>",$this->tplContents);
				if(preg_match($patternVar,$this->tplContents)){
					$this->tplContents = preg_replace($patternVar,"<?php echo $$1; ?>",$this->tplContents);
				}
			}else{
				exit("<h1>运行错误(模板标签不正确)</h1><hr><h3>forEach模板标签未正确使用。请进行检查。</h3>");
			}
		}
	}
}






?>