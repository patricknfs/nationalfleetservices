<?php
session_start();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
?>

<?php
include ("../../include/dbconnect.php");

$sno=$_REQUEST["id"];

if($sno!=""){
//now get the userid and send the mail
$sql="SELECT isActivated FROM DER_ProductMaster where sno=$sno";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$resultsnumber = mysql_numrows($result);
if ($resultsnumber != 0){
$isActivated=$row["isActivated"];
}

if($isActivated=="0"){
$newActivated=1;
$myStatusMessage="Product Activated successfully";
}
else{
$newActivated=0;
$myStatusMessage="Product Blocked successfully";
}
$sql="update DER_ProductMaster set isActivated=$newActivated where sno=$sno";
$result = mysql_query($sql);

}


?>

<script language="javascript">window.location.href="list.php?msg=<?php echo $myStatusMessage; ?>";</script>
