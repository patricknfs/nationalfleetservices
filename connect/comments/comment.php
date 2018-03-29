<?php
include("db.php");
if(isset($_POST['submit']))
{
	$name=$_POST['namename'];
	$job=$_POST['job'];
	$message=$_POST['message'];
	$insert=mysql_query("insert into commenttable(name,job,message)values('$name','$job','$message')")or die(mysql_error());
	header("Location:poop.php");
	}
?>