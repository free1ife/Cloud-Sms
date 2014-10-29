<?php 
if($_POST){
	if($M->login($_POST['name'],md5($_POST['pass']))){
		setcookie('name',$_POST['name']);
		setcookie('pass',md5($_POST['pass']));
		header('Location:index.php?action=cloud');
		exit();
	}
}else if($M->iCookie()){
	header('Location:index.php?action=cloud');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>CloudSms</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="http://cdn.staticfile.org/amazeui/1.0.0-beta2/css/amazeui.basic.min.css"/>
  <script src="http://cdn.staticfile.org/amazeui/1.0.0-beta2/js/amazeui.min.js"></script>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1><a href="./index.php">CloudSms</a></h1>
    <div class="am-btn-group">
      <a href="https://github.com/S0cial/Cloud-Sms" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github</a>
      <a href="http://weibo.com/rootsu" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-weibo am-icon-sm"></i> Weibo</a>
      <a href="http://www.inurl.org" class="am-btn am-btn-primary am-btn-sm"><i class="am-icon-star am-icon-sm"></i> Star</a>
    </div>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="col-lg-6 col-md-8 col-sm-centered">
    <form action="" method="post" class="am-form">
      <label for="text">帐号:</label>
      <input type="text" name="name" id="login_name" value="">
      <br>
      <label for="password">密码:</label>
      <input type="password" name="pass" id="login_password" value="">
      <br>
      <div class="am-cf">
        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
		<a href="index.php?action=reg" class="am-btn am-btn-default am-btn-sm am-fr" role="button">没有帐号? </a>
      </div>
    </form>
    <hr>
    <div class="am-g col-md-8 col-lg-6">
		<p>&copy; 2014 <a href="http://www.inurl.org">Social</a></p>
	</div>
</body>
</html>