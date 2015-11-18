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
	 <?php
	   include("conn.php");
	   session_start();
	   //验证信息
	   if(!isset($_SESSION['user']))
	     header("Location:err_login.php");
	   else
	   {
	   //转义提交信息
	   if(get_magic_quotes_gpc())
	     $psw_change=$_POST['psw_change'];
	   else
	     $psw_change=addslashes($_POST['psw_change']);
	   //更新数据表
	   $sql="UPDATE users SET psw='".sha1($_POST['psw_change'])."' WHERE name='".$_SESSION['user']."'";
	   if(mysql_query($sql,$conn))
	   {
	     echo "<p style='text-align:center;color:green'>重设密码成功！2秒后将返回<a href='index.php'>登录页面</a></p>";
		 session_destroy();
	   }
	   else
	   {
	     "<p style='text-align:center;color:red'>更改密码失败！</p>";
	   }
	  }
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