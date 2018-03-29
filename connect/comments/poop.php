<?php
include("db.php");
$select=mysql_query("select * from commenttable");
while($row=mysql_fetch_array($select))
{
	echo "<div id='sty'>";
	echo "<img src='files/fav icon.png'"."' width='50px' height='50px' align='left' />";
	echo "<div id='nameid'>".$row['name']."</div>";
	echo "<div id='msgid'>".$row['message']."</div>";
	echo "</div><br />";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Comment system using php and mysql</title>
<style type="text/css">
#sty
{
	margin:0 auto;
	margin-top:3px;
	border:#0F0 dashed 2px;
	width:500px;
	padding:15px;
	}
#fileid
{
	width:85px;
	height:20px;
	}
img
{
	margin-right:20px;
}
#nameid
{
	font-size:18px;
	color:#06F;
	font-family:"Comic Sans MS", cursive;
	margin-bottom:5px;
}
#msgid
{
	font-size:20px;
	color:#3CF;
	font-family:"Courier New", Courier, monospace;
	margin-bottom:5px;
}
#tnameid
{
	width:200px;
	font-size:20px;
	font-family:"Courier New", Courier, monospace;
	height:35px;
	color:#006;
	border:#666 solid 2px;
}
#tjobid
{
	width:200px;
	height:35px;
	font-size:20px;
	font-family:"Courier New", Courier, monospace;
	color:#006;
	border:#666 solid 2px;
}
#tmessageid
{
	max-width:200px;
	max-height:100px;
	min-width:200px;
	min-height:100px;
	font-size:20px;
	font-family:"Courier New", Courier, monospace;
	color:#006;
	border:#666 solid 2px;
}
#one
{
	font-size:18px;
	font-family:"Times New Roman", Times, serif;
	color:#00F;
}
#submit
{
	width:200px;
	height:30px;
	background-color:#999;
	color:#FFF;
	border:#666 solid 2px;
}



</style>

<script type="text/javascript">
function validation()
{
	var nam=document.comment.namename.value;
	var nam1=document.getElementById('tnameid');
	if(nam=="")
	{
		document.comment.namename.focus();
		nam1.style.borderColor="#f00";
		return false;
	}
	var nam1=document.getElementById('tnameid');
	nam1.style.borderColor="";
	var jo=document.comment.job.value;
	var jo1=document.getElementById('tjobid');
	if(jo=="")
	{
		document.comment.job.focus();
		jo1.style.borderColor="#f00";
		return false;
	}
	var jo1=document.getElementById('tjobid');
	jo1.style.borderColor="";
	var mess=document.comment.message.value;
	var mess1=document.getElementById('tmessageid');
	if(mess=="")
	{
		document.comment.message.focus();
		mess1.style.borderColor="#f00";
		return false;
	}
}
</script>
</head>

<body>
<form name="comment" method="post" action="comment.php" onSubmit="return validation()">
<table width="500" border="0" cellspacing="3" cellpadding="3" style="margin:auto;">
  <tr>
    <td align="right" id="one">Name :<span style="color:#F00;">*</span></td>
    <td><input type="text" name="namename" id="tnameid"></td>
  </tr>
  <tr>
    <td align="right" id="one">Work :<span style="color:#F00;">*</span></td>
    <td><input type="text" name="job" id="tjobid"></td>
  </tr>
  <tr>
    <td align="right" id="one"></td>
    <td><textarea name="message" id="tmessageid"></textarea></td>
  </tr>
  <tr>
  <td align="right" id="one"></td>
  <td><input type="submit" name="submit" id="submit" value="Submit Comment"></td>
  </tr>
</table>
</form>
</body>
</html>