<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Title -->
<title>Choose your lease options - National Fleet Services</title>	

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/superfish-categories.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/superfish-pages.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style.php" media="all" />
<link rel="stylesheet" media="screen" href="css/getquote_styles.css" >

<!--[if lte IE 6]><style type="text/css">.divform label { margin-right: -3px; } .banner { margin-bottom:-30px;} .cornerfix-bottom, .cornerfix-top { background: none; } .homepage-top { margin-bottom: -8px;} .widget-top { margin-bottom: -10px; } div.controls a {background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control.gif") no-repeat center center;} div.controls a.activeSlide { background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control-selected.gif") no-repeat center center;} .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } .dropdown-pages ul {width: 15.6em;}</style><![endif]-->
<!--[if lte IE 7]><style type="text/css">.divform input { margin-top: -1px; } .showcaseteaser { margin-left: 14px; } .showcase-buttons { padding-left: 20px; } .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } </style><![endif]-->

<!-- Javascript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>

<script type="text/javascript" src="http://discovertrail.net/js/12469.js"></script>

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
document.getElementById("name").focus();
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
<img src="images/droptop.gif" style="display: none;" alt="preload" />
</div>

<div class="marginauto"><!-- ends in footer -->

<?php
include('menu.php');
?>



<div class="post-bottom">
<div class="post-top"></div>
<div class="post-wrap">


<div class="post single">
<span style="display: none;" class="meta">1 Comment | Oct 15, 2010</span>

<h1 class="entry-title">Choose your lease options:</h1>

<div class="entry-content">





<?php
include("dbinfo.inc.php");
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





<form class="contact_form" id="contact_form" action="enquire/987654321.php" method="post" name="contact_form">

	
    <ul class="user-bg">

        <li>
            <label for="name">Name:</label>
            <input id="name" name="name" type="text" required autofocus="autofocus" />
        </li>
		<li>
            <label for="company">Company:</label>
            <input id="company" name="company" type="text" name="company" />
        </li>
        <li>
            <label for="email">Email:</label>
            <input id="email" name="email" type="email" required />
            <!--<span class="form_hint">Proper format "name@something.com"</span>//-->
        </li>
        <li>
            <label for="telephone">Telephone:</label>
            <input id="telephone" name="telephone" type="telephone" required />
            <!--<span class="form_hint">Proper format "01234 654321"</span>//-->
        </li>
		
		<li>
		
		
<label for="county">County:</label>
<select id="county" name="county" required>
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
</li>
		
		
	</ul>
	

		
		<ul class="car-bg">

        <li>
            <label for="make">Make:</label>
            <input id="make" name="make" type="text" placeholder="E.g. Audi A3 Hatch" required value="<?php if(isset($make))
		{
		echo($make);
		} ?>"/>
        </li>
        <li>
            <label for="model">Model:</label>
            <input id="make" name="model" type="text" placeholder="E.g. 1.6TDi S-Line" required value="<?php if(isset($model))
		{
		echo($model);
		} ?>"/>
        </li>
		</ul>
		

		
		<ul class="contract-bg">

		<li>
			<label for="fitype">Lease Type:</label>
			<select id="fitype" name="fitype" required>
			<option value="">Select Lease Type</option>
			<option value="business" <?php if(isset($fi)) { echo ($fi == "business") ? "selected" : ""; } ?>> Business</option>
			<option value="personal" <?php if(isset($fi)) { echo ($fi == "personal") ? "selected" : ""; } ?>> Personal</option>
			</select>
		</li>
		
		<li>
			<label for="term">Contract Term:</label>
			<select id="term" name="term" required>
			<option value="24" <?php if(isset($term)) { echo ($term == "24") ? "selected" : ""; } ?>> 24 Months</option>
			<option value="36" <?php if(isset($term)) { echo ($term == "36") ? "selected" : ""; } ?>> 36 Months</option>
			<option value="48" <?php if(isset($term)) { echo ($term == "48") ? "selected" : ""; } ?>> 48 Months</option>
			<option value="60" <?php if(isset($term)) { echo ($term == "60") ? "selected" : ""; } ?>> 60 Months</option>
			<option value="Cheapest" > Whichever is cheapest</option>
			</select>
		</li>
		
		<li>
			<label for="mileage">Annual Mileage:</label>
			<select id="mileage" name="mileage" required>
			<option value="Less than 10,000"> Less than 10,000</option>
			<option value="10000" <?php if(isset($mileage)) { echo ($mileage == "10000") ? "selected" : ""; } ?>> 10,000 miles per annum</option>
			<option value="12500" <?php if(isset($mileage)) { echo ($mileage == "12500") ? "selected" : ""; } ?>> 12,000 miles per annum</option>
			<option value="15000" <?php if(isset($mileage)) { echo ($mileage == "15000") ? "selected" : ""; } ?>> 15,000 miles per annum</option>
			<option value="20000" <?php if(isset($mileage)) { echo ($mileage == "20000") ? "selected" : ""; } ?>> 20,000 miles per annum</option>
			<option value="25000" <?php if(isset($mileage)) { echo ($mileage == "25000") ? "selected" : ""; } ?>> 25,000 miles per annum</option>
			<option value="30000" <?php if(isset($mileage)) { echo ($mileage == "30000") ? "selected" : ""; } ?>> 30,000 miles per annum</option>
			<option value="More than 30,000"> More than 30,000</option>
			</select>
		</li>
		
		<li>
			<label for="maint">Monthly Maintenance:</label>
			<select id="maint" name="maint" required>
			<option value="no" <?php if(isset($maint)) { echo ($maint == "no") ? "selected" : ""; } ?>> No</option>
			<option value="yes" <?php if(isset($maint)) { echo ($maint == "yes") ? "selected" : ""; } ?>> Yes</option>
			<option value="withwithout"> Quote with and without</option>
			</select>
		</li>
		
        <li>
		

			<hr />
		</li>
		<li>
            <label for="message">Additional Info:</label>
            <textarea id="message" name="message" cols="40" rows="6"></textarea>
		</li>
        <li>
        	<button class="submit" type="submit">Find Out More</button>
        </li>
    </ul>

	
</form>














</div>

</div>

</div>
</div>

<div class="sidebar-wrap">


<div id="recent-posts-32" class="widget widget_recent_entries">
<span class="widget-top"><img class="img-title" src="images/what-next.png" /></span><h3 class="widgettitle">What Next?</h3>

<ul>
<li>
<a href="http://www.nationalfleetservices.net/contact-us.php" title="Request Callback">Request Callback</a>
</li>
<li>
<a href="http://www.nationalfleetservices.net/contact-us.php" title="Request a Quote">Request a Quote</a>
</li>
<li>
<a href="http://www.nationalfleetservices.net/contact-us.php" title="Arrange Appointment">Arrange Appointment</a>
</li>
</ul>

<span class="widget-bottom"></span>
</div>



<div id="recent-posts-32" class="widget widget_recent_entries">
<img src="images/why-choose-us.gif" />
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

<script type="text/javascript"> Cufon.now(); </script>

</div>

<br />

<?php
include('footer.php');
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="jquery.h5validate.js"></script>
 
<script>
$(document).ready(function () {
    $('#contact_form').h5Validate();
});
</script>

</body></html>