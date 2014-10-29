<?php 
if(defined('SAE_MYSQL_USER')){
	define('DB_HOST',SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT);
	define('DB_USER',SAE_MYSQL_USER);
	define('DB_PASS',SAE_MYSQL_PASS);
	define('DB_NAME',SAE_MYSQL_DB);
}else{
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_NAME','sms');
}
$M = new mysql();
$M->connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
