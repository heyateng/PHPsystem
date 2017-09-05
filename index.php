<?php

require dirname(__FILE__)."/init.inc.php";
//global $tpl;

$name = "liyanhui";
$tpl->assign("name",$name);
$tpl->assign("a",5>4);
$tpl->assign("hyt","");
$colors = array("red","green","blue","yellow"); 
$tpl->assign("color",$colors);
$tpl->display("index.tpl");

?>

