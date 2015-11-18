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
  //验证管理身份
  //刷新用户当前等级，防止管理用户被更改等级之后若停留在此页面仍然出现管理选项
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
	  <div style="float:left;margin-top:45px;"><a href="main.php">返回</a></div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <p style="text-align:center;font-size:30px;">用户管理</p>
	  <div id="user_list">
        <table style="border-collapse:collapse;width:700px;">
	      <tr>
		    <td colspan="4" class="td_title">总共有<?php $user_quantity=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users"),$conn); echo $user_quantity[0] ?>名用户</td>
		  </tr>
		  <tr>
		    <td colspan="4" class="td_naiyou"><p style="margin:0px;float:left;">快速查找（请输入要查找的用户）：</p><form action="user_info.php" method="get" style="width:250px;float:left;"><input type="text" name="search_user" maxlength="15" /><input type="submit" value="提交" /></form></td>
		  </tr>
		  <tr>
		    <td colspan="4" class="td_title">所有用户信息</td>
		  </tr>
		  <?php
		  //分页
		  $total_pages=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users",$conn));
		  $total_pages=ceil($total_pages[0]/50); //每页50个用户
		  if(isset($_GET['page']))
		    $page=$_GET['page'];
		  else
		    $page=1; //当前页
		  $offset=50*($total_pages-1); //偏移量
		  echo "<form action='user_manage.php' method='get'>";
		  echo "<tr>";
		  echo "<td colspan='4' class='td_naiyou'><a href='user_manage.php?page=1'>首页</a>&nbsp;&nbsp;&nbsp;";
		  if($page==1)
		    echo "上一页&nbsp;&nbsp;&nbsp;";
		  else
		    echo "<a href='user_manage.php?page=".($page-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
		  if($total_pages==0 || $page==$total_pages)
		    echo "下一页&nbsp;&nbsp;&nbsp;";
		  else
		    echo "<a href='user_manage.php?page=".($page+1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
		  echo "<a href='user_manage.php?page=".$total_pages."'>末页</a>&nbsp;&nbsp;&nbsp;";
		  echo "当前是第".$page."页，共".$total_pages."页。快速转到：";
		  
		  echo "<select name='page'>";
		  for($i=1;$i<=$total_pages;$i++){
		    if($i==$page)
			  echo "<option value=".$i." selected='selected'>第".$i."页</option>";
			else
			  echo "<option value=".$i.">第".$i."页</option>";
		  }
		  echo "</select>";
		  echo "<input type='submit' value='转到' />";
		  echo "</tr>";
		  echo "</form>";
		  ?>
		  <tr>
		    <td class="td_naiyou" style="width:150px;">用户名</td>
			<td class="td_naiyou" style="width:240px;">E-mail地址</td>
			<td class="td_naiyou" style="width:240px;">注册日期/时间</td>
			<td class="td_naiyou" style="width:65px;">详细信息</td>
		  </tr>
		  <?php
		  //添加用户信息
		  $sql="SELECT * FROM users ORDER BY register_time DESC LIMIT ".$offset.",50";
		  $result=mysql_query($sql,$conn);
		  while($row=mysql_fetch_array($result))
		  {
		    echo "<tr>";
			echo "<td class='td_naiyou' style='width:150px;'>".$row['name']."</td>";
			echo "<td class='td_naiyou' style='width:240px;'>".$row['email']."</td>";
			echo "<td class='td_naiyou' style='width:240px;'>".$row['register_time']."</td>";
			echo "<td class='td_naiyou' style='width:65px;'><a href='user_info.php?search_user=".$row['name']."'>查看</a></td>";
			echo "</tr>";
		  }
		  ?>
	    </table>
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