<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>SKY 收支管理系统 Version1.0-Powered by JUN</title>
<link rel="stylesheet" type="text/css" href="main_css.css" />
</head>
<body>
  <?php
  //验证登录
  session_start();
  include("conn.php");
  $row=(mysql_fetch_array(mysql_query("SELECT * FROM users WHERE name='".$_SESSION['loginuser']."'",$conn)));
  $_SESSION['level']=$row['level'];
  if($_SESSION['tdslogin']!="Tadashii" || $_SESSION['level']!=255)
    header("Location:err_login.php");
  ?>
  <div id="main">
    <div id="r1"></div>
	<div id="r2"></div>
	<div id="r3"></div>
	<div id="header">
	  <div id="logo"></div>
	  <div id="time">今天是
	  <?php 
	  //判断星期
	  switch(date(w)){
	    case 0:
		  $day='星期一';
		  break;
		case 1:
		  $day='星期二';
		  break;
		case 2:
		  $day='星期三';
		  break;
		case 3:
		  $day='星期四';
		  break;
		case 4:
		  $day='星期五';
		  break;
		case 5:
		  $day='星期六';
		  break;
		case 6:
		  $day='星期日';
		  break;
	  }
	  date_default_timezone_set('Asia/Hong_Kong');
	  echo date("Y 年 n 月 j 日 ").$day; ?></div>
	  <div style="float:left;margin-top:45px;"><a href="user_manage.php">返回</a></div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <p style="text-align:center;font-size:30px;">用户信息</p>
	  <p style="text-align:center;font-size:15px;margin-top:50px;">找不到用户信息，请返回重新查询。</p>
	</div>
	<div id="footer">
	  <p>Copyright &copy; 2014-2015 JUN All rights Reserved</p>
	  <p style="margin-top:-12px;">https://www.junorz.com/</p>
	  <p style="margin-top:-12px;">请使用IE7以上版本或Firefox浏览器以获得最佳浏览效果</p>
	</div>
	<div id="r4"></div>
	<div id="r5"></div>
	<div id="r6"></div>
	<div style="clear:both;padding-bottom:30px;"></div>
  </div>
</body>
</html>