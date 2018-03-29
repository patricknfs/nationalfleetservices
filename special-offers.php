<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Title -->
<title>Car &amp; Van Leasing Special Offers - National Fleet Services</title>	
<meta name="description" content="Take a look at our top 10 Car & Van Leasing Special Offers – Call 0121 45 45 645 or visit our website" />
<meta name="keywords" content="cheap car lease, cheap van lease, cheap leasing, car leasing, van leasing, leasing offers" />

<!-- CSS -->

<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style.php" media="all" />

<!--[if lte IE 6]><style type="text/css">.divform label { margin-right: -3px; } .banner { margin-bottom:-30px;} .cornerfix-bottom, .cornerfix-top { background: none; } .homepage-top { margin-bottom: -8px;} .widget-top { margin-bottom: -10px; } div.controls a {background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control.gif") no-repeat center center;} div.controls a.activeSlide { background: url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/control-selected.gif") no-repeat center center;} .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } .dropdown-pages ul {width: 15.6em;}</style><![endif]-->
<!--[if lte IE 7]><style type="text/css">.divform input { margin-top: -1px; } .showcaseteaser { margin-left: 14px; } .showcase-buttons { padding-left: 20px; } .dropdown-pages li:hover ul, .dropdown-pages li.sfHover ul {	background:	#f1f1f1 url("http://www.wpcrave.com/wp6/wp-content/themes/concise2/images/droptop.gif") no-repeat top 0px; } </style><![endif]-->

<!-- Javascript -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script src="js/jquery-home-functions.js" type="text/javascript"></script>

<link rel='index' title='National Fleet Services' href='http://www.nationalfleetservices.net/' />

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
<body class="homebody"> 
<div style="width: 0px; height: 0px;"> <img alt="preload" style="display: none;" src="images/droptop.gif" /> 
</div> 
<div class="marginauto"><!-- ends in footer --><!--?php
include('menu.php');
?--> 
  
  <div class="post-bottom"> 
    <div class="post-top"></div> 
    <div class="post-wrap"> 
      <div class="post single"> <span style="display: none;" class="meta">1 Comment | Oct 15, 2010</span> <h1 class="entry-title">Car &amp; Van Leasing Special Offers</h1> 
        <div id="HomeOfferScroller"> 
          <div id="scrollItems"> <!--?
include("dbinfo.inc.php");
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM offers ORDER BY RAND() LIMIT 10";
$result=mysql_query($query);

$num=mysql_numrows($result); 

mysql_close();

?--> <!--?
$i=0;
while ($i &lt; $num) {
$pic=mysql_result($result,$i,"pic");
$make=mysql_result($result,$i,"make");
$model=mysql_result($result,$i,"model");
$stock=mysql_result($result,$i,"stock");
$product=mysql_result($result,$i,"product");
$initial=mysql_result($result,$i,"initial");
$term=mysql_result($result,$i,"term");
$mileage=mysql_result($result,$i,"mileage");
$maint=mysql_result($result,$i,"maint"); 
$pch=mysql_result($result,$i,"pch"); 
$rental=mysql_result($result,$i,"rental"); 
$co2=mysql_result($result,$i,"co2"); 
$mpg=mysql_result($result,$i,"mpg"); 
$source=mysql_result($result,$i,"source"); 
$id=mysql_result($result,$i,"id"); 
?--> 
            
            <div class="item"> 
              <div class="offerleft"> <!--?php if($stock == 1){
echo '<img @@end_of_comment';="" }="" ?&gt;<img="" $pic";="" ?="" class="stockribbon" src="images/stock-ribbon.png" />" alt="<!--? echo "$make"; ?--> Leasing Deal" title="<!--? echo "$make"; ?--> Leasing Deal" /&gt;
              
              </div> 
              <div class="offerright"> <h2><!--? echo "$make"; ?--></h2> <h3><!--? echo "$model"; ?--></h3> <h4 class="price">Our Price<br /><span class="rental"><a $id";="" ?="" href="forms/get-a-quote.php?id=%3C?%20echo">"&gt;£<!--? echo "$rental"; ?--></a></span>Per Month<span class="small">(+ VAT)</span></h4> 
                <div class="right"> <a $id";="" ?="" href="forms/get-a-quote.php?id=%3C?%20echo">" title="Contract Hire Offer, more details &gt;&gt;"&gt;<img width="127" height="47" src="images/btn_getquote.png" /></a> <br /> 
                  <ul> 
                    <li>Product: <b>Contract Hire</b></li> 
                    <li>Initial Rental: <b>£<!--? echo number_format(("$initial" * "$rental"), 2); ?--></b></li> 
                    <li>Term: <b><!--? echo "$term"; ?--> months</b></li> 
                    <li>Mileage: <b><!--? echo "$mileage"; ?--></b></li> 
                    <li><a href="http://www.nationalfleetservices.net/contact-us.php">Request Callback</a></li> 
                    <li><a $id";="" ?="" href="http://www.nationalfleetservices.net/forms/get-a-quote.php?id=%3C?%20echo">"&gt;Request Quote</a></li> 
                  </ul> 
                </div> 
              </div> 
              <div class="clearfix"></div> 
            </div> <!--?
++$i;
}

?--> 
          
          </div> 
          <div> 
            <div id="controls"> 
              <div id="pager"></div><a rel="nofollow" class="next">&gt;</a><!--<a title="View all our leasing special offers" class="view-all" href="special-offers.php">View all offers</a>//-->
            
            </div> 
          </div> 
        </div> <!--?
include("dbinfo.inc.php");
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM offers ORDER BY rental ASC";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();

$i=0;
while ($i &lt; $num) {
$pic=mysql_result($result,$i,"pic");
$make=mysql_result($result,$i,"make");
$model=mysql_result($result,$i,"model");
$stock=mysql_result($result,$i,"stock");
$product=mysql_result($result,$i,"product");
$initial=mysql_result($result,$i,"initial");
$term=mysql_result($result,$i,"term");
$mileage=mysql_result($result,$i,"mileage");
$maint=mysql_result($result,$i,"maint"); 
$pch=mysql_result($result,$i,"pch"); 
$rental=mysql_result($result,$i,"rental"); 
$co2=mysql_result($result,$i,"co2"); 
$mpg=mysql_result($result,$i,"mpg"); 
$id=mysql_result($result,$i,"id"); 

$smavehpic = substr("$pic", 0, -5) . "1.jpg";
$medvehpic = substr("$pic", 0, -5) . "2.jpg";

?--> 
        
        <div id="offer-box"> 
          <div class="pic-float"> <a $id";="" ?="" href="forms/get-a-quote.php?id=%3C?%20echo">"&gt;<!--?php if($stock == 1){
echo '<img @@end_of_comment';="" }="" ?&gt;<img="" width="150px" height="115px" $pic";="" ?="" class="stock-icon" src="images/stock-icon.png" />" /&gt;</a> 
          </div> <br /> <a $id";="" ?="" class="offer-make" href="forms/get-a-quote.php?id=%3C?%20echo">"&gt;<!--? echo "$make"; ?--></a> <br /> <span class="offer-model"><!--? echo "$model"; ?--></span> <br /> <a $id";="" ?="" class="offer-price" href="forms/get-a-quote.php?id=%3C?%20echo">"&gt;» £<!--? echo "$rental"; ?--> </a><span class="smallinline">Per Month (+ VAT)</span> <br /> 
          <p style="padding-left: 5px; font-size: 10px;">Lease Product: <b>Contract Hire</b></p> 
          <p style="padding-left: 5px; font-size: 10px;">Initial Rental: <b>£<!--? echo number_format(("$initial" * "$rental"), 2); ?--> (+ VAT)</b></p> 
          <p style="padding-left: 5px; font-size: 10px;">Term: <b><!--? echo "$term"; ?--> months</b> Mileage:<b><!--? echo "$mileage"; ?--> pa.</b></p> 
          <p>&nbsp;</p> 
          <div id="get-quote"> <a $id";="" ?="" href="forms/get-a-quote.php?id=%3C?%20echo">"&gt;Find out more</a> 
          </div> 
        </div> <!--?
++$i;
} 

?--> 
        
        <div style="clear: both;" class="entry-content"> <h3>Choose from our list of current special offers</h3> <h4>All special offers listed from cheapest to most expensive, not indlucing maintenance packages unless otherwise stated.</h4> 
          <p>Images for illustration purposes only. This flyer does not constitute an offer - E&amp;OE<br />A fee of £100 will be charged to business customers only*</p> <h6>Can't see the vehicle you're looking for?<br /> We supply all makes and models at industry leading prices - Call 0121 45 45 645 today for a business or personal quotation.</h6> 
        </div> 
      </div> 
    </div> 
  </div> 
  <div class="sidebar-wrap"> 
    <div id="recent-posts-32" class="widget widget_recent_entries"> <img src="images/why-choose-us.gif" /> 
    </div> 
  </div><!-- sidebar wrap end -->
</div><!-- /marginauto -->
<div class="footer"> 
  <div class="left"> 
    <li class="page_item page-item-21"><a title="Links" href="http://www.nationalfleetservices.net/terms-conditions.php">Terms &amp; Conditions</a></li> 
    <li class="page_item page-item-25"><b>Phone: </b>0121 45 45 645</li> 
    <li class="page_item page-item-23"><b>Email: </b><a href="mailto:info@nationalfleetservices.net">info@nationalfleetservices.net</a></li> 
  </div> 
  <div class="right">
  
  </div> 
  <div></div> 
</div> <br /> <!--?php
include('footer.php');
?--> </body></html>