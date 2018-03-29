<?php
include ("../include/application-top.php");
$dbObj = new DB();
$dbObj->fun_db_connect();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
?>

<?php
$sno=$_REQUEST["id"];
if($sno!=""){
//now get the userid and send the mail
$sql="SELECT IsOK FROM ".TABLE_NEWSLETTER_USER." where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0){
$IsOK=$row["IsOK"];
}

if($IsOK=="0"){
$newActivated=1;
$myStatusMessage="Email ID Activated successfully";
}
else{
$newActivated=0;
$myStatusMessage="Email ID Blocked successfully";
}

$sql="update ".TABLE_NEWSLETTER_USER." set IsOK=$newActivated where sno=$sno";
$result = mysql_query($sql);

}


?>

<script language="javascript">window.location.href="list.php?msg=<?php echo $myStatusMessage; ?>";</script>
