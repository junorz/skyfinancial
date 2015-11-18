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
	  <div id="title">收支管理系统 Ver1.0</div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <?php
	  //验证登录身份
	  session_start();
	  if($_SESSION['tdslogin']!='Tadashii')
	    header("Location:err_login.php");
	  //判断留言是否可删除
	  include('conn.php');
	  $sql="select * from data where id=".$_GET['id'];
	  @$result=mysql_query($sql,$conn)or die('读取数据库错误！');
	  @$row=mysql_fetch_array($result)or die('读取数据库错误！');
	  $sql="DELETE FROM data WHERE id=".$_GET['id'];
	  date_default_timezone_set('Asia/Hong_Kong');
	  if($row['provider']==$_SESSION['loginuser']){
	    @mysql_query($sql,$conn)or die('读取数据库错误！');
		echo "<p style='text-align:center'>删除数据成功，2秒后将自动<a href='main.php'>返回</a></p>";
		header("refresh:2;url=main.php");
	  }else
	    header("Location:err_login.php");
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