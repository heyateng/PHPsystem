<?php 
global $tpl;

//使用过程化的方法操作数据库
$manage = new manageModel();
print_r($manage->getManage());

$tpl->display("main.tpl");
?>