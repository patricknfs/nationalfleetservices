<script language="JavaScript" type="text/JavaScript">
function isEmail(str){
	var at="@";
	var dot=".";
	var lat=str.indexOf(at);
	var ldot=str.indexOf(dot);
	var lstr=str.length;
	
	if(str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		return false;
	}
	if(str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		return false;
	}
	if(str.indexOf(" ")!=-1){
		return false;
	}
	if(str.indexOf(at,(lat+1))!=-1){
		return false;
	}
	if(str.indexOf(dot,(lat+2))==-1){
		return false;
	}
	if(str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		return false;
	}
	return true;
}
function validateForm(getID){
	if(getID=='1'){
		if(isEmail(document.getElementById('emailID').value)==false){
			alert("Please Enter a valid Email Address");
			document.getElementById('emailID').focus();
			return false;
		}
	}
	return true;
}
</script>
<table width="200" border="0" cellspacing="0" cellpadding="0">
      <!--<tr>
        <td><a href="javascript:void(0);" onClick="javascript: window.open('live-chat.htm','','width=350,height=250')"><img src="images/chatonline.jpg" alt="Chat online" width="200" height="60" /></a></td>
      </tr>-->
      

      <tr>
        <td>
		<!-- Call me back starts -->
		<div style="font-size: 18px; font-weight: bold; line-height:20px; text-align: center; border:0px;">Tel: 0121 45 45 645<br />
		</div><div style="text-align: center; border:0px;"><a href="http://www.bvrla.co.uk/" target="_blank"><img src="/images/bvrla.png" width="187" height="85" alt="BVRLA Member | 1463" /></a></div>
		<!--<form action="thanks.php?p=quick_contact" method="get" id="Quick_Contact" name="quick_contact" onsubmit="javascript: return validateCallme();">
			<input type="hidden" name="quick_contact" value="QUICK" />
			<p class="callmeback">Call Me Back</p>
			<input name="fullname" type="text" class="textfield" value="Full Name" onFocus="if(this.value=='Full Name') this.value='';" onBlur="if(this.value=='') this.value='Full Name';"/>
			<input name="phone" type="text" class="textfield" id="textfield1" value="Contact Number" onFocus="if(this.value=='Contact Number') this.value='';" onBlur="if(this.value=='') this.value='Contact Number';" />
			<input name="enter" type="image" class="enter" id="searchbtn" src="images/enter.jpg" />
		</form>-->		
		<!-- Call me back starts -->
		</td>
      </tr>
      <tr>
     		<td>
      		</td>
      </tr>
      <tr>
        <td class="login-bg">
		<div  style="padding-left:20px; padding-top:5px;">
			<form action="thanks.php"  method="post" name="search" id="search">
			<input type="hidden" name="securityKey" value="NEWS">
			<p class="signup">Subscribe to Our Newsletter  </p>
			<p class="plogin"> Enter your e-mail address here:</p>
			<input name="emailID" type="text" class="textfield1" id="emailID"/>
			<!--<p class="plogin">Password :</p>
			<input name="textfield" type="password" class="textfield1" value="Full Name" /> -->
			<p class="bttn">
			<input name="nsltr" type="image" class="enter1" id="nsltr" src="images/enter.jpg" onClick="return validateForm('1');" />
			</p>
			<!--<span class="newuser">New User ?  <a href="#">Click to Sign Up</a> </span><br />
			<span class="newuser">Forgot Password ? <a href="#">Click Here</a> </span> -->
			</form>
		</div>		</td>
      </tr>
		<tr>
			<td><img src="images/spacer.gif" width="20" height="5" /></td>
		</tr>
      <tr>
        <td class="product">Useful Highlights </td>
      </tr>
      <tr>
        <td><ul class="matterul">
          <li class="matter"><a href="complaints.php">Complaints</a></li>
          <li class="matter"><a href="Driver-License-Checking.php">Drivers License Check</a></li>
          <!--<li class="matter"><a href="http://www.direct.gov.uk/en/environmentandgreenerliving/actonco2/DG_067197?cids=Google_PPC&amp;cre=CO2Cal" target="_blank" rel="nofollow">Go Green</a></li>
          <li class="matter"><a href="#">Car Finance Flow Chart</a></li> -->
          <li class="matter"><a href="proposalforms.php">Download Proposal Form</a></li>
          <li class="matter"><a href="Vehicle-Safety-Tests.php">Vehicle Safety Tests</a></li>
          <!-- <li class="matter"><a href="Model-Launch-Calendar.php">Model Launch Calender</a></li> -->
        </ul></td>
      </tr>
	  	<tr>
			<td><img src="images/spacer.gif" width="20" height="5" alt="Contract Hire" /></td>
		</tr>
        <tr>
          <td align="left"><img src="images/customer.jpg" alt="Customer's Testimonial" width="200" height="61" /></td>
        </tr>
      <tr>
        <td align="left" class="customer">
			<p>
			"Dear David,<br /><br />

			 We have been dealing with yourself and Fleet Street for the past 10 years. Over that period of time you have always tried you hardest to satisfy all our requirements.</p><br />
			 <p>The service and the prices you supply are always the best in the market place. Can I personally thank you and your Company for your support."
</p>
			<br /></td>
      </tr>
	  	<tr>
			<td><img src="images/spacer.gif" width="20" height="5"  alt="Contract Hire"/></td>
		</tr>
    </table>
