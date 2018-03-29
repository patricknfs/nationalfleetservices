<head>

<style>

.getquote button {margin-left:156px;}

button.submit {
    background-color: #68b12f;
    background: -webkit-gradient(linear, left top, left bottom, from(#68b12f), to(#50911e));
    background: -webkit-linear-gradient(top, #68b12f, #50911e);
    background: -moz-linear-gradient(top, #68b12f, #50911e);
    background: -ms-linear-gradient(top, #68b12f, #50911e);
    background: -o-linear-gradient(top, #68b12f, #50911e);
    background: linear-gradient(top, #68b12f, #50911e);
    border: 1px solid #509111;
    border-bottom: 1px solid #5b992b;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    box-shadow: inset 0 1px 0 0 #9fd574;
    -webkit-box-shadow: 0 1px 0 0 #9fd574 inset ;
    -moz-box-shadow: 0 1px 0 0 #9fd574 inset;
    -ms-box-shadow: 0 1px 0 0 #9fd574 inset;
    -o-box-shadow: 0 1px 0 0 #9fd574 inset;
    color: white;
    font-weight: bold;
    padding: 6px 20px;
    text-align: center;
    text-shadow: 0 -1px 0 #396715;
}

button.submit:hover {
    opacity:.85;
    cursor: pointer;
}
button.submit:active {
    border: 1px solid #20911e;
    box-shadow: 0 0 10px 5px #356b0b inset;
    -webkit-box-shadow:0 0 10px 5px #356b0b inset ;
    -moz-box-shadow: 0 0 10px 5px #356b0b inset;
    -ms-box-shadow: 0 0 10px 5px #356b0b inset;
    -o-box-shadow: 0 0 10px 5px #356b0b inset;
}

.getquote input:focus, .getquote textarea:focus, .getquote select:focus {
		background: #fff; 
		border:1px solid #555; 
		box-shadow: 0 0 3px #aaa; 
		padding-right:70px;
}


.getquote input, .getquote textarea, .getquote select { /* add this to the already existing style */
		border:1px solid #aaa;
		box-shadow: 0px 0px 3px #ccc, 0 10px 15px #eee inset;
		border-radius:2px;
		padding: 4px 60px 4px 4px;
		-moz-transition: padding .25s; 
		-webkit-transition: padding .25s; 
		-o-transition: padding .25s;
		transition: padding .25s;
}

td {
	padding: 5px 0 5px 0;
}

label {
	display: block;
	float: left;
	width: 200px;
}

#quotetable {
	border-right: 1px dotted #ccc;
	padding-right: 20px;
	float: left;
}

hr {
	height: 2px;
	border-top: 1px dotted #ccc;
	border-bottom: 0px;
	border-right: 0px;
	border-left: 0px;
}

:-moz-placeholder {
    color: #bbb;
}
::-webkit-input-placeholder {
    color: #bbb;
}

*:focus {outline: none;}

.getquote h2 {
    margin:0;
    display: inline;
}
.required_notification {
    color:#d45252;
    margin:5px 0 0 0;
    display:inline;
    float:right;
}

</style>

</head>

<?php
include("dbinfo.inc.php");
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

<form class="getquote" id="getquote" name="getquote" action="987654321.php">

<table id="quotetable" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2"><h2>Choose your lease options:</h2><span class="required_notification">* Denotes Required Field</span></td>
	</tr>
	<tr>
		<td><label for="name">Full Name: <span class="red">*</span></label></td>
		<td>
		<input name="name" id="name" placeholder="John Doe" autofocus="autofocus" type="text" />
		<span class="form_hint">Proper format "Sam Westley"</span>
		</td>
	</tr>
	<tr>
		<td><label for="company">Company:</label></td>
		<td><input name="company" placeholder="John Doe" type="text" /></td>
	</tr>
	<tr>
		<td><label for="phone">Telephone: <span class="red">*</span></label></td>
		<td><input name="phone" placeholder="John Doe" type="text" /></td>
	</tr>
	<tr>
		<td><label for="email">Email Address: <span class="red">*</span></label></td>
		<td><input name="email" placeholder="John Doe" type="text" /></td>
	</tr>
	

	<tr>
		<td colspan="2"><hr></td>
	</tr>
	
	<tr>
		<td><label for="make">Make:</label></td>
		<td><input name="make" type="text" value="<?php if(isset($make))
		{
		echo($make);
		} ?>" /></td>
	</tr>
	<tr>
		<td><label for="model">Model:</label></td>
		<td><input name="model" type="text" value="<?php if(isset($model))
		{
		echo($model);
		} ?>" /></td>
	</tr>
	
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	
	<tr>
		<td><label for="fitype">Lease Type <span class="red">*</span></label></td>
		<td><select name="fitype">
<option value="Not Selected" SELECTED>Please select your lease type</option>
<option value="business" <?php if(isset($fi)) { echo ($fi == "business") ? "selected" : ""; } ?>> Business</option>
<option value="personal" <?php if(isset($fi)) { echo ($fi == "personal") ? "selected" : ""; } ?>> Personal</option>
</select></td>



	</tr>
	<tr>
		<td><label for="term">Contract Term</label></td>
		<td><select name="term">
<option value="24" <?php if(isset($term)) { echo ($term == "24") ? "selected" : ""; } ?>> 24 Months</option>
<option value="36" <?php if(isset($term)) { echo ($term == "36") ? "selected" : ""; } ?>> 36 Months</option>
<option value="48" <?php if(isset($term)) { echo ($term == "48") ? "selected" : ""; } ?>> 48 Months</option>
<option value="60" <?php if(isset($term)) { echo ($term == "60") ? "selected" : ""; } ?>> 60 Months</option>
<option value="Cheapest" >Whichever is cheapest</option>
</select></td>
	</tr>
	<tr>
		<td><label for="mileage">Annual Mileage</label></td>
		<td><select name="mileage">
<option value="Not Selected" SELECTED>Annual Mileage *</option>
<option value="Less than 10,000" >Less than 10,000</option>
<option value="10000" <?php if(isset($mileage)) { echo ($mileage == "10000") ? "selected" : ""; } ?>> 10,000 miles per annum</option>
<option value="12500" <?php if(isset($mileage)) { echo ($mileage == "12500") ? "selected" : ""; } ?>> 12,000 miles per annum</option>
<option value="15000" <?php if(isset($mileage)) { echo ($mileage == "15000") ? "selected" : ""; } ?>> 15,000 miles per annum</option>
<option value="20000" <?php if(isset($mileage)) { echo ($mileage == "20000") ? "selected" : ""; } ?>> 20,000 miles per annum</option>
<option value="25000" <?php if(isset($mileage)) { echo ($mileage == "25000") ? "selected" : ""; } ?>> 25,000 miles per annum</option>
<option value="30000" <?php if(isset($mileage)) { echo ($mileage == "30000") ? "selected" : ""; } ?>> 30,000 miles per annum</option>
<option value="More than 30,000" >More than 30,000</option>
</select></td>
	</tr>
	<tr>
		<td><label for="maint">Monthly Maintenance</label></td>
		<td><select name="maint">
<option value="no" <?php if(isset($maint)) { echo ($maint == "no") ? "selected" : ""; } ?>>No</option>
<option value="yes" <?php if(isset($maint)) { echo ($maint == "yes") ? "selected" : ""; } ?>>Yes</option>
<option value="withwithout" >Quote with and without</option>
</select></td>
	</tr>

	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td><label for="additional">Additional Info:</label></td>
		<td><textarea name="additional" rows="6" cols="35" type="text" class="textarea"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><button class="submit" id="btn-submit" type="submit">Find Out More</button></td>
	</tr>
</table>
</form>









