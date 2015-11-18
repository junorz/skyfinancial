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
	  <div id="check_info">
	    <?php
		  //转义输入内容
		  if (!get_magic_quotes_gpc())
		  {
		    $_POST['user']=addslashes($_POST['user']);
		    $_POST['psw']=addslashes($_POST['psw']);
		  }
		  include('conn.php');
		  $psw_check=sha1($_POST['psw']);
		  $result=mysql_query("select * from users where name='".$_POST['user']."'",$conn);
		  @$row=mysql_fetch_array($result);
		  if($psw_check==$row['psw'])
		  {
		    if($row['level']==255)
			  echo "<li style='float:left;width:80px;margin-top:45px;margin-left:50px;'>欢迎回来，</li><p style='font-size:30px;color:red;font-weight:bold;width:400px;float:left;'>[管理员] ".$row['name']."</p>";
			else
		      echo "<li style='float:left;width:80px;margin-top:45px;margin-left:50px;'>欢迎回来，</li><p style='font-size:30px;color:red;font-weight:bold;width:400px;float:left;'>".$row['name']."</p>";
			echo "<li style='float:left;margin-top:-25px;margin-left:50px;margin-bottom:30px;'>2秒后将转入主页面，如果你的浏览器没有自动跳转，请<a href='main.php'>点击这里</a></li>";
			//添加验证数据
		    session_start();
			$_SESSION['tdslogin']="Tadashii";
			$_SESSION['loginuser']=$row['name'];
			$_SESSION['level']=$row['level'];
			header("refresh:2;url=main.php");
		  }
	      else
		  {
		    echo "<p style='text-align:center;margin-top:60px;'>对不起，用户验证失败。2秒后将自动返回<a href='index.php'>登录页面</a></p>";
			//销毁验证数据
			session_start();
			session_destroy();
			header("refresh:2;url=index.php");
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