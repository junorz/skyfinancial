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
	  $search_user=$_GET['search_user'];
	else
	  $search_user=addslashes($_GET['search_user']);
	if(!$row=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE name='".$search_user."'",$conn)))
	  header("Location:user_nodata.php");
	?>
	  <p style="text-align:center;font-size:30px;">用户信息</p>
	  <div id="user_info">
	    <form action="user_update.php" method="post">
	    <table style="border-collapse:collapse;width:400px;">
		 <tr>
		   <td class="td_title" style="width:100px;">用户ID</td>
		   <td class="td_naiyou" style="width:300px;"><?php echo $row['ID'];session_start();$_SESSION['user_id']=$row['ID'];?></td>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">用户名</td>
		   <td class="td_naiyou" style="width:300px;"><?php echo $row['name'];?></td>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">用户等级</td>
		   <td class="td_naiyou" style="width:300px;">
		   <select name="user_level" style="font-family:微软雅黑">
		   <?php
		   if($row['level']==255)
		   {
		     echo "<option value=255 selected='selected'>管理员</option>";
			 echo "<option value=1>一般用户</option>";
		   }else
		   {
		     echo "<option value=255>管理员</option>";
			 echo "<option value=1 selected='selected'>一般用户</option>";
		   }
		   ?>
		   </select>
		   </td>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">更改用户密码</td>
		   <td class="td_naiyou" style="width:300px;"><input type="password" name="user_psw" maxlength="20" style="font-family:微软雅黑;width:280px;"/></td>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">密保问题</td>
		   <?php
		     $question=str_replace("'","&#39;",$row['question']); //解决在输入框中显示引号的问题
			 $question=str_replace("\"","&#34;",$question);
		     echo "<td class='td_naiyou' style='width:300px;'><input type='type' name='question' maxlength='40' value='".$question."' style='font-family:微软雅黑;width:280px;'/></td>";
		   ?>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">密保答案</td>
		   <?php
		     $answer=str_replace("'","&#39;",$row['answer']); //解决在输入框中显示引号的问题
			 $answer=str_replace("\"","&#34;",$answer);
		     echo "<td class='td_naiyou' style='width:300px;'><input type='type' name='answer' maxlength='40' value='".$answer."' style='font-family:微软雅黑;width:280px;'/></td>";
		   ?>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">E-mail地址</td>
		   <?php
		     echo "<td class='td_naiyou' style='width:300px;'><input type='type' name='email' maxlength='40' value='".$row['email']."' style='font-family:微软雅黑;width:280px;'/></td>";
		   ?>
		 </tr>
		 <tr>
		   <td class="td_title" style="width:100px;">注册时间</td>
		   <td class="td_naiyou" style="width:300px;"><?php echo $row['register_time'];?></td>
		 </tr>
		</table>
		<div id="tip">
		  <p>注：若不需要改变用户密码，“更改用户密码”一栏请留空。</p>
		</div>
		<div id="operation">
		  <input type="submit" value="更新用户数据" />
		  <input type="button" OnClick="location.href='user_delete.php'" value="删除用户" />
		</div>
		</form>
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
	<div style="clear:both;padding-bottom:30px;"></div>
  </div>
</body>
</html>