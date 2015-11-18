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
  include("conn.php");
  //验证管理身份
  session_start();
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
	  <div style="float:left;margin-top:45px;"><a href="javascript:history.back();">返回</a></div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <?php

	    //转义输入信息
		if(get_magic_quotes_gpc())
		{
		  $user_psw=$_POST['user_psw'];
		  $question=$_POST['question'];
		  $answer=$_POST['answer'];
		  $email=$_POST['email'];
		}
		else
		{
		  $user_psw=addslashes($_POST['user_psw']);
		  $question=addslashes($_POST['question']);
		  $answer=addslashes($_POST['answer']);
		  $email=addslashes($_POST['email']);
		}
		//判断E-MAIL格式
		if(!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email))
	      echo "<p style='text-align:center;color:red'>E-mail地址不正确，请重新输入！</p>";
		else
		{
	      //判断密码是否为空
		  if($_POST['user_psw']=="")
		    $sql="UPDATE users SET level=".$_POST['user_level']." ,question='".$question."' ,answer='".$answer."' ,email='".$email."' WHERE ID=".$_SESSION['user_id'];
		  else
		    $sql="UPDATE users SET psw='".sha1($user_psw)."' ,level=".$_POST['user_level']." ,question='".$question."' ,answer='".$answer."' ,email='".$email."' WHERE ID=".$_SESSION['user_id'];
		  if(mysql_query($sql,$conn))
		  {
		    echo "<p style='text-align:center'>用户数据更新成功！2秒后将返回<a href='user_manage.php'>用户管理页面</a></p>";
		    header("refresh:2;url=user_manage.php");
		  }
		  else
		  {
		   echo "<p style='text-align:center'>用户数据更新失败！</p>";
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
	<div style="clear:both;padding-bottom:30px;"></div>
  </div>
</body>
</html>
