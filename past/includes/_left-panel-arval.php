<?php
//require_once("./application-top.php");
//require_once("./cpanel/include/classes/class.Make.php");
//require_once("./cpanel/include/classes/class.Model.php");
//require_once("./cpanel/include/classes/class.Offers.php");

/*$dbObj = new DB();
$dbObj->fun_db_connect();
$objOfr = new Offers();

$ofrObj   = new Offers();
$objMake  = new Make();
$objModel = new Models();*/

// Make a MySQL Connection
mysql_connect("213.171.219.91", "fleetstreet", "48hours") or die(mysql_error());
mysql_select_db("fleetstreet") or die(mysql_error());

include("newincludes/arval_search.php"); 


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
<script language="JavaScript" type="text/javascript"> 
function display_data(id) {  
    xmlhttp=GetXmlHttpObject(); 
    if (xmlhttp==null) { 
        alert ("Your browser does not support AJAX!"); 
        return; 
    }  
    var url="newincludes/findmodel.php"; 
    url=url+"?manufacturer="+id; 
    xmlhttp.onreadystatechange=function() { 
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") { 
            document.getElementById('employ_data').innerHTML=xmlhttp.responseText; 
        } 
    } 
    xmlhttp.open("GET",url,true); 
    xmlhttp.send(null); 
} 
function GetXmlHttpObject() { 
    var xmlhttp=null; 
    try { 
        // Firefox, Opera 8.0+, Safari 
        xmlhttp=new XMLHttpRequest(); 
    } 
    catch (e) { 
        // Internet Explorer 
        try { 
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
        } 
        catch (e) { 
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
        } 
    } 
    return xmlhttp; 
} 
</script>
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="search-bg"><form action="searchresult-al.php" method="get" name="searchfrm" id="search" onsubmit="">
        <p class="psearch"><strong>Search By Manufacturer</strong></p>
        <select name="make_id" class="listmenu" onChange="display_data(this.value);">
          <option value="">Choose Make</option>
          <option value="All" <?php if(isset($_GET['make_id']) && $_GET['make_id']=="All"){echo "selected";}?>>Any</option>
          <? while($info = mysql_fetch_array( $manu_search ))
 { ?>
 <option <? if(($_GET['make_id']) == $info['Manufacturer']){echo "selected ";} ?>value="<? echo($info['Manufacturer']) ?>" ><? echo($info['Manufacturer']) ?></option>
          
          <? } ?>
        </select>
        
        <!-- START NEW AJAX SEARCH -->
        <div id="employ_data">
		<? if(($_GET['make_id'] != "") || ($_GET['make_id'] != "all")) {
			$manufacturer2 = $_GET['make_id'];
			mysql_select_db('fleetstreet'); //change this if required
$query="SELECT DISTINCT
`ratebook_arval`.`Model`
FROM
`ratebook_arval`
WHERE
`ratebook_arval`.`Manufacturer` = '$manufacturer2'";
$result=mysql_query($query);
$result2=mysql_num_rows($result);
//echo($result2);
//echo($manufacturer);?><p class="psearch"><strong>Narrow Down By Model</strong></p>
<select name="model" class="listmenu">
<option>Select Model</option>
<option value="Any">Any</option>
<? while($row = mysql_fetch_array($result))
{ ?>
   <option value="<? echo($row['Model']); ?>" <? if(($_GET['model']) == $row['Model']){echo "selected ";} ?>><? echo($row['Model']); ?></option>
<? } ?>
</select>
			
		<? } ?></div>
        
        <!-- END NEW AJAX BIT -->
       <!-- <p class="psearch"><strong>Search By Price Band</strong></p>
        <p>
          <select name="pricerange" class="listmenu">
            <option value="Any">Any</option>
            <option value="1" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 1) echo "selected"?>>&pound;0 - &pound;99.99</option>
            <option value="2" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 2) echo "selected"?>>&pound;100 - &pound;149.99</option>
            <option value="3" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 3) echo "selected"?>>&pound;150 - &pound;199.99</option>
            <option value="4" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 4) echo "selected"?>>&pound;200 - &pound;249.99</option>
            <option value="5" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 5) echo "selected"?>>&pound;250 - &pound;299.99</option>
            <option value="6" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 6) echo "selected"?>>&pound;300 - &pound;349.99</option>
            <option value="7" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 7) echo "selected"?>>&pound;350 - &pound;399.99</option>
            <option value="8" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 8) echo "selected"?>>&pound;400 - &pound;499.99</option>
            <option value="9" <?php if(isset($_GET['pricerange']) && $_GET['pricerange'] == 9) echo "selected"?>>&pound;500 - Above</option>
          </select>
        </p> -->
        <p class="psearch"><strong>Search By Price</strong></p>
         <p>From:
          <input type="text" name="price_low" id="price_low" value="<? if(isset($_GET['price_low'])) echo ($_GET['price_low']); ?>" size="3" />
          To:
          <input type="text" name="price_high" id="price_high" value="<? if(isset($_GET['price_high'])) echo ($_GET['price_high']) ?>" size="3" />
        </p>
        <p class="psearch"><strong>Search By CO2 Band</strong></p>
        <select name="co2range" class="listmenu">
          <option value="Any">Any</option>
          <option value="1" <?php if(isset($_GET['co2range']) && $_GET['co2range'] == 1) echo "selected"?>>&#60; 100</option>
          <option value="2" <?php if(isset($_GET['co2range']) && $_GET['co2range'] == 2) echo "selected"?>>100 - 119</option>
          <option value="3" <?php if(isset($_GET['co2range']) && $_GET['co2range'] == 3) echo "selected"?>>120 - 159</option>
          <option value="4" <?php if(isset($_GET['co2range']) && $_GET['co2range'] == 4) echo "selected"?>>160 &#43;</option>
        </select>
        <p class="psearch"><strong>Keyword Search:</strong><br /><input type="text" name="keywords" id="keywords" value="<? if($_GET['keywords'] != "") {echo($keywords);} ?>" size="22" />
          
        </p>

        
        <!-- <p class="psearch"><strong>Search By Finance Type </strong></p>
        <select name="finance_id" class="listmenu">
          <option  value="1" <?php //if(isset($_GET['finance_id']) && $_GET['finance_id'] == 1) echo "selected"?>>Business</option>
          <option value="2" <?php //if(isset($_GET['finance_id']) && $_GET['finance_id'] == 2) echo "selected"?>>Personal</option>
          <option value="3" <?php //if(isset($_GET['finance_id']) && $_GET['finance_id'] == 3) echo "selected"?>>Both</option>
        </select> -->
        <p class="psearch">
          <input name="searchbtn" type="image" class="go" id="searchbtn" src="images/go.jpg" />
        </p>
      </form></td>
  </tr>
  <tr>
    <td><img src="images/spacer.gif" width="20" height="5" /></td>
  </tr>
  <tr>
    <td class="product">Our Product Range</td>
  </tr>
  <tr>
    <td><ul class="matterul">
    	<li class="matter"><a href="cars-in-stock.php"><strong>STOCK VEHICLES!</strong></a></li>
    	<li class="matter"><a href="fleet-management.php">Fleet Management</a></li>
        <li class="matter"><a href="contract-hire.php">Contract Hire</a></li>
		<li class="matter"><a href="Car-Insurance.php">Car Insurance</a></li>
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
      </ul></td>
  </tr>
  <tr>
    <td><img src="images/spacer.gif" width="1" height="5" /></td>
  </tr>
  <tr>
    <td class="product">Useful Links</td>
  </tr>
  <tr>
    <td><ul class="matterul">
       <!--  <li class="matter"><a href="Manufacturers.php">Manufacturers</a></li> -->
        <li class="matter"><a href="http://www.energysavingtrust.org.uk/fleet/" target="_blank" rel="nofollow">Energy Savings Trust</a></li>
        <li class="matter"><a href="http://www.theaa.com/travelwatch/planner_main.jsp?database=B" target="_blank" rel="nofollow">Route Planner</a></li>
        <li class="matter"><a href="http://www.theaa.com/travelwatch/travel_news.jsp" target="_blank" rel="nofollow">Traffic Reports</a></li>
        <li class="matter"><a href="http://www.bbc.co.uk/weather/" target="_blank" rel="nofollow">Weather Forecast</a></li>
        <li class="matter"><a href="http://www.cclondon.com/" target="_blank" rel="nofollow">London Surcharge</a></li>
        <li class="matter"><a href="http://www.cartax.co.uk/" target="_blank" rel="nofollow">Car Tax Calculator</a></li>
        <li class="matter"><a href="http://www.direct.gov.uk/en/environmentandgreenerliving/actonco2/DG_067197?cids=Google_PPC&amp;cre=CO2Cal" target="_blank" rel="nofollow">C02 Emissions</a></li>
      </ul></td>
  </tr>
  <tr>
    <td><img src="images/spacer.gif" width="20" height="5" /></td>
  </tr>
</table>
