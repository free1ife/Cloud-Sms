<?php
class mysql{

	private $conn;

	//连接数据库
	public function connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME){
		$this->conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME)or die('Mysql Error');
	}
	
	//执行SQL语句
	public function query($sql){
		return mysqli_query($this->conn,$sql);
	}
	
	//获取单条数据
	public function getOne($sql){
		$result = $this->query($sql);
		if($result){
			$data = mysqli_fetch_assoc($result);
			return $data;
		}
		return false;
	}
	
	//获取多条数据
	public function getAll($sql){
		$result = $this->query($sql);
		if($result){
			$num = mysqli_num_rows($result);
			for($i = 0;$i <= $num;$i++){
				$arr[] = mysqli_fetch_assoc($result);
			}
			array_pop($arr);
			return $arr;
		}
		return false;
	}
	
	//字符串编码
	public function deStr($str){
	if(get_magic_quotes_gpc()){
		return $str;
	}else{
		return addslashes($str);
	}
}
	
	//登录
	public function login($name,$pass){
		if(empty($name) || empty($pass)){
			return false;
		}
		$result = $this->getOne("select name,pass from user where name = '".$this->deStr($name)."' and pass = '".$this->deStr($pass)."'");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	//注册
	public function register($name,$pass){
		if(empty($name) || empty($pass)){
			return false;
		}
		return $this->query("insert into user(name,pass)values('".$this->deStr($name)."','".$this->deStr($pass)."')");
	}
	
	//添加手机号
	public function addNumber($name,$pass,$number){
		if(!preg_match("#^1\d{10}$#", $number)){
			return false;
		}
		if($this->login($name,$pass)){
			return $this->query("insert into number(number,admin)values('".$this->deStr($number)."','".$this->deStr($name)."')");
		}
		return false;
	}
	
	//删除手机号
	public function delNumber($name,$pass,$number){
		if($this->login($name,$pass)){
			$result = $this->getOne("select number,admin from number where number = '".$this->deStr($number)."' and admin = '".$this->deStr($name)."'");
			if($result){
				return $this->query("delete from number where number = '".$this->deStr($number)."'");
			}
			return false;
		}
	}
	
	//更改密码
	public function changePass($name,$newPass){
		return $this->query("update user set pass = '".$this->deStr($newPass)."' where name = '".$this->deStr($name)."'");
	}
	
	//判断登录状态
	public function iCookie(){
		return $this->login($_COOKIE['name'],$_COOKIE['pass']);
	}
}