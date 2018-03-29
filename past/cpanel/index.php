<?php 
include ("include/application-top.php");
$dbObj = new DB();
$dbObj->fun_db_connect(); 
$UserID   = $_POST["UserName"];
$Password = $_POST["Password"];

$sql           = "SELECT * FROM ".TABLE_ADMINS." WHERE AdminName='$UserID' AND AdminPass='$Password'";
$result        = $dbObj->fun_db_query($sql);
$resultsnumber = $dbObj->fun_db_get_num_rows($result);

if($resultsnumber != 0){
	$_SESSION["AdminName"] = $UserID;
	header("location:admin.php"); 
}else{
	$_SESSION["AdminName"] = "";
	if(($UserID!="") && ($Password!="")){
		$message="Wrong Username or Password";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Fleet Street Control Panel</title>
<script language="javascript" type="text/javascript" src="include/required_functions.js"></script>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
	.style1 {color: #FFFFCC}
</style>
<script language="javascript" type="text/javascript">
	function focusOn(){
		document.getElementById('UserName').focus();
	}
</script>
</head>
<body onLoad="changeScrollbarColor(), focusOn();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top" bgcolor="#FFFFFF"><div align="right"><a href="index.php" title="Home"><img src="images/FleetStreet_logo.jpg" alt="Home" border="0"></a></div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="370" valign="top" bgcolor="#A6B3BC" style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px;">
						<div class="headGray style1" style="height:30px; border:0px solid #000000; text-align:center;">
							<font color="#FFFFFF">Fleet Street Control Panel</font>
						</div>
						<div align="center" class="style1">
							<p>&nbsp;</p>
							<table width="40%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
								<tr>
									<td>
										<form name="form1" method="post" action="index.php">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<?php if($message!=""){?>
												<tr>
													<td colspan="2" align="center">&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td colspan="3"><div align="center" class="bHead"><?php echo $message; ?></div></td>
												</tr>
												<?php }?>
												<tr>
													<td colspan="2">&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td height="30" colspan="2" class="tableHead"><div align="right">User Name &nbsp;&nbsp;</div></td>
													<td><input name="UserName" type="text" class="textbox" id="UserName"></td>
												</tr>
												<tr>
													<td height="30" colspan="2" class="tableHead"><div align="right">Password &nbsp;&nbsp;</div></td>
													<td><input name="Password" type="password" class="textbox" id="Password"></td>
												</tr>
												<tr>
													<td height="40" colspan="3">
														<div align="center">
															<input name="Submit" type="submit" class="Button" value="Submit">&nbsp;
															<input name="Reset" type="reset" class="Button" value="Reset">
														</div>
													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#FFFFFF" style="padding-top:20px; padding-bottom:12px; padding-left:10px; padding-right:10px;">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
