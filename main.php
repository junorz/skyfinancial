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
	  <?php
	  include('conn.php');
	  //刷新用户当前等级，防止管理用户被更改等级之后若停留在此页面刷新仍然出现管理选项
	  $row=(mysql_fetch_array(mysql_query("SELECT * FROM users WHERE name='".$_SESSION['loginuser']."'",$conn)));
	  $_SESSION['level']=$row['level'];
	  if($_SESSION['level']==255)
	    echo "<div style='float:left;margin-top:45px;'><a href='user_manage.php'>管理用户</a></div>";
	  ?>
	  <div style="float:left;margin-top:45px;margin-left:10px;"><a href="logout.php">注销</a></div>
	  <div style="clear:both"></div>
	</div>
	<div id="body_part">
	
	  <div id="today_in_ex">
	  <form action="today_in_ex_update.php" method="post">
	    <p style="margin-left:30px;clear:both;text-decoration:underline;">●快速录入开支：</p>
		<div style="float:left;margin-top:-5px;width:50px;margin-left:30px;">项目：</div>
		<div style="float:left;margin-top:-5px;"><select name="in_ex"><option value="支出" selected="selected">支出</option><option value="收入">收入</option></select></div>
		<div style="float:left;margin-top:-5px;margin-left:30px;">金额(元)：</div>
		<div style="float:left;margin-top:-5px;"><input type="text" name="money" maxlength="8" style="width:60px;"></div>
		<div style="clear:both"></div>
		<div style="float:left;margin-top:10px;margin-left:30px;">日期：</div>
		<div style="float:left;margin-top:10px;margin-left:5px;"><?php echo "<input type='text' name='year' maxlength='4' style='width:35px;' value='".date(Y)."'>";?></div>
		<div style="float:left;margin-top:10px;margin-left:5px;">年</div>
		<div style="float:left;margin-top:10px;margin-left:5px;"><?php echo "<input type='text' name='month' maxlength='2' style='width:18px;' value='".date(n)."'>";?></div>
		<div style="float:left;margin-top:10px;margin-left:5px;">月</div>
		<div style="float:left;margin-top:10px;margin-left:5px;"><?php echo "<input type='text' name='day' maxlength='2' style='width:18px;' value='".date(j)."'>";?></div>
		<div style="float:left;margin-top:10px;margin-left:5px;">日</div>
		<div style="float:left;margin-top:12px;margin-left:10px;font-family:Tahoma;font-size:13px;">※注：月份和日期不足两位的不需要补0，例如：1月1日。而不是01月01日。</div>
		<div style="clear:both"></div>
		<div style="float:left;margin-top:10px;margin-left:30px;width:50px;">来历/用途：</div>
		<div style="float:left;margin-top:10px;"><textarea name="uses" rows="4" cols="35" style="font-family:tahoma;font-size:13px;"></textarea></div>
		<div style="float:left;margin-top:45px;margin-left:10px;font-family:Tahoma;font-size:13px;">(用途最多可输入100个汉字)</div>
		<div style="clear:both"></div>
		<div style="float:left;margin-top:10px;margin-left:30px;">录入者：</div>
		<div style="float:left;margin-top:10px;"><?php echo $_SESSION['loginuser'];?></div>
		<div style="float:left;margin-top:10px;margin-left:10px;"><input type="submit" value="录入" /></div>
		<div style="clear:both"></div>
	  </form>
	  </div>
	  
	  <div class="show">
	    <p style="text-decoration:underline;">●今日收支详细表：</p>
	    <table style="border-collapse:collapse;border:1px solid;">
		  <tr>
		    <td style="background-color:skyblue;width:70px;">收入/支出</td>
			<td style="background-color:skyblue;width:60px;">金额</td>
			<td style="background-color:skyblue;width:350px;">来历/用途</td>
			<td style="background-color:skyblue;width:130px;">日期</td>
			<td style="background-color:skyblue;width:40px;">删除</td>
		  </tr>
		  <?php
		  //设置统计变量
		  $earn_sum=0;
		  $cost_sum=0;
		  $sql="SELECT * FROM data WHERE year='".date(Y)."' AND month='".date(n)."' AND day='".date(j)."' AND provider='".$_SESSION['loginuser']."'";
		  $result=mysql_query($sql,$conn);
		  while($row=mysql_fetch_array($result))
		  {
		    echo "<tr>";
			echo "<td style='background-color:Cornsilk;width:70px;'>".$row['type']."</td>";
			echo "<td style='background-color:Cornsilk;width:60px;'>".$row['money']."</td>";
			//判断收入支出并作统计
			if($row['type']=="收入")
			  $earn_sum+=$row['money'];
			elseif($row['type']=="支出")
			  $cost_sum+=$row['money'];
			echo "<td style='background-color:Cornsilk;width:350px;'>".$row['uses']."</td>";
			//取得日期
			$date=$row['year']."年".$row['month']."月".$row['day']."日";
			echo "<td style='background-color:Cornsilk;width:130px;'>".$date."</td>";
			echo "<td style='background-color:Cornsilk;width:40px;'><a href='delete_data.php?id=".$row['ID']."'>删除</a></td>";
		  }
		  echo "<tr>";
	      echo "<td colspan='6' style='background-color:Cornsilk;'>今日收入出总计：".$earn_sum."元 || 今日支出总计：".$cost_sum."元</td>";
		  echo "</tr>";
		  
		  ?>
		  </table>
	  </div>
	  
	  <div class="show">
	    <p style="text-decoration:underline;"><a name="month_table">●本月收支详细表：</a></p>
			<table style="margin-bottom:10px;border:0px;">
			  <?php
				$total_pages=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM data WHERE year='".date(Y)."' AND month='".date(n)."' AND provider='".$_SESSION['loginuser']."'",$conn)); //取得记录数目
		        $total_pages=ceil($total_pages[0]/20);  //取一个等于或比这个数大的整数，作为页数
				if(isset($_GET['page']))
				  $page=$_GET['page'];
				else
				  $page=1;
		        echo "<tr>";
		        echo "<td style='width:50px;text-align:center;border:0px;'><a href='main.php?page=1#month_table'>首页</a></td>";
				if($page==1)
			      echo "<td style='width:50px;text-align:center;border:0px;'>上一页</td>";
				else
				  echo "<td style='width:50px;text-align:center;border:0px;'><a href='main.php?page=".($_GET['page']-1)."#month_table'>上一页</a></td>";
				if($total_pages==0 || $page==$total_pages) //没有记录的时候$total_pages为0
			      echo "<td style='width:50px;text-align:center;border:0px;'>下一页</td>";
				else
				  echo "<td style='width:50px;text-align:center;border:0px;'><a href='main.php?page=".($_GET['page']+1)."#month_table'>下一页</a></td>";
			    echo "<td style='width:50px;text-align:center;border:0px;'><a href='main.php?page=".$total_pages."#month_table'>末页</a></td>";
			    if(isset($_GET['page']))  //判断当前页面
		          $current_page=$_GET['page'];
		        else
		          $current_page=1;
				echo "<td style='width:230px;border:0px;'>当前是第".$current_page."页，共".$total_pages."页。快速转到：</td>";
				?>
				<form action="main.php" method="get">
				<td style="border:0px;">
				<?php
				//循环产生页面列表
				echo "<select name='page'>";
				for($page_list=1;$page_list<=$total_pages;$page_list++){
				  echo "<option value='".$page_list."'>第".$page_list."页</option>";
				}
				echo "</select>";
			  ?>
			  <td style="border:0px;"><input type="submit" value="转到" /></td>
			  </form>
			</table>
			
		  </tr>
		</table>
	    <table border="1" style="border-collapse:collapse">		  
		  <tr>
		    <td style="background-color:skyblue;width:70px;">收入/支出</td>
			<td style="background-color:skyblue;width:60px;">金额</td>
			<td style="background-color:skyblue;width:350px;">来历/用途</td>
			<td style="background-color:skyblue;width:130px;">日期</td>
			<td style="background-color:skyblue;width:40px;">删除</td>
		  </tr>
		  <?php
		  //分页
		  $offset=20*($current_page-1); //设置偏移量
		  $sql="SELECT * FROM data WHERE year='".date(Y)."' AND month='".date(n)."' AND provider='".$_SESSION['loginuser']."' ORDER BY day DESC LIMIT ".$offset.",20";
		  @$result=mysql_query($sql,$conn)or die("读取数据库发生错误！");
		  while($row=mysql_fetch_array($result)){
		    echo "<tr>";
			echo "<td style='background-color:Cornsilk;width:70px;'>".$row['type']."</td>";
			echo "<td style='background-color:Cornsilk;width:60px;'>".$row['money']."</td>";
			echo "<td style='background-color:Cornsilk;width:350px;'>".$row['uses']."</td>";
			//取得日期
			$date=$row['year']."年".$row['month']."月".$row['day']."日";
			echo "<td style='background-color:Cornsilk;width:130px;'>".$date."</td>";
			echo "<td style='background-color:Cornsilk;width:40px;'><a href='delete_data.php?id=".$row['ID']."'>删除</a></td>";
			echo "</tr>";
		   }
		    echo "<tr>";
			
			//统计开始
			$earn_sum=0;
		    $cost_sum=0;  //设置统计变量
			@$result=mysql_query("SELECT * FROM data WHERE year='".date(Y)."' AND month='".date(n)."' AND provider='".$_SESSION['loginuser']."'",$conn)or die("读取数据库发生错误！"); 
			while($row=mysql_fetch_array($result)){
			//判断收入支出并作统计
			if($row['type']=="收入")
			  $earn_sum+=$row['money'];
			elseif($row['type']=="支出")
			  $cost_sum+=$row['money'];
			}
	        echo "<td colspan='5' style='background-color:Cornsilk;'>本月收入出总计：".$earn_sum."元 || 本月支出总计：".$cost_sum."元</td>";
		    echo "</tr>";
		  ?>
		</table>
	  </div>
	  
	  <div class="show">
	    <p style="text-decoration:underline;"><a name="search">●详细查询：</a></p>
		<form action="search.php" method="get">
          <p>查询 <input type="text" name="search_year" maxlength="4" style="width:35px;"/> 年 <input type="text" name="search_month" maxlength="2" style="width:35px;"/> 月 <input type="text" name="search_day" maxlength="2" style="width:35px;"/> 日的收支情况 
		  <input type="submit" value="查询" />
		  </p>
		</form>
		<p style="font-family:Tahoma;font-size:13px;">注：以上查询条件满足一个即可。月份和日期不足两位的不需要补0，例如：1月1日。而不是01月01日。</p>
	  </div>
	  
	  <div class="show">
	  <p style="text-decoration:underline;"><a href="all_income_expense.php">●查看所有开支情况</a></p>
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