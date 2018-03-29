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
$bool=1;
$CatID=$_REQUEST["CatID"];
$SubCatName=$_REQUEST["SubCatName"];
$Descriptions=$_REQUEST["Descriptions"];
$FullImage=$_FILES['FullImage']['name'];
$H_FullImage=$_REQUEST["H_FullImage"];
$ImageAction=$_REQUEST["ImageAction"];

$sno=$_REQUEST["id"];


if($sno==""){
$sql="Select * from ".TABLE_MODELS." where SubCatName='$SubCatName' and CatID=$CatID";
}
else{
$sql="Select * from ".TABLE_MODELS." where SubCatName='$SubCatName' and CatID=$CatID and sno<>$sno";
}
$result = mysql_query($sql);
$total=mysql_num_rows($result); 
if ($total!=0){
$message="A Sub-Category with name <b>'$SubCatName'</b>, in the selected Category already Exists, please Enter different name<br><a href='javascript:history.back();'>Click here</a> to go back.";
$bool=0;
}

if($bool==1){

//now  we will do the work with the image
$uploadDir="../../uploads/";
$uploadFile="$uploadDir$FullImage";

//new record
if($sno=="")
{
if($FullImage!="")
{
	$n = 1; 
	while (file_exists ($uploadFile)) { 
    // get filename and extension 
  	$f_ext  = substr (strrchr ($uploadFile, '.'), 1); 
	$pos = strrpos($uploadFile, "-");
    if ($pos!=0) 
	{
	$f_name = substr ($uploadFile, 0, $pos);
	}
	else
	{
	$f_name = substr ($uploadFile, 0, (strlen($uploadFile)-4));
	}
    // generate new name 
    // to rename the OLD file, you could use the following: 
    //rename ($file_path, $f_name . '_' . $n . '.' . $f_ext); 
    $uploadFile = $f_name . '-' . $n . '.' . $f_ext; 
    $n++; 
	}
	$FullImage= substr($uploadFile,strrpos($uploadFile, "/")+1,strlen($uploadFile)-strrpos($uploadFile, "/")); 
	move_uploaded_file($_FILES['FullImage']['tmp_name'], $uploadFile);
}
}

//modifying record
else
{
switch($ImageAction)
{
case "1"://keep original image
{
//here only set the $Photograph variable to the img name
$FullImage=$H_FullImage;
break;
}

case "2"://replace original image
{
//here first delete the file and then 
//upload the new file and then
//set the $realimage variable to the new img name
$uploadFile="$uploadDir$H_FullImage";
if (file_exists($uploadFile)) 
{unlink("$uploadFile");}

$uploadFile="$uploadDir$FullImage";
if($FullImage!="")
{
	$n = 1; 
	while (file_exists ($uploadFile)) { 
    // get filename and extension 
  	$f_ext  = substr (strrchr ($uploadFile, '.'), 1); 
	$pos = strrpos($uploadFile, "-");
    if ($pos!=0) 
	{
	$f_name = substr ($uploadFile, 0, $pos);
	}
	else
	{
	$f_name = substr ($uploadFile, 0, (strlen($uploadFile)-4));
	}
    // generate new name 
    // to rename the OLD file, you could use the following: 
    //rename ($file_path, $f_name . '_' . $n . '.' . $f_ext); 
    $uploadFile = $f_name . '-' . $n . '.' . $f_ext; 
    $n++; 
	}
	$FullImage= substr($uploadFile,strrpos($uploadFile, "/")+1,strlen($uploadFile)-strrpos($uploadFile, "/")); 
	move_uploaded_file($_FILES['FullImage']['tmp_name'], $uploadFile);
}
break;
}

case "3"://delete original image
{
//here delete the image and then
//set the $realimage variable =""
$uploadFile="$uploadDir$H_FullImage";
if (file_exists($uploadFile)) 
{unlink("$uploadFile");}
$FullImage="";
break;
}


default:
{
$uploadFile="$uploadDir$FullImage";
if($FullImage!="")
{
	$n = 1; 
	while (file_exists ($uploadFile)) { 
    // get filename and extension 
  	$f_ext  = substr (strrchr ($uploadFile, '.'), 1); 
	$pos = strrpos($uploadFile, "-");
    if ($pos!=0) 
	{
	$f_name = substr ($uploadFile, 0, $pos);
	}
	else
	{
	$f_name = substr ($uploadFile, 0, (strlen($uploadFile)-4));
	}
    // generate new name 
    // to rename the OLD file, you could use the following: 
    //rename ($file_path, $f_name . '_' . $n . '.' . $f_ext); 
    $uploadFile = $f_name . '-' . $n . '.' . $f_ext; 
    $n++; 
	}
	$FullImage= substr($uploadFile,strrpos($uploadFile, "/")+1,strlen($uploadFile)-strrpos($uploadFile, "/")); 
	move_uploaded_file($_FILES['FullImage']['tmp_name'], $uploadFile);
}
}
}
}


if($sno!=""){
$sql = "update ".TABLE_MODELS." set 
CatID=$CatID,
SubCatName='$SubCatName',
Descriptions='$Descriptions',
FullImage='$FullImage'
WHERE sno=$sno";
$message="Sub-Category Updated Successfully.";
}
else{

//inserting the data
$EntryDate=date('Y-m-d');
$sql="INSERT INTO ".TABLE_MODELS."(CatID,SubCatName,Descriptions,FullImage,EntryDate)
VALUES (
$CatID,'$SubCatName', '$Descriptions', '$FullImage', '$EntryDate'
)";
$message="Sub-Category Created Successfully.";
}
}
$result = mysql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEB ADMIN SECTION</title>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F9F8F8;
}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
                <td width="80%" class="headGray"><?php
			if ($sno!=""){echo "Modify ";}
			else{echo "Add ";}
			?>
                  Model module </td>
                <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
              </tr>
              <tr>
                <td colspan="3"><p>&nbsp;</p>
                  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr class="tablesRowHeadingBG">
                      <td height="20" colspan="3" class="bHead"><?php
			if ($sno!=""){echo "Modify ";}
			else{echo "Add ";}
			?>
                        Model Section </td>
                    </tr>
                    <tr>
                      <td width="32%">&nbsp;</td>
                      <td width="48%">&nbsp;</td>
                      <td width="20%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="1" colspan="3" class="line_color"></td>
                    </tr>
                    <tr class="tablesRowBG_2">
                      <td height="20" style="padding:20px;" colspan="3"><div align="center"><?php echo $message; ?></div></td>
                    </tr>
                    <tr>
                      <td height="1" colspan="3" class="line_color"></td>
                    </tr>
                    <tr class="tablesRowBG_2">
                      <td colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%"><div align="right"><a href="index.php" class="bText_link">Add More </a></div></td>
                            <td>&nbsp;</td>
                            <td width="30%"><a href="list.php" class="bText_link">View All</a> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="1" colspan="3" class="line_color"></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="javascript:history.back();"><img src="../images/BACK.jpg" alt="Back" width="38" height="33" border="0"></a></td>
    <td><div align="right"><a href="javascript:history.forward();"><img src="../images/FORWARD.jpg" alt="Forward" width="38" height="33" border="0"></a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
