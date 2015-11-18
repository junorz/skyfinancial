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
	  <div id="title">注册用户</div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <form action="user_register_check.php" method="post">
	    <div id="register_info">
		  <table>
		    <tr>
			  <td align="right">用户名：</td>
			  <td align="left"><input class="register_input" type="text" name="register_user" maxlength="15" /></td>
			</tr>
			<tr>
			  <td align="right">密码：</td>
			  <td align="left"><input class="register_input" type="password" name="register_psw" maxlength="20" /></td>
			</tr>
			<tr>
			  <td align="right">再输入一次密码：</td>
			  <td align="left"><input class="register_input" type="password" name="register_psw_2" maxlength="20" /></td>
			</tr>
			<tr>
			  <td align="right">密保问题：</td>
			  <td align="left"><input class="register_input" type="text" name="register_question" maxlength="40" /></td>
			</tr>
			<tr>
			  <td align="right">密保答案：</td>
			  <td align="left"><input class="register_input" type="text" name="register_answer" maxlength="40" /></td>
			</tr>
			<tr>
			  <td align="right">E-mail地址：</td>
			  <td align="left"><input class="register_input" type="text" name="register_email" maxlength="200" /></td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><br /><input type="submit" value="提交" /></td>
			</tr>
			<tr>
			  <td colspan="2">
			  <li>用户名最多可以输入15个字符。密码最多可输入20个字符。</li>
			  <li>用户名可以是汉字、大小写英文字母和下划线（_）</li>
			  <li>密保问题和密保答案最大长度都是40个字符。</li>
			  </td>
			</tr>
		  </table>
		</div>
	  </form>
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