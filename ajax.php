<?php 
header('Content-type:text/html;chaset=utf-8');
require dirname(__FILE__).'/init.php';

if(!$M->iCookie()){
	exit('小伙子你想干啥？');
}

if($_GET['action'] == 'table'){
	$result = $M->getAll("select number from number where admin = '".$M->deStr($_COOKIE['name'])."'");
	if(count($result) >= 1){
		foreach($result as $key => $value){
			echo '<tr class="am-active"><td>'.$key.'</td><td>'.$value['number'].'</td><td><a href="./ajax.php?action=delete&number='.$value['number'].'">删除</a></td></tr>';
		}
	}else{
		echo '<tr class="am-active"><td>NULL</td><td>NULL</td><td>NULL</td></tr>';
	}
}

if($_GET['action'] == 'delete' && isset($_GET['number'])){
	$M->query("delete from number where number = '".$M->deStr($_GET['number'])."' and admin = '".$M->deStr($_COOKIE['name'])."'");
	header('Location:index.php');
}

if($_GET['action'] == 'add' && isset($_GET['number'])){
	if($M->addNumber($_COOKIE['name'],$_COOKIE['pass'],$_GET['number'])){
		echo '添加成功,<a href="index.php?action=cloud">刷新查看</a>！';
	}else{
		echo '添加失败！';
	}
}

if($_GET['action'] == 'changepass' && isset($_GET['oldpass']) && isset($_GET['newpass'])){
	if(md5($_GET['oldpass']) == $_COOKIE['pass']){
		if($M->changePass($_COOKIE['name'],md5($_GET['newpass']))){
			echo '密码更改成功！';
		}else{
			echo '密码更改失败！';
		}
	}else{
		echo '旧密码错误！';
	}
}
