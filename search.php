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
  if(!$_SESSION['tdslogin']=="Tadashii")
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
		  $day='星期日';
		  break;
		case 1:
		  $day='星期一';
		  break;
		case 2:
		  $day='星期二';
		  break;
		case 3:
		  $day='星期三';
		  break;
		case 4:
		  $day='星期四';
		  break;
		case 5:
		  $day='星期五';
		  break;
		case 6:
		  $day='星期六';
		  break;
	  }
	  date_default_timezone_set('Asia/Hong_Kong');
	  echo date("Y 年 n 月 j 日 ").$day; ?></div>
	  <div style="float:left;margin-top:45px;"><a href="main.php">返回</a></div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	  <?php
		  //连接数据库
		  include("conn.php");
		  //判断输入信息
		  if(!preg_match("/^[0-9]+$/",$_GET['search_year']) || !preg_match("/^[0-9]+$/",$_GET['search_month']) || !preg_match("/^[0-9]+$/",$_GET['search_day']))
		    die('有非法输入内容！请重新输入。');
		  else{
		  //判断SQL语句
		  if($_GET['search_year']!="" && $_GET['search_month']=="" && $_GET['search_day']=="")
	      {
		    $sql="SELECT * FROM data WHERE year='".$_GET['search_year']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
		    $page_sql="SELECT COUNT(*) FROM data WHERE year='".$_GET['search_year']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_year']."年收支情况";
		   }
		  elseif($_GET['search_year']=="" && $_GET['search_month']!="" && $_GET['search_day']=="")
		  {
		    $sql="SELECT * FROM data WHERE month='".$_GET['search_month']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE month='".$_GET['search_month']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_month']."月收支情况";
		  }
		  elseif($_GET['search_year']=="" && $_GET['search_month']=="" && $_GET['search_day']!="")
		  {
			$sql="SELECT * FROM data WHERE day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_day']."日收支情况";
		  }
		  elseif($_GET['search_year']!="" && $_GET['search_month']!="" && $_GET['search_day']=="")
		  {
			$sql="SELECT * FROM data WHERE year='".$_GET['search_year']."' AND month='".$_GET['search_month']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE year='".$_GET['search_year']."' AND month='".$_GET['search_month']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_year']."年".$_GET['search_month']."月收支情况";
		  }
		  elseif($_GET['search_year']!="" && $_GET['search_month']=="" && $_GET['search_day']!="")
		  {
			$sql="SELECT * FROM data WHERE year='".$_GET['search_year']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE year='".$_GET['search_year']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_year']."年".$_GET['search_day']."日收支情况";
		  }
		  elseif($_GET['search_year']=="" && $_GET['search_month']!="" && $_GET['search_day']!="")
		  {
			$sql="SELECT * FROM data WHERE month='".$_GET['search_month']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE month='".$_GET['search_month']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_month']."月".$_GET['search_day']."日收支情况";
		  }
		  elseif($_GET['search_year']!="" && $_GET['search_month']!="" && $_GET['search_day']!="")
		  {
			$sql="SELECT * FROM data WHERE year='".$_GET['search_year']."' AND month='".$_GET['search_month']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."' ORDER BY year,month,day DESC";
			$page_sql="SELECT COUNT(*) FROM data WHERE year='".$_GET['search_year']."' AND month='".$_GET['search_month']."' AND day='".$_GET['search_day']."' AND provider='".$_SESSION['loginuser']."'";
			$title=$_GET['search_year']."年".$_GET['search_month']."月".$_GET['search_day']."日收支情况";
		  }
		  elseif($_GET['search_year']=="" && $_GET['search_month']=="" && $_GET['search_day']=="")
		  {
			die("未输入任何查询信息！");
		  }
		  }
		?>
	  <p style="text-align:center;font-size:30px;"><?php echo $title; ?></p>
	  <div id="show_in_out">
	    <table  style="border:0px;">
		<?php
		  //分页，每页50条记录
		  @$total_pages=mysql_fetch_array(mysql_query($page_sql,$conn))or die("读取数据库出错！");
		  $total_pages=ceil($total_pages[0]/50);
		  if(isset($_GET['page']))
		    $page=$_GET['page'];
		  else
		    $page=1;
		  $offset=50*($page-1); //偏移量
		?>
		  <tr>
			<?php
			$get_value="search_year=".$_GET['search_year']."&search_month=".$_GET['search_month']."&search_day=".$_GET['search_day'];
			echo "<td style='border:0px;'><a href='search.php?".$get_value."&page=1'>首页</a></td>";
			if(!isset($_GET['page'])||$_GET['page']==1)
			  echo "<td style='border:0px;'>上一页</td>";
			else
			  echo "<td style='border:0px;'><a href='search.php?".$get_value."&page=".($page-1)."'>上一页</a></td>";
			if($total_pages==0||$page==$total_pages)
			  echo "<td style='border:0px;'>下一页</td>";
			else
			  echo "<td style='border:0px;'><a href='search.php?".$get_value."&page=".($page+1)."'>下一页</a></td>";
			echo "<td style='border:0px;'><a href='search.php?".$get_value."&page=".$total_pages."'>末页</td>";
			?>
			<td style='border:0px;'>&nbsp;&nbsp;当前是第<?php echo $page;?>页，共<?php echo $total_pages;?>页。</td>
		  </tr>
		</table>
	    <table style="border-collapse:collapse">
		  <tr>
		    <td style="background-color:skyblue;width:70px;">收入/支出</td>
			<td style="background-color:skyblue;width:60px;">金额</td>
			<td style="background-color:skyblue;width:350px;">来历/用途</td>
			<td style="background-color:skyblue;width:130px;">日期</td>
			<td style="background-color:skyblue;width:40px;">删除</td>
		  </tr>
		  <?php
		  //读取数据
		  @$result=mysql_query($sql." LIMIT ".$offset.",50",$conn)or die("读取数据库出错！");
		  while($row=mysql_fetch_array($result))
		  {
		    echo "<tr>";
		    echo "<td style='background-color:Cornsilk;width:70px;'>".$row['type']."</td>";
			echo "<td style='background-color:Cornsilk;width:60px;'>".$row['money']."</td>";
			echo "<td style='background-color:Cornsilk;width:350px;'>".$row['uses']."</td>";
			$date=$row['year']."年".$row['month']."月".$row['day']."日";
			echo "<td style='background-color:Cornsilk;width:130px;'>".$date."</td>";
			echo "<td style='background-color:Cornsilk;width:40px;'><a href='delete_data.php?id=".$row['ID']."'>删除</a></td>";
			echo "</tr>";
		  }
		  ?>
		  <tr>
		  <?php
		  //统计
		  $total_earn=0;
		  $total_cost=0;
		  @$result=mysql_query($sql,$conn)or die("读取数据库出错！");
		  while($row=mysql_fetch_array($result))
		  {
			if($row['type']=="收入")
			  $total_earn+=$row['money'];
			elseif($row['type']=="支出")
			  $total_cost+=$row['money'];
	      }
		  echo "<td colspan='5' style='background-color:Cornsilk;'>总计收入：$total_earn 元 || 总计支出：$total_cost 元</td>";
		  ?>
		  </tr>
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
  </div>
</body>
</html>