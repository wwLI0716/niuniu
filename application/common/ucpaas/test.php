<?php
require_once 'autoloader.php';
 
$c=new safetyCalls();
$rs= $c->allocNumber('15361032007','18822847673',"831e5eda66cd4fc8a58121c7675feabb");
//$rs= $c->freeNumber("831e5eda66cd4fc8a58121c7675feabb");
echo "<br>返回的值";
var_dump($rs);

?>