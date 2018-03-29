<?php include_once('../classes/check.class.php'); ?>

<?php protect("1, 2, 3"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, height=device-height "/>

<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="iphorm/css/pagestyles_offer.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="iphorm/css/block_offer.css" /><!-- Standard form layout -->



<script type="text/javascript" src="iphorm/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="iphorm/js/plugins.js"></script>
<script type="text/javascript" src="iphorm/js/scripts.js"></script>

<title>The DealDen.co.uk</title>

</head>

<body>

<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>

<!--<div id="sidetabholder">
<div class="inner">
<a href=""><img src="img/sidebut-callme.png" class="tab"></a>
<a href=""><img src="img/sidebut-applyonline.png" class="tab"></a>
<a href=""><img src="img/sidebut-livechat.png" class="tab"></a>
</div>
</div>//-->

<!-- HEADER //-->
<div id="header">
<div class="container">

<div id="tophead">
<div class="left">
<!--<ul id="sociallinks">
<li class="facebook"><a href="">Facebook</a></li>
<li class="twitter"><a href="">Twiiter</a></li>
<li class="linkedin"><a href="">LinkedIn</a></li>
<li class="googleplus"><a href="">Google&plus;</a></li>
<li class="rss"><a href="">RSS</a></li>
</ul>//-->
</div>
<div class="right">

<?
include ("../login_head.php"); 
?>

</div>
</div>

<div id="bandana">
<div class="left">
<div id="logos">
<img src="../img/logo.png">
</div>
</div>

<div class="right">
<div id="contact">
Call us on <span class="look">0845 123 456</span>
<br />
<span class="small">Monday - Friday 9am - 5:30pm</span>

</div>

<a href=""><img id="contact-phone" src="../img/contact-us.png" /></a>

</div>
</div>

<?
include ("../menu.php"); 
?>

<div id="stripe"></div>

</div>
</div>
<!-- END HEADER //-->


<!-- MAIN //-->
<div id="main">
<div class="container">

<div id="mainleft">

<div class="widget">
<?
include("../dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM widgets ORDER BY RAND() LIMIT 2";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();

$i=0;
while ($i < $num) {
$title=mysql_result($result,$i,"title");
$desc=mysql_result($result,$i,"desc");
$img_url=mysql_result($result,$i,"img_url");
$clickto=mysql_result($result,$i,"clickto");
$id=mysql_result($result,$i,"id"); 
?>

<a href="<? echo "$clickto"; ?>">
<img src="http://www.dealden.co.uk/widgets/img/<? echo "$img_url"; ?>" />
</a>

<br /><br />

<?
++$i;
} 
?>

</div>

</div>

<div id="mainright_email">

<?php
include("../dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM specialoffers WHERE id='{$_GET['id']}'";
$result=mysql_query($query);
$num=mysql_numrows($result);

$i=0;
while ($i < $num) {
$pic=mysql_result($result,$i,"pic");
$make=mysql_result($result,$i,"make");
$model=mysql_result($result,$i,"model");
$term=mysql_result($result,$i,"term");
$mileage=mysql_result($result,$i,"mileage");
$maint=mysql_result($result,$i,"maint"); 
$stock=mysql_result($result,$i,"stock"); 
$pch=mysql_result($result,$i,"pch"); 
$rental=mysql_result($result,$i,"rental"); 
$comms=mysql_result($result,$i,"comms"); 
$co2=mysql_result($result,$i,"co2"); 
$mpg=mysql_result($result,$i,"mpg"); 
$id=mysql_result($result,$i,"id");

?>

<ul id="breadcrumb">
<a title="" href="../index.php">Home</a> &gt; 
<a title="" href="../offers.php">Offers</a> &gt; 
<a title="" href="../offer-info.php?id=<?php echo "$id"; ?>"><?php echo "$make"; ?><?php echo "$model"; ?></a> &gt;
Email offer
</ul>

<h1 class="biggy">Email Offer</h1>
<p>Use this form to send a customer friendly email of this offer to yourself, your colleague or your customers. The monthly rental fields can be edited to reflect your sold rental.</p>

<div class="left">

<img src="../img/veh-pic/<? echo "$pic"; ?>" width="200px" />

</div>

<div class="left">

<div class="iphorm-outer">
<form class="iphorm" action="iphorm/process_email-offer.php" method="post" enctype="multipart/form-data">
<div class="iphorm-wrapper">
<div class="iphorm-inner">
<!--<div class="iphorm-name_title">Please get in touch</div>//-->
<div class="iphorm-container clearfix">
				
<div class="element-wrapper offerid-element-wrapper clearfix">
<label for="offerid">Offer ID <span class="red">*</span></label>
<div class="input-wrapper offerid-input-wrapper">
<input class="offerid-element" value="<?php echo "$id"; ?>" id="offerid" type="text" name="offerid" />
</div>
</div>

<!-- Begin Vehicle element -->
<div class="element-wrapper emailad-element-wrapper clearfix">
<label for="emailad">Email To <span class="red">*</span></label>
<div class="input-wrapper emailad-input-wrapper">
<input class="emailad-element iphorm-tooltip" value="<?php echo $_SESSION['jigowatt']['email']; ?>" id="emailad" type="text" name="emailad" title="A customer friendly email will be sent to this email address." />
</div>
</div>
<!-- End Vehicle element -->

<!-- Begin Vehicle element -->
<div class="element-wrapper vehicle-element-wrapper clearfix">
<label for="vehicle">Vehicle <span class="red">*</span></label>
<div class="input-wrapper vehicle-input-wrapper">
<input class="vehicle-element" value="<?php echo "$make $model $desc"; ?>" id="vehicle" type="text" name="vehicle" />
</div>
</div>
<!-- End Vehicle element -->


<!-- Begin 3years element -->
<div class="element-wrapper threeyears-element-wrapper clearfix">
<label for="threeyears">Lease Type<span class="red">*</span></label>
<div class="input-wrapper threeyears-input-wrapper">
<input class="threeyears-element" id="threeyears" value="<?php if(isset($_GET['ultiProduct'])) { echo($_GET['ultiProduct']); } ?>" type="text" name="threeyears" />
</div>
</div>
<!-- End 3years element -->


<!-- Begin 3years element -->
<div class="element-wrapper threeyears-element-wrapper clearfix">
<label for="threeyears">Contract<span class="red">*</span></label>
<div class="input-wrapper threeyears-input-wrapper">
<input class="threeyears-element" id="threeyears" value="

<?php if(isset($_GET['ultiUpfront'])) { echo($_GET['ultiUpfront']); } ?>+
<?php if(isset($_GET['ultiRemain'])) { echo($_GET['ultiRemain']); } ?> with 
<?php if(isset($_GET['ultiKpa'])) { echo($_GET['ultiKpa']); } ?> miles per annum

" type="text" name="threeyears" />
</div>
</div>
<!-- End 3years element -->

<!-- Begin 3years element -->
<div class="element-wrapper threeyears-element-wrapper clearfix">
<label for="threeyears">Initial Rental<span class="red">*</span></label>
<div class="input-wrapper threeyears-input-wrapper">
<input class="threeyears-element" id="threeyears" value="<?php if(isset($_GET['ultiInitial'])) { echo($_GET['ultiInitial']); } ?>" type="text" name="threeyears" />
</div>
</div>
<!-- End 3years element -->

<!-- Begin 2years element -->
<div class="element-wrapper twoyears-element-wrapper clearfix">
<label for="twoyears">Monthly Rental<span class="red">*</span></label>
<div class="input-wrapper twoyears-input-wrapper">
<input class="twoyears-element iphorm-tooltip" id="twoyears" value="<?php if(isset($_GET['ultiRental'])) { echo($_GET['ultiRental']);} ?>" type="text" name="twoyears" title="Populated rental includes &pound;<? echo "$comms"; ?> commission." />
</div>
</div>
<!-- End 2years element -->



						
						<div class="element-wrapper dnotes-element-wrapper clearfix">
                            <label class="notes" for="dnotes">Message </label>
                            <div class="input-wrapper dnotes-input-wrapper clearfix">
                                <textarea class="textypoop dnotes-element" id="dnotes" name="dnotes" rows="6" cols="50"></textarea>
                            </div>
                        </div>
						
                        <!-- Begin Pic element -->
                        <div style="display: none;" class="element-wrapper pic-element-wrapper clearfix">
                            <label for="pic">Picture </label>
                            <div class="input-wrapper pic-input-wrapper">
                                <input class="pic-element" id="pic" value="http://www.dealden.co.uk/img/veh-pic/<?php echo "$pic"; ?>" type="text" name="pic" />
                            </div>
                        </div>
                        <!-- End Pic element -->
						
                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="submit-element" type="submit" name="contact" value="Send Offer" />
                            </div>
                        </div>
                        <!-- End Submit button -->
	               </div><!-- /.iphorm-container -->
	           </div><!-- /.iphorm-inner -->
				
				
		   </div><!-- /.iphorm-wrapper -->
		</form>
	</div><!-- /.iphorm-outer -->









<?php
++$i;
}
?>
</div>

<div class="clearfix"></div>

</div>

<div class="clearfix"></div>

</div>
</div>
<!-- END MAIN //-->


<!-- FOOTER //-->
<div id="footer">
<div class="container-foot">

<div id="stripe"></div>

<div id="toes">
<div class="left">
&copy; 2013 <a href="http://www.dealdel.co.uk">DealDen.co.uk</a> is a trading style of Fleet Street LTD. All rights reserved.
</div>
<div class="right">

<ul id="foot-links">
<li><a href="">Home</a> | </li>
<li><a href="">Privacy Policy</a> | </li>
<li><a href="">Sitemap</a> | </li>
<li><a href="">Contact</a> | </li>
<li><a href="">Login</a></li>
<li>site by <a href="http://www.miyagimedia.co.uk">miyagimeda.co.uk</a></li>
</ul>

</div>
</div>

</div>
</div>
<!-- END FOOTER //-->

</body>
</html>