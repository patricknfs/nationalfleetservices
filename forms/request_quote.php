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
include ("menu.php"); 
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
echo "";
?>

</div>

</div>

<div id="mainright" class="offer-info">

<?php
include("../dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM offers WHERE id='{$_GET['id']}'";
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
$rate210=mysql_result($result,$i,"rate210");
$rate310=mysql_result($result,$i,"rate310");
$id=mysql_result($result,$i,"id");

?>

<ul id="breadcrumb">
<a title="" href="../index.php">Home</a> &gt; 
<a title="" href="../offers.php">Offers</a> &gt; 
<a title="" href="../offer-info.php?id=<?php echo "$id"; ?>"><?php echo "$make"; ?><?php echo "$model"; ?></a> &gt;
Request Quote
</ul>

<h1 class="biggy">Request a Quote</h1>
<p>Use this form to send a quote request to our quotations team. We try to turn all quotations around within the hour. For more complex enquiries call 0845 123 456.</p>

<div class="left">

<img src="../img/request-quote.png" />

</div>

<div class="left">

    <div class="iphorm-outer">
		<form class="iphorm" action="iphorm/process_request-quote.php" method="post" enctype="multipart/form-data">
            <div class="iphorm-wrapper">
    	        <div class="iphorm-inner">
    	           <!--<div class="iphorm-name_title">Please get in touch</div>//-->
	               <div class="iphorm-container clearfix">
				
						<div style="display: none;" class="element-wrapper offerid-element-wrapper clearfix">
                            <label for="offerid">Offer ID <span class="red">*</span></label>
                            <div class="input-wrapper offerid-input-wrapper">
                                <input class="offerid-element" value="<?php echo "$id"; ?>" id="offerid" type="text" name="offerid" />
                            </div>
                        </div>
				
                        <!-- Begin Vehicle element -->
                        <div style="display: none;" class="element-wrapper emailad-element-wrapper clearfix">
                            <label for="emailad">Email To <span class="red">*</span></label>
                            <div class="input-wrapper emailad-input-wrapper">
                                <input class="emailad-element" value="<?php echo $_SESSION['jigowatt']['email']; ?>" id="emailad" type="text" name="emailad" />
                            </div>
                        </div>
                        <!-- End Vehicle element -->

						
                        <!-- Begin Salesperson element -->
                        <div style="display: none;" class="element-wrapper salesperson-element-wrapper clearfix">
                            <label for="salesperson">Salesperson <span class="red">*</span></label>
                            <div class="input-wrapper salesperson-input-wrapper">
                                <input class="salesperson-element iphorm-tooltip" value="<?php echo $_SESSION['jigowatt']['username']; ?>" id="salesperson" type="text" name="salesperson" title="Your full name and company name" />
                            </div>
                        </div>
                        <!-- End Salesperson element -->
				   
                        <!-- Begin Vehicle element -->
                        <div class="element-wrapper vehiclemake-element-wrapper clearfix">
                            <label for="vehiclemake">Make <span class="red">*</span></label>
                            <div class="input-wrapper vehiclemake-input-wrapper">
                                <input class="vehiclemake-element" value="<?php echo "$make"; ?>" id="vehiclemake" type="text" name="vehiclemake" />
                            </div>
                        </div> 
                        <!-- End Vehicle element -->
						
                        <!-- Begin Vehicle element -->
                        <div class="element-wrapper vehiclemodel-element-wrapper clearfix">
                            <label for="vehiclemodel">Model <span class="red">*</span></label>
                            <div class="input-wrapper vehiclemodel-input-wrapper">
                                <input class="vehiclemodel-element" value="<?php echo "$model"; ?>" id="vehiclemodel" type="text" name="vehiclemodel" />
                            </div>
                        </div>
                        <!-- End Vehicle element -->
					
                        <!-- Begin Vehicle element -->
                        <div class="element-wrapper otr-element-wrapper clearfix">
                            <label for="otr">OTR </label>
                            <div class="input-wrapper otr-input-wrapper">
                                <input class="otr-element iphorm-tooltip" id="otr" type="text" name="otr" title="Please provide a vehicle OTR where applicable. Otherwise we will use the default OTR provided by the finance system." />
                            </div>
                        </div>
                        <!-- End Vehicle element -->
						
						<!-- Begin Finance Type select element -->
                        <div class="element-wrapper fitypeSelect-element-wrapper clearfix">
                            <label for="fitypeSelect">Finance Type <span class="red">*</span></label>
                            <div class="input-wrapper fitypeSelect-input-wrapper">
                                <select id="fitypeSelect" name="fitypeSelect">
                                    <option value="">Please Select</option>
                                    <option value="Business">Business Lease</option>
                                    <option value="Personal">Personal Lease</option>
                                    <option value="Finance">Finance Lease</option>
                                    <option value="PCP">PCP</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Finance Type select element -->
						
						<!-- Begin Contract Length select element -->
                        <div class="element-wrapper conlengthSelect-element-wrapper clearfix">
                            <label for="conlengthSelect">Term <span class="red">*</span></label>
                            <div class="input-wrapper conlengthSelect-input-wrapper">
                                <select id="conlengthSelect" name="conlengthSelect">
                                    <option value="">Please Select</option>
                                    <option value="Short">Short Lease</option>
                                    <option value="24 Months">24 Months</option>
                                    <option value="36 Months">36 Months</option>
                                    <option value="48 Months">48 Months</option>
                                    <option value="60 Months">60 Months</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Contract Length select element -->
						
						<div class="element-wrapper mileage-element-wrapper clearfix">
                            <label for="mileage">Mileage <span class="red">*</span></label>
                            <div class="input-wrapper mileage-input-wrapper">
                                <input class="mileage-element" id="mileage" type="text" name="mileage" />
                            </div>
                        </div>
						
						<!-- Begin Title select element -->
                        <div class="element-wrapper maintSelect-element-wrapper clearfix">
                            <label for="maintSelect">Maintenance <span class="red">*</span></label>
                            <div class="input-wrapper maintSelect-input-wrapper">
                                <select id="maintSelect" name="maintSelect">
                                    <option value="">Please select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Title select element -->
						
						<div class="element-wrapper dnotes-element-wrapper clearfix">
                            <label class="notes" for="dnotes">Additional Info </label>
                            <div class="input-wrapper dnotes-input-wrapper clearfix">
                                <textarea class="textypoop dnotes-element iphorm-tooltip" id="dnotes" name="dnotes" rows="6" cols="50" title="List any extras, commission ammounts or other quotation requirements here"></textarea>
                            </div>
                        </div>
						
                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="submit-element" type="submit" name="contact" value="Request Quote" />
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