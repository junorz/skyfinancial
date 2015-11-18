<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>SKY 收支管理系统-Powered by JUN</title>
<link rel="stylesheet" type="text/css" href="css.css" />

</head>

<body>
  <div id="main">
    <div id="r1"></div>
	<div id="r2"></div>
	<div id="r3"></div>
	<div id="header">
	  <div id="logo"></div>
	  <div style="float:left;width:210px;margin-top:40px;">收支管理系统 Ver1.0  安装程序</div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <div id="install_info">
	  <?php
	  session_start();
	  $_SESSION['step']=1; //创建步骤变量
	  ?>
	  <form action="install.php" method="post">
	    <p><input type="text" maxlength="400" name="sql_add" value="localhost" class="input"/></p>
	    <p>MYSQL数据库地址：</p>
		<p style="clear:both"></p>
		<p><input type="text" maxlength="400" name="sql_user" class="input"/></p>
		<p>MYSQL用户名：</p>
		<p style="clear:both"></p>
		<p><input type="password" maxlength="400" name="sql_psw" class="input"/></p>
		<p>MYSQL密码：</p>
		<p style="clear:both"></p>
		<p><input type="text" maxlength="400" name="sql_name" class="input"/></p>
		<p>MYSQL数据库名称：</p>
		<p style="clear:both"></p>
		<p><input type="text" name="os_user" maxlength="15" class="input"></p>
		<p>创建一个用户：</p>
		<p style="clear:both"></p>
		<p><input type="password" name="os_psw" maxlength="20" class="input"></p>
		<p>用户密码：</p>
		<p style="clear:both"></p>
		<p><input type="text" name="question" maxlength="40" class="input"></p>
		<p>密保问题：</p>
		<p style="clear:both"></p>
		<p><input type="text" name="answer" maxlength="40" class="input"></p>
		<p>密保答案：</p>
		<p style="clear:both"></p>
		<p><input type="text" name="email" maxlength="200" class="input"></p>
		<p>E-mail：</p>
		<p><input type="submit" value="提交" id="submit_btn"/></p>
		<li class="tip">这里创建的新用户将拥有管理员资格</li>
		<li class="tip">用户名只能以汉字、大小写英文字母、数字、下划线（_）组成</li>
		<li class="tip">密保问题和答案最多40个字符</li>
	  </form>
	  </div>
	</div>
	<div id="footer">
	  <p>Copyright &copy; 2014-2015 JUN All rights Reserved</p>
	  <p style="margin-top:-12px;">https://www.junorz.com/</p>
	  <p style="margin-top:-12px;">请使用IE7以上版本或Firefox浏览器以获得最佳浏览效果</p>
	</div>
	<div id="r4"></div>
	<div id="r5"></div>
	<div id="r6"></div>
  </div>
</body>
</html>