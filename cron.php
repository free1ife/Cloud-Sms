<?php 
require dirname(__FILE__).'/init.php';
set_time_limit(0);
$num = $M->getOne("select * from cron");
$num = $num['num'];
$number = $M->getAll("select number from number limit {$num},5");
$count = $M->getOne("select count(*) from number");
foreach($number as $value){
	file_get_contents('http://cloudsmsapi.sinaapp.com/index.php?number='.$value['number']);
}
if($count['count(*)'] - $num <= 5){
	var_dump($M->query("update cron set num = 0 where id = 1"));
}else{
	$num = $num + 5;
	var_dump($M->query("update cron set num = " . $num . " where id = 1"));
}