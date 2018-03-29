<?php include_once('../classes/check.class.php'); ?>

<?php protect("1, 2, 3"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, height=device-height "/>

<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="iphorm/css/pagestyles_offer.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="iphorm/css/block_offer.css" /><!-- Standard form layout -->

<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery.cycle.all.latest.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/simple-slider.js"></script>

<script src="../js/jquery-tabs.js" type="text/javascript"></script>

<title>The DealDen.co.uk</title>


<style>

body {
	font-family: Arial, helvetica, sans-serif;
}

h3.quote {
	font-size: 20px;
	font-weight: bold;
	line-height: 10px;
	margin: 0px;
	padding: 0px 0px 10px 0px;
}

h3.quotered {
	font-size: 20px;
	line-height: 20px;
	margin: 0px;
	padding: 0px 0px 10px 0px;
	color: #DF2121;
}

h2.cta {

}

.cta {
	font-size: 14px;
	font-weight: bold;
	color: #DF2121;
}

input, select, option, textarea {
	width: 235px;
	padding: 4px;
}

input.btn {
	width: 100px;
}

.quotesmall {
	font-size: 11px;
	line-height: 16px;
}

#quotetable td {
	padding: 5px 0 5px 0;
}

#resulttable td {
	padding: 6px 0px 0px 0px;
}

#resulttable td.quotesmall {
	padding: 0px;
}

.tdlabel {
	width: 230px;
	font-size: 14px;
	font-weight: bold;
}

label {
	display: block;
	float: left;
	width: 200px;
}

td.source {
	font-size: 14px;
	color: #DF2121;
	line-height: 28px;
}


#quotetable {
	border-right: 1px solid #ccc;
	padding: 0px 30px 0px 20px;
	float: left;
	width: 515px;
}

#resulttable {
	padding: 0px 20px 0px 20px;
	width: 360px;
	float: left;
}

#jackedPrice {
	font-size: 26px;
	font-weight: bold;
	line-height: 32px;
	color: #DF2121;
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 150px;
}

#jackedPrice img {
	vertical-align: -9%;
}

  [class^=slider] { display: inline-block; margin-bottom: 0px; }
  .output { font-size: 14px; margin-top: 1px; margin-left: 5px; vertical-align: top;}

 #success {
    background:#EBF4FB none repeat scroll 0 0;
	border:2px solid #B7DDF2;
	width: 500px;
	margin-top:10px;
    -moz-border-radius:5px;
-webkit-border-radius:5px;
}

.hidden_input {
	width: 100px;
	/*display: none;*/
}
  
.email_btn {
	width: 50px;
}
  
</style>



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
<img src="img/logo.png">
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

<?php
include("../dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM offers WHERE id='{$_GET['id']}'";
$result=mysql_query($query);
$num=mysql_numrows($result); 

$i=0;
while ($i < $num) {
$rental=mysql_result($result,$i,"rental"); 
$id=mysql_result($result,$i,"id");

++$i;
}
?>



<div id="mainright" class="offer-info">




















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
$otr=mysql_result($result,$i,"otr");
$product=mysql_result($result,$i,"product");
$initial=mysql_result($result,$i,"initial");
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
$notes=mysql_result($result,$i,"notes");

$rate210n=mysql_result($result,$i,"rate210n");
$rate212n=mysql_result($result,$i,"rate212n");
$rate215n=mysql_result($result,$i,"rate215n");
$rate220n=mysql_result($result,$i,"rate220n");
$rate225n=mysql_result($result,$i,"rate225n");
$rate230n=mysql_result($result,$i,"rate230n");

$rate210y=mysql_result($result,$i,"rate210y");
$rate212y=mysql_result($result,$i,"rate212y");
$rate215y=mysql_result($result,$i,"rate215y");
$rate220y=mysql_result($result,$i,"rate220y");
$rate225y=mysql_result($result,$i,"rate225y");
$rate230y=mysql_result($result,$i,"rate230y");

$rate310n=mysql_result($result,$i,"rate310n");
$rate312n=mysql_result($result,$i,"rate312n");
$rate315n=mysql_result($result,$i,"rate315n");
$rate320n=mysql_result($result,$i,"rate320n");
$rate325n=mysql_result($result,$i,"rate325n");
$rate330n=mysql_result($result,$i,"rate330n");

$rate310y=mysql_result($result,$i,"rate310y");
$rate312y=mysql_result($result,$i,"rate312y");
$rate315y=mysql_result($result,$i,"rate315y");
$rate320y=mysql_result($result,$i,"rate320y");
$rate325y=mysql_result($result,$i,"rate325y");
$rate330y=mysql_result($result,$i,"rate330y");

$rate410n=mysql_result($result,$i,"rate410n");
$rate412n=mysql_result($result,$i,"rate412n");
$rate415n=mysql_result($result,$i,"rate415n");
$rate420n=mysql_result($result,$i,"rate420n");
$rate425n=mysql_result($result,$i,"rate425n");
$rate430n=mysql_result($result,$i,"rate430n");

$rate410y=mysql_result($result,$i,"rate410y");
$rate412y=mysql_result($result,$i,"rate412y");
$rate415y=mysql_result($result,$i,"rate415y");
$rate420y=mysql_result($result,$i,"rate420y");
$rate425y=mysql_result($result,$i,"rate425y");
$rate430y=mysql_result($result,$i,"rate430y");

$id=mysql_result($result,$i,"id");
?>

<?
++$i;
}

$maxComms = round(($otr / 10), 0);

?>

<script type="text/javascript">

// Product
var product_price= new Array();
product_price["business"]="b";
product_price["personal"]="p";

function getProductPrice()
{
	var qProductPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedProduct = theForm.elements["product"];
	
	qProductPrice = product_price[selectedProduct.value];
	return qProductPrice;
}


// Term
var term_price= new Array();
term_price["24"]="2";
term_price["36"]="3";
term_price["48"]="4";

function getTermPrice()
{
	var qTermPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedTerm = theForm.elements["term"];
	
	qTermPrice = term_price[selectedTerm.value];
	return qTermPrice;
}


// Kpa
var kpa_price= new Array();
kpa_price["10"]="10";
kpa_price["12"]="12";
kpa_price["15"]="15";
kpa_price["20"]="20";
kpa_price["25"]="25";
kpa_price["30"]="30";

function getKpaPrice()
{
	var qKpaPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedKpa = theForm.elements["kpa"];
	
	qKpaPrice = kpa_price[selectedKpa.value];
	return qKpaPrice;
}


// Initial
var initial_price= new Array();
initial_price["3"]="3";
initial_price["6"]="6";
initial_price["9"]="9";

function getInitialPrice()
{
	var qInitialPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedInitial = theForm.elements["initial"];
	
	qInitialPrice = initial_price[selectedInitial.value];
	return qInitialPrice;
}


// Maint
var maint_price= new Array();
maint_price["yes"]="1";
maint_price["no"]="0";

function getMaintPrice()
{
	var qMaintPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedMaint = theForm.elements["maint"];
     
	qMaintPrice = maint_price[selectedMaint.value];
	return qMaintPrice;
}

// SCode
var scode_price= new Array();

<?php
foreach (range(0, $maxComms, 50) as $comz) {
?>
scode_price["<?php echo "$comz"; ?>"]="<?php echo "$comz"; ?>";
<?php } ?>


function getScodePrice()
{
	var qScodePrice=0;
	var theForm = document.forms["cakeform"];
	var selectedScode = theForm.elements["scode"];
	
	qScodePrice = scode_price[selectedScode.value];
	return qScodePrice;
}



function calculateTotal()
{
    var cakePrice = getProductPrice() + getTermPrice() + getKpaPrice() + getMaintPrice(); // Create variable ID for rate "cakePrice"
	
	var initialPoop = parseInt(getInitialPrice()); // Convert initialPrice into number
	var termPoop = parseInt(getTermPrice()); // Convert termPrice into number
    
    var divobj = document.getElementById('totalPrice');
    divobj.style.display='block';
    divobj.innerHTML = cakePrice; // Display variable ID
	
matrix = {
  'b2100': <?php echo "$rate210n"; ?>,
  'b2120': <?php echo "$rate212n"; ?>,
  'b2150': <?php echo "$rate215n"; ?>,
  'b2200': <?php echo "$rate220n"; ?>,
  'b2250': <?php echo "$rate225n"; ?>,
  'b2300': <?php echo "$rate230n"; ?>,
  
  'b2101': <?php echo "$rate210y"; ?>,
  'b2121': <?php echo "$rate212y"; ?>,
  'b2151': <?php echo "$rate215y"; ?>,
  'b2201': <?php echo "$rate220y"; ?>,
  'b2251': <?php echo "$rate225y"; ?>,
  'b2301': <?php echo "$rate230y"; ?>,

  'p2100': <?php echo "$rate210n" * 1.2; ?>,
  'p2120': <?php echo "$rate212n" * 1.2; ?>,
  'p2150': <?php echo "$rate215n" * 1.2; ?>,
  'p2200': <?php echo "$rate220n" * 1.2; ?>,
  'p2250': <?php echo "$rate225n" * 1.2; ?>,
  'p2300': <?php echo "$rate230n" * 1.2; ?>,
  
  'p2101': <?php echo "$rate210y" * 1.2; ?>,
  'p2121': <?php echo "$rate212y" * 1.2; ?>,
  'p2151': <?php echo "$rate215y" * 1.2; ?>,
  'p2201': <?php echo "$rate220y" * 1.2; ?>,
  'p2251': <?php echo "$rate225y" * 1.2; ?>,
  'p2301': <?php echo "$rate230y" * 1.2; ?>,
  
  'b3100': <?php echo "$rate310n"; ?>,
  'b3120': <?php echo "$rate312n"; ?>,
  'b3150': <?php echo "$rate315n"; ?>,
  'b3200': <?php echo "$rate320n"; ?>,
  'b3250': <?php echo "$rate325n"; ?>,
  'b3300': <?php echo "$rate330n"; ?>,
  
  'b3101': <?php echo "$rate310y"; ?>,
  'b3121': <?php echo "$rate312y"; ?>,
  'b3151': <?php echo "$rate315y"; ?>,
  'b3201': <?php echo "$rate320y"; ?>,
  'b3251': <?php echo "$rate325y"; ?>,
  'b3301': <?php echo "$rate330y"; ?>,

  'p3100': <?php echo "$rate310n" * 1.2; ?>,
  'p3120': <?php echo "$rate312n" * 1.2; ?>,
  'p3150': <?php echo "$rate315n" * 1.2; ?>,
  'p3200': <?php echo "$rate320n" * 1.2; ?>,
  'p3250': <?php echo "$rate325n" * 1.2; ?>,
  'p3300': <?php echo "$rate330n" * 1.2; ?>,
  
  'p3101': <?php echo "$rate310y" * 1.2; ?>,
  'p3121': <?php echo "$rate312y" * 1.2; ?>,
  'p3151': <?php echo "$rate315y" * 1.2; ?>,
  'p3201': <?php echo "$rate320y" * 1.2; ?>,
  'p3251': <?php echo "$rate325y" * 1.2; ?>,
  'p3301': <?php echo "$rate330y" * 1.2; ?>,
  
  'b4100': <?php echo "$rate410n"; ?>,
  'b4120': <?php echo "$rate412n"; ?>,
  'b4150': <?php echo "$rate415n"; ?>,
  'b4200': <?php echo "$rate420n"; ?>,
  'b4250': <?php echo "$rate425n"; ?>,
  'b4300': <?php echo "$rate430n"; ?>,
  
  'b4101': <?php echo "$rate410y"; ?>,
  'b4121': <?php echo "$rate412y"; ?>,
  'b4151': <?php echo "$rate415y"; ?>,
  'b4201': <?php echo "$rate420y"; ?>,
  'b4251': <?php echo "$rate425y"; ?>,
  'b4301': <?php echo "$rate430y"; ?>,

  'p4100': <?php echo "$rate410n" * 1.2; ?>,
  'p4120': <?php echo "$rate412n" * 1.2; ?>,
  'p4150': <?php echo "$rate415n" * 1.2; ?>,
  'p4200': <?php echo "$rate420n" * 1.2; ?>,
  'p4250': <?php echo "$rate425n" * 1.2; ?>,
  'p4300': <?php echo "$rate430n" * 1.2; ?>,
  
  'p4101': <?php echo "$rate410y" * 1.2; ?>,
  'p4121': <?php echo "$rate412y" * 1.2; ?>,
  'p4151': <?php echo "$rate415y" * 1.2; ?>,
  'p4201': <?php echo "$rate420y" * 1.2; ?>,
  'p4251': <?php echo "$rate425y" * 1.2; ?>,
  'p4301': <?php echo "$rate430y" * 1.2; ?>,
};

matrix[cakePrice];

// Convert term to months
termz = {
  '2': 24,
  '3': 36,
  '4': 48,
}

// Convert term to 3+ total payments
termz3plus = {
  '2': 26,
  '3': 38,
  '4': 50,
}

function toCurrency(num) {
var sign;
var cents;
var i;
 
num = num.toString().replace(/\$|\,/g, '');
if (isNaN(num)) {
num = "0";
}
sign = (num == (num = Math.abs(num)));
num = Math.floor(num * 100 + 0.50000000001);
cents = num % 100;
num = Math.floor(num / 100).toString();
if (cents < 10) {
cents = '0' + cents;
}
 
for (i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++) {
num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
}
 
return (((sign) ? '' : '-') + num + '.' + cents);
}


// Create total rentals (intial + term -1)
	var remainPoop = ((termz[termPoop]) + initialPoop) -1;
	
// Create total payable rentals
	var totalPoop = (((termz[termPoop]) -1) + initialPoop);

// Create commission added to rental
	var commsPoop = ((getScodePrice() / totalPoop) * 0.92);
	
	
	
// Display Jacked monthly rental
    var divobj = document.getElementById('jackedPrice');
	var final3Monthly = toCurrency((matrix[cakePrice]) + commsPoop);
	var final69Monthly = toCurrency(((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop)
    divobj.style.display='block';

	if (initialPoop == '3') {
	divobj.innerHTML = "<img src='../img/arrow.gif' />&pound;" +final3Monthly;
	} else {
	divobj.innerHTML = "<img src='../img/arrow.gif' />&pound;" +final69Monthly;
	}
	
	
// Display remaining payments
    var divobj = document.getElementById('remainPrice');
	var remainPrice = +((termz[termPoop]) -1);
    divobj.style.display='inline';
	divobj.innerHTML = "For " +remainPrice +" months";
	
	
// Display Inc or Ex VAT 1
    var divobj = document.getElementById('BusPers1');
    divobj.style.display='inline';
	if (getProductPrice() == "b") { divobj.innerHTML = " (excl. VAT)"  }else{ divobj.innerHTML = " (incl. VAT)"  };
	
	
// Display Inc or Ex VAT 2
    var divobj = document.getElementById('BusPers2');
    divobj.style.display='inline';
	if (getProductPrice() == "b") { divobj.innerHTML = " <b>(excl. VAT)</b>"  }else{ divobj.innerHTML = " <b>(incl. VAT)</b>"  };


	
// Display business or personal
    var divobj = document.getElementById('BusPers');
	var busPrice = toCurrency(((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop) * 1.2));
	var persPrice = toCurrency (((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop) / 1.2));
    divobj.style.display='block';
	
	if (getProductPrice() == 'b') {
	divobj.innerHTML = "<b>Personal Lease Price:</b><br /><span class='cta'>&pound;" +busPrice +"</span> (including VAT)";
	} else {
	divobj.innerHTML = "<b>Business Lease Price:</b><br /><span class='cta'>&pound;" +persPrice +"</span> (excluding VAT)";
	}
	
	

// Display maint or no
    var divobj = document.getElementById('MaintYay');
    divobj.style.display='block';
	
	if (getMaintPrice() == '0') {
	divobj.innerHTML = "Customer will source own servicing, tyres and maintenance for the contract duration. <a href=''>More Info</a>";
	} else {
	divobj.innerHTML = "Full maintenance, servicing and replacement tyres included in the monthly rental. <a href=''>More Info</a>";
	}	


	
// Display monthly rental
    var divobj = document.getElementById('pulledPrice');
    divobj.style.display='block';
	divobj.innerHTML = (matrix[cakePrice]);

	
// Display initial rental
    var divobj = document.getElementById('initialPrice');
	var finalInitial = toCurrency((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop) * initialPoop);
    divobj.style.display='inline';
	divobj.innerHTML = "<b>&pound;" +finalInitial +"</b>";
	

	
	
// Populate Hidden Jacked monthly rental input
    var divobj = document.getElementById('ultiRental');
	var final3Monthly = toCurrency((matrix[cakePrice]) + commsPoop);
	var final69Monthly = toCurrency(((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop)
    divobj.style.display='';

	if (initialPoop == '3') {
	divobj.value = final3Monthly;
	} else {
	divobj.value = final69Monthly;
	}
	
	
// Populate Hidden Initial Rental input
    var divobj = document.getElementById('ultiInitial');
	var finalInitial = toCurrency((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) + commsPoop) * initialPoop);
    divobj.style.display='';
	divobj.value = finalInitial;


// Populate Hidden remaining payments input
    var divobj = document.getElementById('ultiRemain');
    divobj.style.display='';
	divobj.value = remainPrice;
	
	
	
// Populate Hidden remaining payments input
    var divobj = document.getElementById('ultiUpfront');
    divobj.style.display='';
	divobj.value = initialPoop;
	
	// Populate Hidden remaining payments input
    var divobj = document.getElementById('ultiKpa');
    divobj.style.display='';
	
	if (getKpaPrice() == '12') {
	divobj.value = getKpaPrice() +",500";
	} else {
	divobj.value = getKpaPrice() +",000";
	}
	
}



</script>


<ul id="breadcrumb">
<a title="" href="index.php">Deal Den Home</a> &gt; 
<a title="" href="offers.php">Special Offers</a> &gt; 
<?php echo "$make"; ?><?php echo "$model"; ?>
</ul>


<form action="" id="cakeform" onsubmit="return false;">

<table id="quotetable" border="0" cellspacing="0" cellpadding="0">

<tr>
<td colspan="2"><h3 class="quote">Choose your lease options:</h3></td>
</tr>

<tr>
<td class="tdlabel">Lease Type*</td>
<td><select id="product" name='product' onchange="calculateTotal()">
<option value="business">Please select your lease type</option>
<option value="business">Business</option>
<?php if( protectThis("1, 2") ) : ?>
<option value="personal">Personal</option>
<?php endif; ?>
</select></td>

</tr>


<tr>
<td class="tdlabel">Contract Term:</td>
<td><select id="term" name='term' onchange="calculateTotal()">
<option <?php if($term =='24') echo 'selected="selected"'; ?> value="24">24 Months</option>
<option <?php if($term =='36') echo 'selected="selected"'; ?> value="36">36 Months</option>
<option <?php if($term =='48') echo 'selected="selected"'; ?> value="48">48 Months</option>
</select></td>

</tr>


<tr>
<td class="tdlabel">Annual Mileage:</td>
<td><select id="kpa" name='kpa' onchange="calculateTotal()">
<option <?php if($kpa =='10') echo 'selected="selected"'; ?> value="10">10,000</option>
<option <?php if($kpa =='12') echo 'selected="selected"'; ?> value="12">12,500</option>
<option <?php if($kpa =='15') echo 'selected="selected"'; ?> value="15">15,000</option>
<option <?php if($kpa =='20') echo 'selected="selected"'; ?> value="20">20,000</option>
<option <?php if($kpa =='25') echo 'selected="selected"'; ?> value="25">25,000</option>
<option <?php if($kpa =='30') echo 'selected="selected"'; ?> value="30">30,000</option>
</select></td>

</tr>


<tr>
<td class="tdlabel">Initial Rentals:</td>
<td><select id="initial" name='initial' onchange="calculateTotal()">
<option <?php if($initial =='3') echo 'selected="selected"'; ?> value="3">3 Rentals</option>
<option <?php if($initial =='6') echo 'selected="selected"'; ?> value="6">6 Rentals</option>
<option <?php if($initial =='9') echo 'selected="selected"'; ?> value="9">9 Rentals</option>
</select></td>

</tr>


<tr>
<td class="tdlabel">Monthly Maintenance i</td>
<td><select id="maint" name='maint' onchange="calculateTotal()">
<option <?php if($maint =='1') echo 'selected="selected"'; ?> value="yes">Yes</option>
<option <?php if($maint =='0') echo 'selected="selected"'; ?> value="no">No</option>
</select></td>

</tr>

<tr>
<td class="tdlabel">Commission i</td>
<td>

  <!--<input type="text" id="scode" id="scode" data-slider="true" data-slider-values="100,200,300,1000" value="300" onchange="calculateTotal()">//-->
  
  <input type="text" id="scode" data-slider="true" data-slider-highlight="true" data-slider-range="0,<?php echo "$maxComms"; ?>" data-slider-step="50" onchange="calculateTotal()" value="<?php echo "$comms";?>">

  <script>
  $("[data-slider]")
    .each(function () {
      var input = $(this);
      $("<span>")
        .addClass("output")
        .insertAfter($(this));
    })
    .bind("slider:ready slider:changed", function (event, data) {
      $(this)
        .nextAll(".output:first")
          .html("&pound;" +data.value.toFixed(0));
    });
  </script>

</td>
</tr>

<tr>
<td colspan="2"><hr /></td>
</tr>



<?php if( protectThis("1, 2") ) : ?>


<tr>
<td class="tdlabel">Funder:</td>
<td class="source"><?php echo "$source"; ?></td>
</tr>

<tr>
<td class="tdlabel">OTR:</td>
<td class="source">&pound;<?php echo "$otr"; ?></td>
</tr>

<tr>
<td class="tdlabel">Deal Expiry:</td>
<td class="source"><?php echo "$expire"; ?></td>
</tr>

<tr>
<td class="tdlabel">Offer Notes:</td>
<td class="source"><?php echo "$notes"; ?></td>
</tr>


<?php endif; ?>

<tr>
<td colspan="2"><hr /></td>
</tr>

<tr>
<td colspan="2">
<ul id="offer-icons">
<li><a href="forms/request_quote.php?id=<? echo "$id"; ?>"><img src="img/btn-request-quote.png" /></a></li>
<li><a href="forms/email_offer.php?id=<? echo "$id"; ?>"><img src="img/btn-email-offer.png" /></a></li>
</ul>
</td>
</tr>

</table>

<table id="resulttable" border="0" cellspacing="0" cellpadding="0">

<tr style="display: none;">
<td><div id="totalPrice"></div><div id="pulledPrice"></div></td>
</tr>

<tr>
<td colspan="2"><h3 class="quote"><?php echo "$make"; ?></h3><h3 class="quotered"><?php echo "$model"; ?></h3></td>
</tr>

<tr>
<td colspan="2"><img width="200px" src="../img/veh-pic/<?php echo "$pic"; ?>" /></td>
</tr>

	<tr>
		<td colspan="2"><h3 class="quote">Price Summary</h3></td>
	</tr>
	
	<tr>
		<td colspan="2"><h4 class="cta">Monthly Payments</h4></td>
	</tr>

	<tr>
		<td><div id="jackedPrice"><img src="img/arrow.gif" />&pound;<?php echo "$rental"; ?></div></td>
		<td rowspan="2" width="200px">priceddddd</td>
	</tr>
	
	<tr class="quotesmall">
		<td><div id="remainPrice" style="display: inline">For <?php echo "$term" -1; ?> months</div>
		<div id="BusPers1" style="display: inline;"> (excl. VAT)</div></td>
	</tr>
	
	<tr><td colspan="2"><hr></td></tr>
	
	<tr class="quotesmall">
		<td>Initial Payment</td>
		<td><div id="initialPrice" style="display: inline"><b>&pound;<?php echo "$rental" * "$initial"; ?></b></div>
		<div id="BusPers2" style="display: inline"><b> (excl. VAT)</b></div></td>
	</tr>
	
	<!--<tr class="quotesmall">
		<td>Processing Fee</td>
		<td><b>processing fee</b></td>
	</tr>//-->
	
	<tr class="quotesmall">
		<td>Maintenance</td>
		<td><div id="MaintYay">Customer will source own servicing, tyres and maintenance for the contract duration. <a href="#">More Info</a></div></td>
	</tr>
	
<tr>
<td colspan="2"><hr></td>
</tr>	

<?php if( protectThis("1, 2") ) : ?>
	<tr class="quotesmall">
		<td colspan="2"><div id="BusPers"><b>Personal Lease Price:</b><br /><span class="cta">&pound;<?php echo "$rental" * 1.2; ?></span> (including VAT)</div></td>
	</tr>
<?php endif; ?>

<tr style="display: none;">
<td><input type='submit' id='submit' class="btn" value='Submit' onclick="calculateJava()" /></td>
</tr>

</table>

</form>






<script type='text/javascript'> 

function Search(){
var uRental = document.getElementById("ultiRental").value; 
var uInitial = document.getElementById("ultiInitial").value; 

var url="http://www.dealden.co.uk/forms/email_offer.php?id=<?php echo "$id"; ?>&ultiRental="+uRental +"&ultiInitial=" +uInitial; 
window.location = url; 
return false;
} 

</script>


<form name="search" >
  <input type="text" class="hidden_input" name="ultiRental" id="ultiRental" value="<?php echo "$rental"; ?>" />
   <input type="text" class="hidden_input" name="ultiInitial" id="ultiInitial" value="<?php echo "$rental" * "$initial"; ?>" />
    <input type="text" class="hidden_input" name="ultiRemain" id="ultiRemain" value="<?php echo "$term" -1; ?>" />
     <input type="text" class="hidden_input" name="ultiUpfront" id="ultiUpfront" value="<?php echo "$initial"; ?>" />
     <input type="text" class="hidden_input" name="ultiKpa" id="ultiKpa" value="<?php echo "$mileage"; ?>" />
  <input type="button" class="email_btn" name="btnser" onclick="Search()" value="Email Offer" />
</form>









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
&copy; 2012 <a href="http://www.dealdel.co.uk">DealDen.co.uk</a> is a trading style of Fleet Street LTD. All rights reserved.
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