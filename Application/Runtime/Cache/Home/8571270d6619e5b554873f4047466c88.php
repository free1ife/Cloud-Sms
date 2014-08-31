<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理-短信云轰炸</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
	<h1 class="page-header">欢迎回来<small><?php echo ($username); ?></small></h1>
	<a href="add"><button class="btn btt-primary" type="button">添加手机</button></a>
	<table class="table">
		<?php if(is_array($number)): foreach($number as $key=>$vo): ?><tr>
				<td><?php echo ($key); ?></td>
				<td><?php echo ($vo["number"]); ?></td>
				<td><a href="delete/number/<?php echo ($vo["number"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; ?>
	</table>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>