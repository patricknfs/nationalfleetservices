<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<style>

body {
	font-family: Arial, helvetica, sans-serif;
}

h3.quote {
	font-size: 20px;
	margin: 0px;
	padding: 0px 0px 20px 0px;
}

h2.cta {

}

h4.cta {
	font-size: 14px;
	font-weight: bold;
	color: #0681e0;
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
}

#quotetable td {
	padding: 5px 0 5px 0;
}

#resulttable td {
	padding: 0px;
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

#quotetable {
	border-right: 1px solid #ccc;
	padding: 0px 30px 0px 20px;
	float: left;
}

#resulttable {
	padding: 0px 20px 0px 20px;
	width: 300px;
	float: left;
}

#jackedPrice {
	font-size: 24px;
	font-weight: bold;
	color: #0681e0;
	margin: 0px;
	padding: 0px;
}

</style>
	
</head>

<body>


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
 
return (((sign) ? '' : '-') + '£' + num + '.' + cents);
}


// Create total rentals (intial + term -1)
	var remainPoop = ((termz[termPoop]) + initialPoop) -1;
	
	
// Display Jacked monthly rental
    var divobj = document.getElementById('jackedPrice');
	var final3Monthly = toCurrency((matrix[cakePrice]));
	var final69Monthly = toCurrency(((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop))
    divobj.style.display='block';

	if (initialPoop == '3') {
	divobj.innerHTML = final3Monthly;
	} else {
	divobj.innerHTML = final69Monthly;
	}
	
	
// Display remaining payments
    var divobj = document.getElementById('remainPrice');
    divobj.style.display='inline';
	divobj.innerHTML = "For " +((termz[termPoop]) -1) +" months";
	
	
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
	var busPrice = toCurrency((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) * 1.2));
	var persPrice = toCurrency ((((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) / 1.2));
    divobj.style.display='block';
	
	if (getProductPrice() == 'b') {
	divobj.innerHTML = "<b>Personal Lease Price:</b><br />" +busPrice +" (including VAT)";
	} else {
	divobj.innerHTML = "<b>Business Lease Price:</b><br />" +persPrice +" (excluding VAT)";
	}

	
// Display monthly rental
    var divobj = document.getElementById('pulledPrice');
    divobj.style.display='block';
	divobj.innerHTML = (matrix[cakePrice]);

	
// Display initial rental
    var divobj = document.getElementById('initialPrice');
	var finalInitial = toCurrency(((matrix[cakePrice]) * (termz3plus[termPoop]) / remainPoop) * initialPoop);
    divobj.style.display='inline';
	divobj.innerHTML = "<b>" +finalInitial +"</b>";
}

</script>

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
<option value="personal">Personal</option></td>
</select>

</tr>


<tr>
<td class="tdlabel">Contract Term:</td>
<td><select id="term" name='term' onchange="calculateTotal()">
<option <?php if($term =='24') echo 'selected="selected"'; ?> value="24">24 Months</option>
<option <?php if($term =='36') echo 'selected="selected"'; ?> value="36">36 Months</option>
<option <?php if($term =='48') echo 'selected="selected"'; ?> value="48">48 Months</option></td>
</select>

</tr>


<tr>
<td class="tdlabel">Annual Mileage:</td>
<td><select id="kpa" name='kpa' onchange="calculateTotal()">
<option <?php if($kpa =='10') echo 'selected="selected"'; ?> value="10">10,000</option>
<option <?php if($kpa =='12') echo 'selected="selected"'; ?> value="12">12,500</option>
<option <?php if($kpa =='15') echo 'selected="selected"'; ?> value="15">15,000</option>
<option <?php if($kpa =='20') echo 'selected="selected"'; ?> value="20">20,000</option>
<option <?php if($kpa =='25') echo 'selected="selected"'; ?> value="25">25,000</option>
<option <?php if($kpa =='30') echo 'selected="selected"'; ?> value="30">30,000</option></td>
</select>

</tr>


<tr>
<td class="tdlabel">Initial Rentals:</td>
<td><select id="initial" name='initial' onchange="calculateTotal()">
<option <?php if($initial =='3') echo 'selected="selected"'; ?> value="3">3 Rentals</option>
<option <?php if($initial =='6') echo 'selected="selected"'; ?> value="6">6 Rentals</option>
<option <?php if($initial =='9') echo 'selected="selected"'; ?> value="9">9 Rentals</option></td>
</select>

</tr>


<tr>
<td class="tdlabel">Monthly Maintenance i</td>
<td><select id="maint" name='maint' onchange="calculateTotal()">
<option <?php if($maint =='1') echo 'selected="selected"'; ?> value="yes">Yes</option>
<option <?php if($maint =='0') echo 'selected="selected"'; ?> value="no">No</option></td>
</select>

</tr>

</table>




<table id="resulttable" border="0" cellspacing="0" cellpadding="0">

<tr>
<td><div id="totalPrice"></div><div id="pulledPrice"></div></td>
</tr>

<tr>
<td colspan="2"><h3 class="quote"><?php echo "$make"; ?> <?php echo "$model"; ?></h3></td>
</tr>

<tr>
<td colspan="2"><img width="200px" src="../images/veh-pic/<?php echo "$pic"; ?>" /></td>
</tr>

	<tr>
		<td colspan="2"><h3 class="quote">Price Summary</h3></td>
	</tr>
	
	<tr>
		<td colspan="2"><h4 class="cta">Monthly Payments</h4></td>
	</tr>

	<tr>
		<td><div id="jackedPrice">&pound;<?php echo "$rental"; ?></div></td>
		<td rowspan="2">priceddddfdddd</td>
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
	
	<tr class="quotesmall">
		<td>Processing Fee</td>
		<td><b>processing fee</b></td>
	</tr>
	
	<tr class="quotesmall">
		<td>maintenance</td>
		<td><b>maint</b></td>
	</tr>
	
<tr>
<td colspan="2"><hr></td>
</tr>	
	
	<tr class="quotesmall">
		<td colspan="2"><div id="BusPers"><b>Personal Lease Price:</b><br />&pound;<?php echo "$rental" * 1.2; ?> (including VAT)</div></td>
	</tr>

<tr>

<td><input type='submit' id='submit' class="btn" value='Submit' onclick="calculateJava()" /></td>
</tr>
</table>




</form>

</body>
</html>