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
	  <div id="password_change">
	  <?php
	  include("conn.php");
	  //转义提交数据
	  if(get_magic_quotes_gpc())
	  {
	    $user=$_POST['user'];
		$question=$_POST['question'];
		$answer=$_POST['answer'];
	  }
	  else
	  {
	    $user=addslashes($_POST['user']);
		$question=addslashes($_POST['question']);
		$answer=addslashes($_POST['answer']);
	  }
	  //验证用户名格式
	  if(!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u",$user))
	    echo "<p style='text-align:center;color:red;'>用户名格式不正确！请返回重新输入！</p>";
	  else
	  {
	    $sql="SELECT * FROM users where name='".$user."'";
		if(!$row=(mysql_fetch_array(mysql_query($sql,$conn))))
		  echo "<p style='text-align:center;color:red;'>用户验证失败，请返回重新输入！</p>";
		else
		{
		  if($question==$row['question'] && $answer==$row['answer'])
		  {
		    session_start();
			$_SESSION['user']=$user;
		    echo "<form action='user_password_change_check.php' method='post'><table style='width:290px;'><tr>";
			echo "<td style='width:120px;'>请重设一个密码：</td><td><input type='password' name='psw_change' maxlength='20' /></td></tr>";
			echo "<tr><td colspan='2' align='center'><br /><input type='submit' value='提交' /></td>";
			echo "</tr></table></form>";
		  }else
		    echo "<p style='text-align:center;color:red;'>用户验证失败，请返回重新输入！</p>";
		}
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