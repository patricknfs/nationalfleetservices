<?php 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FleetStreetLtd :: Welcome</title>
<link href="style/fleetStreetLtd.css" rel="stylesheet" type="text/css" />
<script src="includes/validationfun.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<table width="1000" border="0" cellpadding="0" cellspacing="0" id="center-table">
  <tr>
    <td colspan="7"><?php include("includes/header-image.php")?></td>
  </tr>
  <tr>
    <td width="10"><img src="images/spacer.gif" width="15" height="1" /></td>
    <td valign="top">
	<?php include('includes/left-panel-new.php'); ?>
    </td>
    <td width="1" valign="top">&nbsp;</td>
    <td valign="top">
	<!-- body content start here -->
	<table width="556" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><img src="images/box-top.jpg" width="552" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" background="images/box-middle.jpg" class="box-middle txt padding"><h1 class="welcome">Welcome to Fleet Street Contract Hire and Leasing</h1>
            <br />
            <strong>Contract Hire &amp; Leasing for Personal or Business Use</strong><br />
            <br />
         We have a wide range of personal Leasing and business leasing deals for you to choose from. At Fleet Street we are able to supply the full range of leasing products for your convenience including; Contract Hire, Personal Contract Hire, PCP (Personal Contract Purchase,) PCH, (Personal Contract Hire,) Finance Lease, Contract Purchase, Lease Purchase and many more including the Contract Hire Special Offers’ that you see below. All enquires are welcome so we look forward to speaking with you soon. <strong>Call us on: 0870 889 0181</strong> or fill in the ‘Call Me Back’ box and we will call you back.
          <!--<b>Fleet Street Ltd</b> was set up in 1996 to specialise in supplying both cars and vans to Business Users. In this time we have been highly successful.
          
          Our customers have a small dedicated team available to them to handle their day to day queries. We do not have the high turnover of staff that affects a lot of larger companies. This has proved popular and has contributed towards our success within the fleet industry.
          
          We always strive to understand our customers day to day needs, and it is our aim is to exceed their expectations.
          
          Fleet Street's customer base now includes sole traders, professional practices, national  .. --></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/box-bottom.jpg" width="552" height="10" /></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/spacer.gif" width="1" height="3" /></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/box-top.jpg" width="552" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" class="box-middle"><img src="images/spacer.gif" alt="spacer" width="9" height="1" />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
				<?php if($featured->offer_image != ''){?>
				<img src="offers/<?php echo $featured->offer_image?>" alt="car1"  class="padding" />
				<?php }else{?>
				<img src="images/car01.jpg" alt="car1" width="246px" height="158px"  class="padding" />
				<?php }?>
				</td>
                <td><span class="model_name"><br />
                  <?php echo $mkDts['CategoryName']." ".$mdlDts['SubCatName'] ?></span><br />
                  <span class="type"><?php echo $featured->offer_varient?></span><br />
                  <br />
                  <span class="price">&pound;<?php echo $featured->offer_price?></span> <span class="per_month">per month</span><br />
                
                  <p>&nbsp;</p>
                  <a href="enquiry.php?offer_id=<?php echo $featured->offer_id?>"><img src="images/more.jpg" width="108" height="24" border="0" class="more_buttton" /></a></td>
              </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/box-bottom.jpg" width="552" height="10" /></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/spacer.gif" width="20" height="10" /></td>
      </tr>
      <tr>
	 <?php
		 $cnt=1;	
		 while($rows = $dbObj->fun_db_fetch_rs_object($result)){
			  $mkDt = $objMk->funGetMakeInfo($rows->make_id);
			  $mdlDt = $objMdl->funGetModelInfo($rows->model_id);
		?>
		<td width="525" class="small_offers_bg">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><img src="images/spacer.gif" width="1" height="5" /></td>
            </tr>
            <tr>
              <td colspan="2"><span class="offer_model"><?php echo $mkDt['CategoryName']." ".$mdlDt['SubCatName'] ?></span></td>
            </tr>
            <tr>
              <td colspan="2" class="offer_model_dis"><?php echo $rows->offer_varient ?><br />              </td>
            </tr>
            <tr>
              <td colspan="2"><img src="images/spacer.gif" width="1" height="5" /></td>
            </tr>
            <tr>
              <td rowspan="2">
			  	<?php if($rows->offer_image != ''){?>
				<img src="offers/<?php echo $rows->offer_image?>" width="115" height="75" class="car-image-pad"/>
				<?php }else{?>
				<img src="images/car_no_image.jpg" width="115" height="75" class="car-image-pad"/>
				<?php }?>
			  </td>
              <td><span class="offer_price">&pound;<?php echo $rows->offer_price ?><br />
              </span><span class="per_month">per month</span></td>
            </tr>
            <tr>
              <td><a href="enquiry.php?offer_id=<?php echo $rows->offer_id?>"><img src="images/more.jpg" width="108" height="24" border="0" class="more_buttton1" /></a></td>
            </tr>
            <tr>
              <td colspan="2"><img src="images/spacer.gif" width="1" height="7" /></td>
            </tr>
        </table></td>
		  <?php 
		   if($cnt==2){
				$cnt=0;
				echo "</tr>";
				echo "<tr><td valign=\"top\" height=\"1\" colspan=\"2\"><img src=\"images/spacer.gif\" width=\"20\" height=\"10\" /></td></tr>";
				echo "<tr>";
			}
			$cnt++;
			}
		?>
      </tr>
	 
      <tr>
        <td colspan="2"><img src="images/spacer.gif" width="20" height="10" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle" class="type1"><?php echo $pagelinks?></td>
      </tr>
    </table>
	<!-- body content end here -->
	
	</td>
    <td valign="top"><img src="images/spacer.gif" alt="spacer" width="4" height="10" /></td>
    <td valign="top"><?php include("includes/right-include.php")?></td>
    <td width="10"><img src="images/spacer.gif" alt="spacer" width="15" height="1" /></td>
  </tr>
  
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#C0C0C0"><img src="images/spacer.gif" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="7">
	<?php include("includes/footer-include.php")?>
	</td>
  </tr>
</table>
</body>
</html>
