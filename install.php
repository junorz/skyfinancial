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
	  <div id="install_start">
	  <?php
	  session_start();
	  switch($_SESSION['step']){ //由前一页传进来的step变量
	    case 1:
		//因为要做成刷新页面一条一条指令地进行操作，需要定义一些SESSION变量
		//转义提交数据
		if(!get_magic_quotes_gpc())
		{
		  $_SESSION['sql_add']=addslashes($_POST['sql_add']);
		  $_SESSION['sql_user']=addslashes($_POST['sql_user']);
		  $_SESSION['sql_psw']=addslashes($_POST['sql_psw']);
		  $_SESSION['sql_name']=addslashes($_POST['sql_name']);
		  $_SESSION['os_psw']=addslashes($_POST['os_psw']);
		  $_SESSION['question']=addslashes($_POST['question']);
		  $_SESSION['answer']=addslashes($_POST['answer']);
		  $_SESSION['os_user']=addslashes($_POST['os_user']);
		  $_SESSION['email']=addslashes($_POST['email']);
		}
		else
		{
		  $_SESSION['sql_add']=$_POST['sql_add'];
		  $_SESSION['sql_user']=$_POST['sql_user'];
		  $_SESSION['sql_psw']=$_POST['sql_psw'];
		  $_SESSION['sql_name']=$_POST['sql_name'];
		  $_SESSION['os_psw']=$_POST['os_psw'];
		  $_SESSION['question']=$_POST['question'];
		  $_SESSION['answer']=$_POST['answer'];
		  $_SESSION['os_user']=$_POST['os_user'];
		  $_SESSION['email']=$_POST['email'];
		}
		//验证E-mail格式
		if(!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-\.]+$/",$_SESSION['email']))
		  die('E-mail格式不正确，请返回重新填写！');
		elseif(!preg_match("/^[\x{4e00}-\x{9fcf}A-Za-z0-9_]+$/u",$_SESSION['os_user']))
		  die('用户名中含有非法字符，请返回重新填写！');
		else{
		  if(mysql_connect($_SESSION['sql_add'],$_SESSION['sql_user'],$_SESSION['sql_psw']))
		  {
		    echo "<p style='text-align:center;color:green'>连接mysql服务器成功！</p>";
		    $_SESSION['step']++;  //成功的话step变量加1，再次刷新这个页面会执行case2的部分
		    header("refresh:2;url=install.php");
		    break;
		  }
		  else{
		    echo "<p style='text-align:center;color:red'>连接服务器失败，请返回重新填写。</p><p style='text-align:center;color:red'></p>";
			break;
		  }
		}
		case 2:
		  if(mysql_select_db($_SESSION['sql_name'],mysql_connect($_SESSION['sql_add'],$_SESSION['sql_user'],$_SESSION['sql_psw']))) //如果选择数据库成功
		  {
		    echo "<p style='text-align:center;color:green'>数据库连接成功！</p>";
		    $_SESSION['step']++;
		    header("refresh:2;url=install.php");
		    break;
		  }
		  else{
		    echo "<p style='text-align:center;color:red'>数据库连接失败！请返回正确填写数据库名称。</p><p style='text-align:center;color:red'></p>";
			break;
		  }
		case 3:
		  $conn=mysql_connect($_SESSION['sql_add'],$_SESSION['sql_user'],$_SESSION['sql_psw']);
		  mysql_query("SET NAMES 'UTF8'");
		  mysql_select_db($_SESSION['sql_name'],$conn);  //因为刷新了页面，需要重新建立数据库连接并选择数据库
		  $sql1="Create table data
		  (
		  ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  type varchar(4),
		  money float,
		  uses text,
		  provider text,
		  year smallint UNSIGNED,
		  month tinyint UNSIGNED,
		  day tinyint UNSIGNED,
		  INDEX date (year,month,day)
		  )";
		  $sql2="Create table users
		  (
		  ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  name text,
		  psw varchar(40),
		  level tinyint UNSIGNED,
		  question text,
		  answer text,
		  email text,
		  register_time datetime
		  )";
		  if(mysql_query($sql1,$conn) && mysql_query($sql2,$conn))
		  {
		    echo "<p style='text-align:center;color:green'>数据表建立成功！SQL:Create table 'data' successfully.</p>";
		    echo "<p style='text-align:center;color:green'>数据表建立成功！SQL:Create table 'kanri' successfully.</p>";
		    $_SESSION['step']++;
		    header("refresh:2;url=install.php");
		    break;
		  }
		  else{
		    echo "<p style='text-align:center;color:red'>数据表建立失败！</p><p style='text-align:center;color:red'></p>";
			break;
		  }
		case 4: //插入新用户数据
		  $conn=mysql_connect($_SESSION['sql_add'],$_SESSION['sql_user'],$_SESSION['sql_psw']); 
		  mysql_query("SET NAMES 'UTF8'");
		  mysql_select_db($_SESSION['sql_name'],$conn);  //因为刷新了页面，需要重新建立数据库连接并选择数据库
		  $sha1_psw=sha1($_SESSION['os_psw']); //加密用户密码
		  //取得现在时间
	      date_default_timezone_set("Asia/Hong_Kong");
	      $register_time=date(Y)."-".date(m)."-".date(d)." ".date(H).":".date(i).":".date(s);
		  $sql="Insert into users (name,psw,level,question,answer,email,register_time) VALUES('"
		  .$_SESSION['os_user']."','".$sha1_psw."',255,'".$_SESSION['question']."','".$_SESSION['answer']."','".$_SESSION['email']."','".$register_time."')";
		  if(mysql_query($sql,$conn))
		  {
		    echo "<p style='text-align:center;color:green'>用户数据更新成功！</p>";
			$_SESSION['step']++;
		    header("refresh:2;url=install.php");
		    break;
		  }
		  else
		  {
		    echo "<p style='text-align:center;color:red'>更新用户数据失败！</p><p style='text-align:center;color:red'>".mysql_error()."</p>";
			break;
		  }
		case 5: //建立一个conn.php
		  @$file=fopen('conn.php',wb);
		  $str="<?php\r\n".
		  '@$conn='."mysql_connect('".$_SESSION['sql_add']."','".$_SESSION['sql_user']."','".$_SESSION['sql_psw']."')or die('数据库连接错误！');\r\n".
		  "mysql_query(\"SET NAMES 'UTF8'\");\r\n".
		  "@mysql_select_db('".$_SESSION['sql_name']."',".'$conn'.")or die('读取数据库发生错误！');\r\n".
		  "?>";
		  if(fwrite($file,$str))
		  {
		    echo "<p style='text-align:center;color:green'>建立数据文件成功！</p>";
			$_SESSION['step']++;
		    header("refresh:2;url=install.php");
		    break;
		  }
		  else
		  {
		    echo "<p style='text-align:center;color:red'>建立数据文件失败！</p>";
			break;
		  }
		default:
		  echo "<p style='text-align:center;color:green'>程序安装成功！请<a href='index.php'>返回到登录页面</a>。</p>";
		  if(!unlink("info.php"))
		    echo "<p style='text-align:center;color:red'>Warning! 警告：程序无法删除info.php文件，请手动删除！</p>";
		  session_destroy();
		  break;
	 }
	  ?>
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