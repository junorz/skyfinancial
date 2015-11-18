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
	  <?php
	  include("conn.php");
	  //取得现在时间
	  date_default_timezone_set("Asia/Hong_Kong");
	  $register_time=date(Y)."-".date(m)."-".date(d)." ".date(H).":".date(i).":".date(s);
	  //转义提交信息
	  if(get_magic_quotes_gpc())
	  {
	    $register_user=$_POST['register_user'];
		$register_psw=sha1($_POST['register_psw']); //加密用户密码
		$register_psw_2=sha1($_POST['register_psw_2']); 
		$register_question=$_POST['register_question'];
		$register_answer=$_POST['register_answer'];
		$register_email=$_POST['register_email'];
		$sql="INSERT INTO users
		(name,psw,level,question,answer,email,register_time) VALUES".
		"('".$register_user."','".$register_psw."',1,'".$register_question."','".$register_answer."','".$register_email."','".$register_time."')";
	  }
	  else
	 {
	   $register_user=addslashes($_POST['register_user']);
	   $register_psw=sha1(addslashes($_POST['register_psw'])); //加密用户密码
	   $register_psw_2=sha1($_POST['register_psw_2']); 
	   $register_question=addslashes($_POST['register_question']);
	   $register_answer=addslashes($_POST['register_answer']);
	   $register_email=addslashes($_POST['register_email']);
	   $sql="INSERT INTO users
	   (name,psw,level,question,answer,email,register_time) VALUES".
	   "('".$register_user."','".$register_psw."',1,'".$register_question."','".$register_answer."','".$register_email."','".$register_time."')";
	 }
	 //验证E-mail地址的正确性
	  if(!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$register_email))
	    echo "<p style='text-align:center;color:red'>E-mail地址不正确，请重新输入！</p>";
	  elseif(!preg_match("/^[\x{4e00}-\x{9fcf}A-Za-z0-9_]+$/u",$register_user)) //验证用户名的正确性
	    echo "<p style='text-align:center;color:red'>用户名中含有非法字符，请重新输入！</p>";
	  elseif($register_user=="" || $register_psw=="" || $register_question=="" || $register_answer=="" || $register_email=="")
	    echo "<p style='text-align:center;color:red'>表单有未填项，请返回填写完整信息！</p>";
	  else
	  {
	    //验证用户是否已存在
	    if(mysql_fetch_array(mysql_query("SELECT * FROM users WHERE name='".$register_user."'",$conn)))
	      echo "<p style='text-align:center;color:red'>你要注册的用户名已存在，请返回换一个用户名。</p>";
	    else
	    {
	      //验证两次密码是否相同
	      if($register_psw==$register_psw_2)
	      {
	        //插入表
	        if(mysql_query($sql,$conn))
	        {
	          echo "<p style='text-align:center;color:green'>注册成功！2秒后将自动返回<a href='index.php'>登录页面</a></p>";
		      header("refresh:2;url=index.php");
	        }
	        else
	        {
	          echo "<p style='text-align:center;color:red'>注册失败！</p>";
	        }
	      }else
	        echo "<p style='text-align:center;color:red'>两次输入的密码不一致，请重新输入！</p>";
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