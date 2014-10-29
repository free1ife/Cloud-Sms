<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
<script src="./templates/js/star.js"></script>
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
    <div class="am-btn-group am-btn-group-justify">
		<a id="JQ_index" class="am-btn am-btn-default" role="button">首页</a>
		<a id="JQ_add" class="am-btn am-btn-default" role="button">添加手机</a>
		<a id="JQ_changePass" class="am-btn am-btn-default" role="button">更改密码</a>
		<a href="index.php?action=logout" class="am-btn am-btn-default" role="button">退出登录</a>
	</div>
	</div>
</div>
<hr />
<div id="show_index" class="am-g">
	<div class="col-lg-6 col-md-8 col-sm-centered">
		<table class="am-table am-table-bd am-table-striped am-table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Number</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody id="result_index">
				<tr class="am-active">
					<td>Null</td>
					<td>Null</td>
					<td>Null</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div id="show_add" class="am-g">
	<div class="col-lg-6 col-md-8 col-sm-centered">
			<form action="" method="" class="am-form">
			<label for="text">手机号:</label><del id="resukt_add"></del>
			<input type="text" name="number" id="ajax_number" value="">
			<br>
			<div class="am-cf">
				<input id="ajax_addNumber" type="button" name="" value="提交" class="am-btn am-btn-primary am-btn-block">
			</div>
			</form>
	</div>
</div>
<div id="show_changePass" class="am-g">
	<div class="col-lg-6 col-md-8 col-sm-centered">
		<div class="col-lg-6 col-md-8 col-sm-centered">
			<form action="" method="" class="am-form">
				<label for="text">旧密码:</label>
				<input type="password" name="oldPass" id="ajax_oldPass" value="">
			<br>
				<label for="password">新密码:</label>
				<input type="password" name="newPass" id="ajax_newPwd" value="">
			<br>
		<div class="am-cf">
			<p id="result_changePass"></p>
			<input id="ajax_changePass" type="button" name="" value="更 改" class="am-btn am-btn-primary am-btn-block">
		</div>
			</form>
		</div>
	</div>
</div>
<hr />