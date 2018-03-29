<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Title -->
<title>Choose your lease options - National Fleet Services</title>	

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/superfish-categories.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/superfish-pages.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="../css/style.php" media="all" />


<link rel="stylesheet" type="text/css" href="iphorm/css/pagestyles.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="iphorm/css/block.css" /><!-- Standard form layout -->

<script type="text/javascript" src="iphorm/js/jquery-1.6.2.min.js"></script><!-- If your webpage already has the jQuery library you do not need this -->
<script type="text/javascript" src="iphorm/js/plugins.js"></script>
<script type="text/javascript" src="iphorm/js/scripts.js"></script>


<!--[if lte IE 6]><style type="text/css">.divform label { margin-right: -3px; } .banner { margin-bottom:-30px;} .cornerfix-bottom, .cornerfix-top { background: none; } .homepage-top { margin-bottom: -8px;} .widget-top { margin-bottom: -10px; } div.controls a {background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control.gif") no-repeat center center;} div.controls a.activeSlide { background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control-selected.gif") no-repeat center center;} .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } .dropdown-pages ul {width: 15.6em;}</style><![endif]-->
<!--[if lte IE 7]><style type="text/css">.divform input { margin-top: -1px; } .showcaseteaser { margin-left: 14px; } .showcase-buttons { padding-left: 20px; } .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } </style><![endif]-->

<!-- Javascript -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/superfish.js"></script>
<script type="text/javascript" src="../js/jquery.cycle.all.min.js"></script>

<link rel='index' title='National Fleet Services' href='http://www.nationalfleetservices.net/' />

<script type="text/javascript">
//<![CDATA[

jQuery(function(){
		jQuery('ul.dropdown-categories').superfish();
	});
jQuery(function(){
		jQuery('ul.dropdown-pages').superfish();
	});

Cufon.replace('.logotext, h2, h3, h4, h5, h6,.comment-author');

//]]>
</script>

<script type="text/javascript">
function setFocus(){
document.getElementById("custname").focus();
}
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36502282-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body class="homebody" onload="setFocus();">

<div style="width: 0; height: 0;">
<img src="../images/droptop.gif" style="display: none;" alt="preload" />
</div>

<div class="marginauto"><!-- ends in footer -->

<?php
include('../menu.php');
?>



<div class="post-bottom">
<div class="post-top"></div>
<div class="post-wrap">


<div class="post single">
<span style="display: none;" class="meta">1 Comment | Oct 15, 2010</span>

<h1 class="entry-title">Choose your lease options:</h1>

<div class="entry-content">





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
$product=mysql_result($result,$i,"product");
$term=mysql_result($result,$i,"term");
$mileage=mysql_result($result,$i,"mileage");
$maint=mysql_result($result,$i,"maint"); 
$stock=mysql_result($result,$i,"stock"); 
$pch=mysql_result($result,$i,"pch"); 
$rental=mysql_result($result,$i,"rental"); 
$comms=mysql_result($result,$i,"comms"); 
$co2=mysql_result($result,$i,"co2"); 
$mpg=mysql_result($result,$i,"mpg"); 
$expire=mysql_result($result,$i,"expire"); 
$source=mysql_result($result,$i,"source");
$corp=mysql_result($result,$i,"corp");
$id=mysql_result($result,$i,"id");


if ($product == "CH") {
	$fi = "business";
} else {
	$fi = "personal";
}

if ($maint == "1") {
	$maint = "yes";
} else {
	$maint = "no";
}

?>



<?php
++$i;
}
?>


<div class="outside">

    <!-- To copy the form HTML, start here -->
    <div class="iphorm-outer">

		<form class="iphorm" action="iphorm/quote-process.php" method="post" enctype="multipart/form-data">
            <div class="iphorm-wrapper">

    	        <div class="iphorm-inner">

    	           <!--<div class="iphorm-name_title">Please get in touch</div>//-->
	               <div class="iphorm-container clearfix">

				<h3><span class="red">1. </span>Your Details</h3>
				   
                <!-- Begin Name element -->
                <div class="element-wrapper custname-element-wrapper clearfix">
                    <label for="custname">Name <span class="red">*</span></label>
                        <div class="input-wrapper custname-input-wrapper">
                            <input class="custname-element" id="custname" type="text" name="custname" required />
                        </div>
                </div>
                <!-- End Name element -->
				
                <!-- Begin Company element -->
                <div class="element-wrapper company-element-wrapper clearfix">
                    <label for="company">Company </label>
                        <div class="input-wrapper company-input-wrapper">
                            <input class="company-element iphorm-tooltip" id="company" type="text" name="company" title="If Applicable" />
                        </div>
                </div>
                <!-- End Company element -->
				
                <!-- Begin Email element -->
                <div class="element-wrapper email-element-wrapper clearfix">
                    <label for="email">Email <span class="red">*</span></label>
                        <div class="input-wrapper email-input-wrapper">
                            <input class="email-element" id="email" type="text" name="email" required />
                        </div>
                </div>
                <!-- End Email element -->
				
                <!-- Begin Telephone element -->
                <div class="element-wrapper telephone-element-wrapper clearfix">
                    <label for="telephone">Telephone <span class="red">*</span></label>
                        <div class="input-wrapper telephone-input-wrapper">
                            <input class="telephone-element" id="telephone" type="text" name="telephone" required />
                        </div>
                </div>
                <!-- End Telephone element -->
						
                <!-- Begin County select element -->
                <div class="element-wrapper countySelect-element-wrapper clearfix">
                    <label for="countySelect">Your Area <span class="red">*</span></label>
						<div class="input-wrapper countySelect-input-wrapper clearfix">
							<select id="countySelect" name="countySelect" required>

        <option value="">Please Select Your Postal Area</option>
    <optgroup label="Postcode">
<option value="AL">AL</option>
<option value="B">B</option>
<option value="BA">BA</option>
<option value="BB">BB</option>
<option value="BD">BD</option>
<option value="BH">BH</option>
<option value="BL">BL</option>
<option value="BN">BN</option>
<option value="BS">BS</option>
<option value="CA">CA</option>
<option value="CF">CF</option>
<option value="CH">CH</option>
<option value="CM">CM</option>
<option value="CB">CB</option>
<option value="CO">CO</option>
<option value="CT">CT</option>
<option value="CV">CV</option>
<option value="CW">CW</option>
<option value="DE">DE</option>
<option value="DH">DH</option>
<option value="DL">DL</option>
<option value="DN">DN</option>
<option value="DT">DT</option>
<option value="DY">DY</option>
<option value="EX">EX</option>
<option value="GB">GB</option>
<option value="GL">GL</option>
<option value="Greater London">Greater London</option>
<option value="GU">GU</option>
<option value="HD">HD</option>
<option value="HG">HG</option>
<option value="HP">HP</option>
<option value="HR">HR</option>
<option value="HU">HU</option>
<option value="HX">HX</option>
<option value="IP">IP</option>
<option value="L">L</option>
<option value="LA">LA</option>
<option value="LD">LD</option>
<option value="LE">LE</option>
<option value="LL">LL</option>
<option value="LN">LN</option>
<option value="LS">LS</option>
<option value="LU">LU</option>
<option value="M">M</option>
<option value="ME">ME</option>
<option value="MK">MK</option>
<option value="Northern Ireland">Northern Ireland</option>
<option value="NE">NE</option>
<option value="NG">NG</option>
<option value="NN">NN</option>
<option value="NP">NP</option>
<option value="NR">NR</option>
<option value="OL">OL</option>
<option value="Other">Other</option>
<option value="OX">OX</option>
<option value="PE">PE</option>
<option value="PL">PL</option>
<option value="PO">PO</option>
<option value="PR">PR</option>
<option value="RG">RG</option>
<option value="RH">RH</option>
<option value="S">S</option>
<option value="SA">SA</option>
<option value="Scotland">Scotland</option>
<option value="SG">SG</option>
<option value="SK">SK</option>
<option value="SL">SL</option>
<option value="SN">SN</option>
<option value="SO">SO</option>
<option value="SP">SP</option>
<option value="SS">SS</option>
<option value="ST">ST</option>
<option value="SY">SY</option>
<option value="TA">TA</option>
<option value="TF">TF</option>
<option value="TN">TN</option>
<option value="TQ">TQ</option>
<option value="TR">TR</option>
<option value="TS">TS</option>
<option value="WA">WA</option>
<option value="WF">WF</option>
<option value="WN">WN</option>
<option value="WR">WR</option>
<option value="WS">WS</option>
<option value="WV">WV</option>
<option value="YO">YO</option>
    </optgroup>


		</select>
		</div>
    </div>
                <!-- End County select element -->
						
						
						
<hr />
<h3><span class="red">2. </span>Vehicle Details</h3>

                <!-- Begin Make element -->
                <div class="element-wrapper make-element-wrapper clearfix">
                    <label for="make">Make <span class="red">*</span></label>
                        <div class="input-wrapper make-input-wrapper">
                            <input class="make-element" id="make" type="text" name="make"
							value="<?php if(isset($make))
							{
							echo($make);
							} ?>" required />
                        </div>
                </div>
                <!-- End Make element -->
				
                <!-- Begin Model element -->
                <div class="element-wrapper model-element-wrapper clearfix">
                    <label for="model">Model <span class="red">*</span></label>
                        <div class="input-wrapper model-input-wrapper">
                            <input class="model-element" id="model" type="text" name="model" 
							value="<?php if(isset($model))
							{
							echo($model);
							} ?>" required />
                        </div>
                </div>
                <!-- End Model element -->

<hr />
<h3><span class="red">3. </span>Lease Details</h3>

                <!-- Begin Lease select element -->
                <div class="element-wrapper leaseSelect-element-wrapper clearfix">
                    <label for="leaseSelect">Lease Type <span class="red">*</span></label>
						<div class="input-wrapper leaseSelect-input-wrapper clearfix">
							<select id="leaseSelect" name="leaseSelect" required>
								<option value="">Select Lease Type</option>
								<option value="pch" <?php if(isset($fi)) { echo ($fi == "pch") ? "selected" : ""; } ?>> Personal Lease</option>
								<option value="personal" <?php if(isset($fi)) { echo ($fi == "personal") ? "selected" : ""; } ?>> Company Car Opt-Out</option>
								<option value="soletrader" <?php if(isset($fi)) { echo ($fi == "soletrader") ? "selected" : ""; } ?>> Sole Trader</option>
								<option value="ltdplc" <?php if(isset($fi)) { echo ($fi == "ltdplc") ? "selected" : ""; } ?>> LTD / PLC</option>
								<option value="partnership" <?php if(isset($fi)) { echo ($fi == "partnership") ? "selected" : ""; } ?>> Partnership</option>

							</select>
						</div>
                </div>
                <!-- End Lease select element -->
				
				<!-- Begin Contract select element -->
                <div class="element-wrapper contractSelect-element-wrapper clearfix">
                    <label for="contractSelect">Contract Length <span class="red">*</span></label>
						<div class="input-wrapper contractSelect-input-wrapper clearfix">
							<select id="contractSelect" name="contractSelect" required>
								<option value="24" <?php if(isset($term)) { echo ($term == "24") ? "selected" : ""; } ?>> 24 Months</option>
								<option value="36" <?php if(isset($term)) { echo ($term == "36") ? "selected" : ""; } ?>> 36 Months</option>
								<option value="48" <?php if(isset($term)) { echo ($term == "48") ? "selected" : ""; } ?>> 48 Months</option>
								<option value="60" <?php if(isset($term)) { echo ($term == "60") ? "selected" : ""; } ?>> 60 Months</option>
								<option value="Cheapest" > Whichever is cheapest</option>
							</select>
						</div>
                </div>
                <!-- End Contract select element -->
				
				<!-- Begin Mileage select element -->
                <div class="element-wrapper mileageSelect-element-wrapper clearfix">
                    <label for="mileageSelect">Annual Mileage <span class="red">*</span></label>
						<div class="input-wrapper mileageSelect-input-wrapper clearfix">
							<select id="mileageSelect" name="mileageSelect" required>
								<option value="Less than 10,000"> Less than 10,000</option>
								<option value="10000" <?php if(isset($mileage)) { echo ($mileage == "10000") ? "selected" : ""; } ?>> 10,000 miles per year</option>
								<option value="12500" <?php if(isset($mileage)) { echo ($mileage == "12500") ? "selected" : ""; } ?>> 12,000 miles per year</option>
								<option value="15000" <?php if(isset($mileage)) { echo ($mileage == "15000") ? "selected" : ""; } ?>> 15,000 miles per year</option>
								<option value="20000" <?php if(isset($mileage)) { echo ($mileage == "20000") ? "selected" : ""; } ?>> 20,000 miles per year</option>
								<option value="25000" <?php if(isset($mileage)) { echo ($mileage == "25000") ? "selected" : ""; } ?>> 25,000 miles per year</option>
								<option value="30000" <?php if(isset($mileage)) { echo ($mileage == "30000") ? "selected" : ""; } ?>> 30,000 miles per year</option>
								<option value="More than 30,000"> More than 30,000</option>
							</select>
						</div>
                </div>
                <!-- End Mileage select element -->
				
				<!-- Begin Maintenance select element -->
                <div class="element-wrapper maintSelect-element-wrapper clearfix">
                    <label for="maintSelect">Monthly Maintenance <span class="red">*</span></label>
						<div class="input-wrapper maintSelect-input-wrapper clearfix">
							<select id="maintSelect" name="maintSelect" required>
								<option value="no" <?php if(isset($maint)) { echo ($maint == "no") ? "selected" : ""; } ?>> No</option>
								<option value="yes" <?php if(isset($maint)) { echo ($maint == "yes") ? "selected" : ""; } ?>> Yes</option>
								<option value="withwithout"> Quote with and without</option>
							</select>
						</div>
                </div>
                <!-- End Maintenance select element -->

						
				<hr />
						
				<h3><span class="red">4. </span>Additional Information</h3>
				
				        <!-- Begin Textarea element -->
                        <div class="element-wrapper dnotes-element-wrapper clearfix">
                            <div class="input-wrapper dnotes-input-wrapper clearfix">
                                <textarea class="textypoop dnotes-element" id="dnotes" name="dnotes" rows="5" cols="48"></textarea>
                            </div>

						<div class="input-wrapper corp-input-wrapper" style="display:none">
                            <input class="corp-element" id="corp" type="text" name="corp" value="Corporate"  />
                        </div>
							
                        </div>
                        <!-- End Textarea element -->

                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="submit-element" type="submit" name="contact" value="Submit Enquiry" />
                            </div>
                        </div>
                        <!-- End Submit button -->
	               </div><!-- /.iphorm-container -->
	           </div><!-- /.iphorm-inner -->
		   </div><!-- /.iphorm-wrapper -->
		</form>
	</div><!-- /.iphorm-outer -->
	
</div>

</div>

</div>

</div>
</div>

<div class="sidebar-wrap">



<div id="recent-posts-32" class="widget widget_recent_entries">
<img src="../images/why-choose-us.gif" />
</div>



</div>



</div><!-- /marginauto -->

<div class="footer">


<div class="left">

<li class="page_item page-item-21"><a href="http://www.nationalfleetservices.net/terms-conditions.php" title="Links">Terms &amp; Conditions</a></li>
<li class="page_item page-item-25"><b>Phone: </b>0121 45 45 645</li>
<li class="page_item page-item-23"><b>Email: </b><a href="mailto:info@nationalfleetservices.net">info@nationalfleetservices.net</a></li>
</div>

<div class="right"></div>

<div></div>

</div>

<br />

<?php
include('../footer.php');
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="jquery.h5validate.js"></script>
 
<script>
$(document).ready(function () {
    $('#contact_form').h5Validate();
});
</script>

</body></html>