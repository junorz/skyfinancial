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
	  //验证用户是否登录
	  session_start();
	  if($_SESSION['tdslogin']!="Tadashii")
	    header("Location:err_login.php");
	  else{  //否则开始验证提交数据
	    if(!preg_match('/^[0-9.]+$/',$_POST['money']))
		  {
		  echo "<p style='text-align:center'>只能以数字作为金额，2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
		elseif(!preg_match('/^[0-9]+$/',$_POST['year']))
		  {
		  echo "<p style='text-align:center'>输入的年份不正确，2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
		elseif(!preg_match('/^[0-9]+$/',$_POST['month']))
		  {
		  echo "<p style='text-align:center'>输入的月份不正确，2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
	    elseif(!preg_match('/^[0-9]+$/',$_POST['day']))
		  {
		    echo "<p style='text-align:center'>输入的日期不正确，2秒后将<a href='main.php'>返回</a></p>";
		    header("refresh:2;url=main.php");
		  }
		elseif($_POST['month']>12||$_POST['month']<=0)
		  {
		  echo "<p style='text-align:center'>输入的月份不正确，2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
		elseif($_POST['day']>31||$_POST['day']<=0)
		  {
		  echo "<p style='text-align:center'>输入的日期不正确，2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
		elseif(strlen($_POST['uses'])>100) 
		  {
		  echo "<p style='text-align:center'>用途/来历超过100个字符，请重新输入。2秒后将<a href='main.php'>返回</a></p>";
		  header("refresh:2;url=main.php");
		  }
	    else //数据输入正确，则开始提交数据
		  {
		  //转义字符串防止SQL注入
		  $uses_before=$_POST['uses'];
		  if(get_magic_quotes_gpc()) //检测魔术引号特征是否被启用
		    $uses_after=$uses_before;
		  else
		  {
		    $uses_after=addslashes($uses_before);
		  }
		  //连接数据库
		  include("conn.php");
		  $sql="INSERT INTO data
		  (type,money,uses,provider,year,month,day)
		  VALUES('".$_POST['in_ex']."','".$_POST['money']."','".$uses_after."','".$_SESSION['loginuser']."','".$_POST['year']."','".$_POST['month']."','".$_POST['day']."')";
		  @mysql_query($sql,$conn)
		  or die('写入数据库错误！');
		  echo "<p style='text-align:center'>录入成功！2秒后将转到<a href='main.php'>主页面</a></p>";
		  header("refresh:2;url=main.php");
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