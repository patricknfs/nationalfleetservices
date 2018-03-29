<?php
require_once("application-top.php");
require_once("cpanel/include/classes/class.Make.php");
require_once("cpanel/include/classes/class.Model.php");
require_once("cpanel/include/classes/class.Offers.php");

$dbObj = new DB();
$dbObj->fun_db_connect();
$objOfr = new Offers();

$ofrObj   = new Offers();
$objMake  = new Make();
$objModel = new Models();
?>
<script language="javascript" type="text/javascript">
	function funValidation(){
		var frm = document.searchfrm;
		if(frm.make_id.value == ''){
			alert("Please choose make");
			frm.make_id.focus();
			return false;
		}
		return true; 
	}
</script>
<table width="200" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="search-bg">
			<form action="searchresult.php" method="get" name="searchfrm" id="search" onsubmit="javascript: return funValidation();">
				<input type="hidden" name="searchkey" value="<?php echo md5("ASHWANI");?>" />  
				<p class="psearch"><strong>Search By Manufacturer</strong></p>
				<select name="make_id" class="listmenu" onChange="javascript: funSetModel(this.value, '');">
					<option value="">Choose Make</option>
					<?php $objMake->fun_MakeOptions($_GET['make_id']);?>
					<option value="All" <?php if(isset($_GET['make_id']) && $_GET['make_id']=="All"){echo "selected";}?>>All</option>
				</select>
				<p class="psearch"><strong>Search By Price Bands </strong></p>
				<select name="pricerange" class="listmenu">
					<option value="1" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 1) echo "selected"?> >&pound;0 - &pound;199.99</option>
					<option value="2" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 2) echo "selected"?>>&pound;200 - &pound;299.99</option>
					<option value="3" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 3) echo "selected"?>>&pound;300 - &pound;399.99</option>
					<option value="4" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 4) echo "selected"?>>&pound;400 - &pound;499.99</option>
					<option value="5" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 5) echo "selected"?>>&pound;500 - Above</option>
					<option value="Any" <?php if(isset($_GET['pricerange']) && $_GET['pricerange']=="Any"){echo "selected";}?>>Any</option>
				</select>
				<p class="psearch"><strong>Search By Finance Type </strong></p>
				<select name="finance_id" class="listmenu">
					<option  value="1" <?php if(isset($_GET['finance_id']) && $_GET['finance_id'] == 1) echo "selected"?>>Business</option>
					<option value="2" <?php if(isset($_GET['finance_id']) && $_GET['finance_id'] == 2) echo "selected"?>>Personal</option>
					<option value="3" <?php if(isset($_GET['finance_id']) && $_GET['finance_id'] == 3) echo "selected"?>>Both</option>
				</select>
				<p class="psearch">
					<input name="searchbtn" type="image" class="go" id="searchbtn" src="images/go.jpg" />
				</p>
			</form>
		</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" width="20" height="5" /></td>
	</tr>
	<tr>
		<td class="product">Our Product Range</td>
	</tr>
	<tr>
		<td>
			<ul class="matterul">
				<li class="matter"><a href="contract-hire.php">Contract Hire</a></li>
				<li class="matter"><a href="finance-lease.php">Finance Lease</a></li>
				<li class="matter"><a href="Sale-Leaseback.php">Sale &amp; Leaseback</a></li>
				<li class="matter"><a href="Contract-Purchase.php">Contract Purchase</a></li>
				<li class="matter"><a href="Personal-Contract-Hire.php">Personal Contract Hire</a></li>
				<li class="matter"><a href="Hire-Purchase.php">Hire Purchase</a></li>
				<li class="matter"><a href="Lease-Purchase.php">Lease Purchase</a></li>
				<li class="matter"><a href="Vehicle-Purchase.php">Vehicle Purchase</a></li>
				<li class="matter"><a href="Asset-Finance.php">Asset Finance</a></li>
				<li class="matter"><a href="Taxi-Cab-Finance.php">Taxi Cab Finance</a></li>
				<li class="matter"><a href="Business-Daily-Rental.php">Business Daily Rental</a></li>
				<li class="matter"><a href="Stand-Alone-Maintenance.php">Stand Alone Maintenance</a></li>
				<li class="matter"><a href="Gap-Insurance.php">Gap Insurance</a></li>
				<li class="matter"><a href="Sales-Process-Explained.php">Sales Process Explained</a></li>
				<!--<li class="matter"><a href="Finance-Comparison-Table.php">Finance Comparison Table</a></li> -->
				<li class="matter"><a href="Driver-License-Checking.php">Drivers License Check</a></li>
				<li class="matter"><a href="Tracker-Telematics.php">Tracker &amp; Telematics</a></li>
			</ul>
		</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" width="1" height="5" /></td>
	</tr>
	<tr>
		<td class="product">Useful Links</td>
	</tr>
	<tr>
		<td>
			<ul class="matterul">
				<li class="matter"><a href="Manufacturers.php">Manufacturers</a></li>
				<li class="matter"><a href="http://www.energysavingtrust.org.uk/fleet/" target="_blank" rel="nofollow">Energy Savings Trust</a></li>
				<li class="matter"><a href="http://www.theaa.com/travelwatch/planner_main.jsp?database=B" target="_blank" rel="nofollow">Route Planner</a></li>
				<li class="matter"><a href="http://www.theaa.com/travelwatch/travel_news.jsp" target="_blank" rel="nofollow">Traffic Reports</a></li>
				<li class="matter"><a href="http://www.bbc.co.uk/weather/" target="_blank" rel="nofollow">Weather Forecast</a></li>
				<li class="matter"><a href="http://www.cclondon.com/" target="_blank" rel="nofollow">London Surcharge</a></li>
				<li class="matter"><a href="http://www.cartax.co.uk/" target="_blank" rel="nofollow">Car Tax Calculator</a></li>
				<li class="matter"><a href="http://www.direct.gov.uk/en/environmentandgreenerliving/actonco2/DG_067197?cids=Google_PPC&amp;cre=CO2Cal" target="_blank" rel="nofollow">C02 Emissions</a></li>
			</ul>
		</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" width="20" height="5" /></td>
	</tr>
</table>