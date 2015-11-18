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
	  <div id="title">重设密码</div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <p style="text-align:center;">请正确填写以下信息，若信息正确，您可以重设一个密码</p>
	  <div id="user_password">
	    <form action="user_password_change.php" method="post">
	    <table style="border-collapse:collapse;">
	      <tr>
		    <td align="right">用户名：</td>
		    <td align="left"><input type="text" name="user" maxlength="15" class="user_password_input" /></td>
		  </tr>
		  <tr>
		    <td align="right">密保问题：</td>
		    <td align="left"><input type="text" name="question" maxlength="40" class="user_password_input" /></td>
		  </tr>
		  <tr>
		    <td align="right">密保答案：</td>
		    <td align="left"><input type="text" name="answer" maxlength="40" class="user_password_input" /></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center"><br /><input type="submit" value="提交" /></td>
		  </tr>
	    </table>
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