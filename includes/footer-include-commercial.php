<?php 
require_once("application-top.php");
$dbObj = new DB();
$dbObj->fun_db_connect();
$sql = "SELECT * FROM ".TABLE_MAKES." ORDER BY CategoryName";
$result = $dbObj->fun_db_query($sql);
?>
<table width="100%" cellpadding="0" cellspacing="0">
    <? if (!isset($footertype)) { // for excluding manufacturer links on inner pages. 1 for exclude. 0 to include.
	   ?>

   <tr>
    <td>&nbsp;</td>
    <td align="center" class="footer-link">
    <a href="van-leasing-deals.php?contract_hire=Citroen">Citroen Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Daihatsu">Daihatsu Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Fiat">Fiat Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Ford">Ford Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Hyundai">Hyundai Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Jeep">Jeep Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Kia">Kia Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=L/Rover">Land Rover Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Mazda">Mazda Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Merc/Benz">Mercedes Benz Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Mitsubishi">Mitsubishi Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Nissan">Nissan Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Peugeot">Peugeot Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Proton">Proton Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Renault">Renault Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Seat">Seat Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Skoda">Skoda Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Subaru">Subaru Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Suzuki">Suzuki Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Toyota">Toyota Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Vauxhall">Vauxhall Van Lease</a> | 
    <a href="van-leasing-deals.php?contract_hire=Volkswagen">Volkswagen Van Lease</a>
	</td>
    <td>&nbsp;</td>
  </tr>
  <?    } else if ($footertype == 1) { ?>
	  <tr>
    <td>&nbsp;</td>
    <td align="center" class="footer-link">
	  Model Range for Contract Hire: <?
		 
		 while($infomodel2 = mysql_fetch_array($modelrange2))  {
			 if (($manu == "Audi") OR ($manu == "Aston Martin") OR ($manu == "Alfa Romeo")) {
				$linker = "n";
			 }
		 echo (" - <a href='{$_SERVER['PHP_SELF']}?contract_hire=$manu&model=".$infomodel2['Model']."'>Lease a$linker " .$manu. " " . $infomodel2['Model'] . " van</a>");
		 } ?>
         </td>
    <td>&nbsp;</td>
  </tr>
  <? }
   ?> 
  <tr>
	<td>&nbsp;</td>
    <td align="center" class="footer-link"><a href="http://www.fleetstreetltd.co.uk/">Car Leasing</a> (Home) | <a href="../business-offers.php">Business Car Leasing Deals</a> | <a href="../personal-offers.php">Cheap Personal Contract Hire Offers</a> | <a href="../commercial-offers.php">Commercial Vehicle Van Leasing Deals</a> | <a href="../prestige.php">Prestige Car Lease Hire Offers</a> | <a href="../daily-rentals.php">Daily Rental</a> | <a href="about-us.php">About Us</a> | <a href="faq.php">FAQ's</a> | <a href="contact-us.php">Contact Us</a> | <a href="terms-conditions.php">Terms &amp; Conditions</a> | <a href="resources.php">Resources</a> | <a href="sitemap.php">Sitemap</a> |  | <a href="../articles.php">Articles</a>  </td>
	  <td>&nbsp;</td>	  
  </tr>
   <tr>
    <td colspan="3"><hr color="#CCCCCC" /></td>
  </tr>

 
  <tr>
    <td><img src="images/rounded-bottom-left.jpg" width="15" height="15" /></td>
    <td><img src="images/spacer.gif" height="15" />
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3719447-1";
urchinTracker();
</script></td>
    <td align="right" valign="bottom"><img src="images/rounded-bottom-right.jpg" width="15" height="15" /></td>
  </tr>
  <tr>
    <td colspan="3" class="magnon"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&copy; Copyright 2010 Fleet Street Ltd</td>
        <td align="right"><!--Website Designed &amp; Developed by Charter House Media -->
		</td>
      </tr>
    </table></td>
  </tr>
  </table>
