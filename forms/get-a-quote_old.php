<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Choose your lease options - Fleet Street</title>	

<link rel="shortcut icon" href="../img/favicon.ico" />

<link rel="stylesheet" type="text/css" href="iphorm/css/pagestyles.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="iphorm/css/block.css" /><!-- Standard form layout -->

<script type="text/javascript" src="iphorm/js/jquery-1.6.2.min.js"></script><!-- If your webpage already has the jQuery library you do not need this -->
<script type="text/javascript" src="iphorm/js/plugins.js"></script>
<script type="text/javascript" src="iphorm/js/scripts.js"></script>

<style type="text/css">
    .box{
	background: #BCE5F7;
	border: 1px solid #1F4C69;
	padding: 0px 10px 10px 18px;
	margin-bottom: 15px;
	display: none;
    }
    .Arval{}
    .Lex{}
    .Network{}
</style>

</head>
<body>









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

		<form class="iphorm" action="iphorm/pch-process.php" method="post" enctype="multipart/form-data">
            <div class="iphorm-wrapper">

    	        <div class="iphorm-inner">

    	           <!--<div class="iphorm-name_title">Please get in touch</div>//-->
	               <div class="iphorm-container clearfix">

				<h3><span class="red">1. </span>Your Details</h3>
				   
                <!-- Begin Name element -->
                <div class="element-wrapper name-element-wrapper clearfix">
                    <label for="name">Name <span class="red">*</span></label>
                        <div class="input-wrapper name-input-wrapper">
                            <input class="name-element iphorm-tooltip" id="name" type="text" name="name" title="Your full name and company name" />
                        </div>
                </div>
                <!-- End Name element -->
				
                <!-- Begin Company element -->
                <div class="element-wrapper company-element-wrapper clearfix">
                    <label for="company">Company <span class="red">*</span></label>
                        <div class="input-wrapper company-input-wrapper">
                            <input class="company-element iphorm-tooltip" id="company" type="text" name="company" title="Your full name and company name" />
                        </div>
                </div>
                <!-- End Company element -->
				
                <!-- Begin Email element -->
                <div class="element-wrapper email-element-wrapper clearfix">
                    <label for="email">Email <span class="red">*</span></label>
                        <div class="input-wrapper email-input-wrapper">
                            <input class="email-element iphorm-tooltip" id="email" type="text" name="email" title="Your full name and company name" />
                        </div>
                </div>
                <!-- End Email element -->
				
                <!-- Begin Telephone element -->
                <div class="element-wrapper telephone-element-wrapper clearfix">
                    <label for="telephone">Telephone <span class="red">*</span></label>
                        <div class="input-wrapper telephone-input-wrapper">
                            <input class="telephone-element iphorm-tooltip" id="telephone" type="text" name="telephone" title="Your full name and company name" />
                        </div>
                </div>
                <!-- End Telephone element -->
						
                <!-- Begin County select element -->
                <div class="element-wrapper countySelect-element-wrapper clearfix">
                    <label for="countySelect">County <span class="red">*</span></label>
						<div class="input-wrapper countySelect-input-wrapper clearfix">
							<select class="iphorm-tooltip" id="countySelect" name="countySelect" title="Your full name and company name">

        <option value="">Please Select Your County</option>
    <optgroup label="England">
        <option value="Bedfordshire">Bedfordshire</option>
        <option value="Berkshire">Berkshire</option>
        <option value="Bristol">Bristol</option>
        <option value="Buckinghamshire">Buckinghamshire</option>
        <option value="Cambridgeshire">Cambridgeshire</option>
        <option value="Cheshire">Cheshire</option>
        <option value="City of London">City of London</option>
        <option value="Cornwall">Cornwall</option>
        <option value="Cumbria">Cumbria</option>
        <option value="Derbyshire">Derbyshire</option>
        <option value="Devon">Devon</option>
        <option value="Dorset">Dorset</option>
        <option value="Durham">Durham</option>
        <option value="East Riding of Yorkshir">East Riding of Yorkshire</option>
        <option value="East Sussex">East Sussex</option>
        <option value="Essex">Essex</option>
        <option value="Gloucestershire">Gloucestershire</option>
        <option value="Greater London">Greater London</option>
        <option value="Greater Manchester">Greater Manchester</option>
        <option value="Hampshire">Hampshire</option>
        <option value="Herefordshire">Herefordshire</option>
        <option value="Hertfordshire">Hertfordshire</option>
        <option value="Isle of Wight">Isle of Wight</option>
        <option value="Kent">Kent</option>
        <option value="Lancashire">Lancashire</option>
        <option value="Leicestershire">Leicestershire</option>
        <option value="Lincolnshire">Lincolnshire</option>
        <option value="Merseyside">Merseyside</option>
        <option value="Norfolk">Norfolk</option>
        <option value="North Yorkshire">North Yorkshire</option>
        <option value="Northamptonshire">Northamptonshire</option>
        <option value="Northumberland">Northumberland</option>
        <option value="Nottinghamshire">Nottinghamshire</option>
        <option value="Oxfordshire">Oxfordshire</option>
        <option value="Rutland">Rutland</option>
        <option value="Shropshire">Shropshire</option>
        <option value="Somerset">Somerset</option>
        <option value="South Yorkshire">South Yorkshire</option>
        <option value="Staffordshire">Staffordshire</option>
        <option value="Suffolk">Suffolk</option>
        <option value="Surrey">Surrey</option>
        <option value="Tyne and Wear">Tyne and Wear</option>
        <option value="Warwickshire">Warwickshire</option>
        <option value="West Midlands">West Midlands</option>
        <option value="West Sussex">West Sussex</option>
        <option value="West Yorkshire">West Yorkshire</option>
        <option value="Wiltshire">Wiltshire</option>
        <option value="Worcestershire">Worcestershire</option>
    </optgroup>
    <optgroup label="Wales">
        <option value="Anglesey">Anglesey</option>
        <option value="Brecknockshire">Brecknockshire</option>
        <option value="Caernarfonshire">Caernarfonshire</option>
        <option value="Carmarthenshire">Carmarthenshire</option>
        <option value="Cardiganshire">Cardiganshire</option>
        <option value="Denbighshire">Denbighshire</option>
        <option value="Flintshire">Flintshire</option>
        <option value="Glamorgan">Glamorgan</option>
        <option value="Merioneth">Merioneth</option>
        <option value="Monmouthshire">Monmouthshire</option>
        <option value="Montgomeryshire">Montgomeryshire</option>
        <option value="Pembrokeshire">Pembrokeshire</option>
        <option value="Radnorshire">Radnorshire</option>
    </optgroup>
    <optgroup label="Scotland">
        <option value="Aberdeenshire">Aberdeenshire</option>
        <option value="Angus">Angus</option>
        <option value="Argyllshire">Argyllshire</option>
        <option value="Ayrshire">Ayrshire</option>
        <option value="Banffshire">Banffshire</option> 
        <option value="Berwickshire">Berwickshire</option>
        <option value="Buteshire">Buteshire</option>
        <option value="Cromartyshire">Cromartyshire</option>
        <option value="Caithness">Caithness</option>
        <option value="Clackmannanshire">Clackmannanshire</option>
        <option value="Dumfriesshire">Dumfriesshire</option>
        <option value="Dunbartonshire">Dunbartonshire</option>
        <option value="East Lothian">East Lothian</option>
        <option value="Fife">Fife</option>
        <option value="Inverness-shire">Inverness-shire</option>
        <option value="Kincardineshire">Kincardineshire</option>
        <option value="Kinross">Kinross</option>
        <option value="Kirkcudbrightshire">Kirkcudbrightshire</option>
        <option value="Lanarkshire">Lanarkshire</option>
        <option value="Midlothian">Midlothian</option>
        <option value="Morayshire">Morayshire</option>
        <option value="Nairnshire">Nairnshire</option>
        <option value="Orkney">Orkney</option>
        <option value="Peeblesshire">Peeblesshire</option>
        <option value="Perthshire">Perthshire</option>
        <option value="Renfrewshire">Renfrewshire</option>
        <option value="Ross-shire">Ross-shire</option>
        <option value="Roxburghshire">Roxburghshire</option>
        <option value="Selkirkshire">Selkirkshire</option>
        <option value="Shetland">Shetland</option>
        <option value="Stirlingshire">Stirlingshire</option>
        <option value="Sutherland">Sutherland</option>
        <option value="West Lothian">West Lothian</option>
        <option value="Wigtownshire">Wigtownshire</option>
    </optgroup>
    <optgroup label="Northern Ireland">
        <option value="Antrim">Antrim</option>
        <option value="Armagh">Armagh</option>
        <option value="Down">Down</option>
        <option value="Fermanagh">Fermanagh</option>
        <option value="Londonderry">Londonderry</option>
        <option value="Tyrone">Tyrone</option>
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
                            <input class="make-element iphorm-tooltip" id="make" type="text" name="make" title="Your full name and company name" 
							value="<?php if(isset($make))
							{
							echo($make);
							} ?>" />
                        </div>
                </div>
                <!-- End Make element -->
				
                <!-- Begin Model element -->
                <div class="element-wrapper model-element-wrapper clearfix">
                    <label for="model">Model <span class="red">*</span></label>
                        <div class="input-wrapper model-input-wrapper">
                            <input class="model-element iphorm-tooltip" id="model" type="text" name="model" title="Your full name and company name"
							value="<?php if(isset($model))
							{
							echo($model);
							} ?>" />
                        </div>
                </div>
                <!-- End Model element -->

<hr />
<h3><span class="red">3. </span>Lease Details</h3>

                <!-- Begin Lease select element -->
                <div class="element-wrapper leaseSelect-element-wrapper clearfix">
                    <label for="leaseSelect">Lease Type <span class="red">*</span></label>
						<div class="input-wrapper leaseSelect-input-wrapper clearfix">
							<select id="leaseSelect" name="leaseSelect">
								<option value="">Select Lease Type</option>
								<option value="business" <?php if(isset($fi)) { echo ($fi == "business") ? "selected" : ""; } ?>> Business</option>
								<option value="personal" <?php if(isset($fi)) { echo ($fi == "personal") ? "selected" : ""; } ?>> Personal</option>
							</select>
						</div>
                </div>
                <!-- End Lease select element -->
				
				<!-- Begin Contract select element -->
                <div class="element-wrapper contractSelect-element-wrapper clearfix">
                    <label for="contractSelect">Contract Length <span class="red">*</span></label>
						<div class="input-wrapper contractSelect-input-wrapper clearfix">
							<select id="contractSelect" name="contractSelect">
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
							<select id="mileageSelect" name="mileageSelect">
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
							<select id="maintSelect" name="maintSelect">
								<option value="no" <?php if(isset($maint)) { echo ($maint == "no") ? "selected" : ""; } ?>> No</option>
								<option value="yes" <?php if(isset($maint)) { echo ($maint == "yes") ? "selected" : ""; } ?>> Yes</option>
								<option value="withwithout"> Quote with and without</option>
							</select>
						</div>
                </div>
                <!-- End Maintenance select element -->

						
				<hr />
						
				<h3><span class="red">4. </span>Notes</h3>
				
				        <!-- Begin Textarea element -->
                        <div class="element-wrapper dnotes-element-wrapper clearfix">
                            <div class="input-wrapper dnotes-input-wrapper clearfix">
                                <textarea class="textypoop dnotes-element" id="dnotes" name="dnotes" rows="5" cols="48"></textarea>
                            </div>
                        </div>
                        <!-- End Textarea element -->

				<hr />
						
				<h3><span class="red">9. </span>Data Protection</h3>
				
				<p class="tnc">This notice applies to all applicants and (if the application is
made by a limited company or partnership / unincorporated
association) directors and partners.
Discolsure: I have told the prospective customer / guarantor
that a credit agency search will be made against them and
recorded by the agency. I have also told the customer /
guarantor how we intended to use the information provided
above.</p><br />

				
                        <!-- Declaration Checkbox element -->
                        <div class="element-wrapper declaration_checkbox-element-wrapper clearfix">
                            <div class="input-wrapper declaration_checkbox-input-wrapper clearfix">
                                <input id="declaration_checkbox" name="declaration_checkbox" value="1" type="checkbox" class="iphorm-tooltip" title="I have fully read, understood and accept all the terms above." /> <label for="declaration_checkbox">I Accept <span class="red">*</span></label>
                            </div>
                        </div>
                        <!-- End Declaration Checkbox element -->

                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="submit-element" type="submit" name="contact" value="Send" />
                            </div>
                        </div>
                        <!-- End Submit button -->
	               </div><!-- /.iphorm-container -->
	           </div><!-- /.iphorm-inner -->
		   </div><!-- /.iphorm-wrapper -->
		</form>
	</div><!-- /.iphorm-outer -->
	
	<!-- To copy the form HTML, end here -->
</div>

</body>
</html>