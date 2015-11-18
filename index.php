<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<?php
  if(!file_exists('conn.php'))
  {
    header("content-type:text/html;charset=utf-8");
    die("未检测到数据库，请先<a href='info.php'>安装程序</a>。");
  }
?>
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
	  <div id="title">收支管理系统 Ver1.0</div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <form action="check.php" method="post">
	   <div id="form">
		  <div class="label">用户名：</div>
		  <div id="user_input"><input type="text" name="user" maxlength="15"></div>
		  <div class="label">密&nbsp;&nbsp;&nbsp;&nbsp;码：</div>
		  <div id="psw_input"><input type="password" name="psw" maxlength="20" /></div>
	    </div>
	    <div id="forget_psw"><a href="user_password.php">忘记密码？</a></div>
	    <div id="button"><input type="submit" value="登录" /> <input type="button" Onclick="location.href='user_register.php'" value="注册" /></div>
	  </form>
	  <?php
		  if(file_exists('install.php'))
		    if(!unlink('install.php'))
		      echo "<p style='text-align:center;color:red'>程序无法删除install.php文件，请手动删除！</p>";
	  ?>
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