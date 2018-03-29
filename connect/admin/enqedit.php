<?
include('header.php');
?>

<script type="text/javascript" src="../calendar_db.js"></script>
<?php
/* Connecting, selecting database */
$link = mysql_connect('localhost', "fs-admin", "camp=Flam");
@mysql_select_db('db_fleetstreet')
   or die("Could not connect : " . mysql_error());

   
if (isset($_POST['submit'])):
  // The form has been submitted
  
  $en_no = $_POST['en_no'];
  if ($en_no == "") {
    $sql = "INSERT enquiries SET "; }
  else {
    $sql = "UPDATE enquiries SET ";
  }
  
  $en_ProposalType = $_POST['en_ProposalType'];
  $en_VehicleMake = $_POST['en_VehicleMake'];
  $en_VehicleModel = $_POST['en_VehicleModel'];
  $en_ContractTerm = $_POST['en_ContractTerm'];
  $en_ContractMileage = $_POST['en_ContractMileage'];
  $en_Maintenance = $_POST['en_Maintenance'];
  $en_ContractPayment = $_POST['en_ContractPayment'];
  $en_Comms = $_POST['en_Comms'];
  $en_ApplicantForenameName = $_POST['en_ApplicantForenameName'];
  $en_ApplicantSurname = $_POST['en_ApplicantSurname'];
  $en_ApplicantCompany = $_POST['en_ApplicantCompany'];
	$en_notes = mysql_real_escape_string ($_POST['en_notes']); 
  $en_ConciliumNo = $_POST['en_ConciliumNo'];
  $en_ArvalNo = $_POST['en_ArvalNo'];
	$en_OtherQuote = mysql_real_escape_string ($_POST['en_OtherQuote']); 
  $en_ApplicantTelephone = $_POST['en_ApplicantTelephone'];
  $en_ApplicantTelephone2 = $_POST['en_ApplicantTelephone2'];
  $en_ApplicantEmailAddress = $_POST['en_ApplicantEmailAddress'];
  $en_ApplicantEmail2 = $_POST['en_ApplicantEmail2'];
  $en_source = $_POST['en_source'];
  $en_reminder = $_POST['en_reminder'];
  $en_reminder_hour = $_POST['en_reminder_hour'];
  $en_mailing = $_POST['en_mailing'];
	$en_ReminderNote = mysql_real_escape_string ($_POST['en_ReminderNote']); 
  $en_stage = $_POST['en_stage'];
  $en_lost = $_POST['en_lost'];
  $en_archived = $_POST['en_archived'];
  $en_owner = $_POST['en_owner'];


  $sql .= "en_notes='$en_notes',
 en_ProposalType='$en_ProposalType',
 en_VehicleMake='$en_VehicleMake',
 en_VehicleModel='$en_VehicleModel',
 en_ContractTerm='$en_ContractTerm',
 en_ContractMileage='$en_ContractMileage',
 en_Maintenance='$en_Maintenance',
 en_ContractPayment='$en_ContractPayment',
 en_Comms='$en_Comms',
 en_ApplicantForenameName='$en_ApplicantForenameName',
 en_ApplicantSurname='$en_ApplicantSurname',
 en_ApplicantCompany='$en_ApplicantCompany',
 en_ConciliumNo='$en_ConciliumNo',
 en_ArvalNo='$en_ArvalNo',
 en_OtherQuote='$en_OtherQuote',
 en_reminder='$en_reminder',
 en_reminder_hour='$en_reminder_hour',
 en_ReminderNote='$en_ReminderNote',
 en_stage='$en_stage',
 en_lost='$en_lost',
 en_archived='$en_archived',
 en_ApplicantTelephone='$en_ApplicantTelephone',
 en_ApplicantTelephone2='$en_ApplicantTelephone2',
 en_ApplicantEmailAddress='$en_ApplicantEmailAddress',
 en_ApplicantEmail2='$en_ApplicantEmail2',
 en_source='$en_source',
 en_owner='$en_owner',
 en_timestamp=CURDATE()";
  if ($en_no <> "") {
    $sql .= " WHERE en_no=".$en_no;
  }


   if ($en_no <> "") {
    if (@mysql_query($sql)) {
	$wotsup = '<a href=enqedit.php?enqno='.$en_no.'>'.$en_no.'</a> Updated';
	header( "Location: enqlist.php?wotsup=$wotsup" );
  } else {
    die('<p>Error updating details for enquiry <b>' . $en_no . '</b> Error: ' . mysql_error() . ' SQL:'.$sql . '</p>');  }  }
  else {
    if (@mysql_query($sql)) {
	 $wotsup = 'Added';
     header( "Location: enqlist.php?wotsup=$wotsup" );
    } else {
      die('<p>Error inserting details for enquiry. Error:' . mysql_error() . ' SQL:'.$sql.'</p>');
    }
  }
?>

<?php

else: // Allow the user to edit the enquiry with en_no=$en_no

  $theowner = $_SESSION['username'];
  $en_no = $_GET['enqno'];

  $line=@mysql_query("SELECT *
                       FROM enquiries
                       WHERE en_no='$en_no'");
  if (!$line) {
    die('<p>Error fetching page text details: ' . mysql_error() . '</p>');
  }
  
  $pagetext = mysql_fetch_array($line, MYSQL_ASSOC);
  $en_ProposalType = $pagetext['en_ProposalType'];
  $en_ConciliumNo = $pagetext['en_ConciliumNo'];
  $en_VehicleMake = $pagetext['en_VehicleMake'];
  $en_VehicleModel = $pagetext['en_VehicleModel'];
  $en_ContractTerm = $pagetext['en_ContractTerm'];
  $en_ContractMileage = $pagetext['en_ContractMileage'];
  $en_Maintenance = $pagetext['en_Maintenance'];
  $en_ContractPayment = $pagetext['en_ContractPayment'];
  $en_Comms = $pagetext['en_Comms'];
  $en_ApplicantForenameName = $pagetext['en_ApplicantForenameName'];
  $en_ApplicantSurname = $pagetext['en_ApplicantSurname'];
  $en_ApplicantCompany = $pagetext['en_ApplicantCompany'];
  $en_ApplicantTelephone = $pagetext['en_ApplicantTelephone'];
  $en_ApplicantEmailAddress = $pagetext['en_ApplicantEmailAddress'];
  $en_ArvalNo = $pagetext['en_ArvalNo'];
  $en_OtherQuote = htmlspecialchars($pagetext['en_OtherQuote']);
  $en_notes = htmlspecialchars($pagetext['en_notes']);
  $en_ApplicantTelephone = $pagetext['en_ApplicantTelephone'];
  $en_ApplicantTelephone2 = $pagetext['en_ApplicantTelephone2'];
  $en_ApplicantEmailAddress = $pagetext['en_ApplicantEmailAddress'];
  $en_ApplicantEmail2 = $pagetext['en_ApplicantEmail2'];
  $en_source = $pagetext['en_source'];
  $en_editor = $pagetext['en_editor'];
  $en_reminder = $pagetext['en_reminder'];
  if ($en_reminder == 0) {$en_reminder = "";}
  $en_reminder_hour = $pagetext['en_reminder_hour'];
  $en_ReminderNote = htmlspecialchars($pagetext['en_ReminderNote']);
  $en_stage = $pagetext['en_stage'];
  $en_lost = $pagetext['en_lost'];
  $en_archived = $pagetext['en_archived'];
  $en_owner = $pagetext['en_owner'];
  
?>

<h3 class="grey">
<?=$en_ApplicantCompany?>&nbsp;-&nbsp;<?=$en_ApplicantForenameName?>&nbsp;<?=$en_ApplicantSurname?></h3>

<br /><br />

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="enquiry">
<table width="100%">

<tr><td class="enqlabel">Owner / Staus / Stage</td><td>
<?php

if($en_no == "") {
echo '<input type="text" name="en_owner" size="10" maxlength="20" value="'.$en_owner.'">';
} elseif($en_owner == ""){
echo '<a href="getowned.php?en_no='.$en_no.'">Claim</a>';
} else {
echo '<input type="text" name="en_owner" size="10" maxlength="20" value="'.$en_owner.'">';
};

?>
 / <select size="1" name="en_archived">
<?php
    if ($en_archived == 0) {
      echo ('<option value="0" selected>Live</option>');
      echo ('<option value="1">Archived</option>'); }
	else {
      echo ('<option value="0">Live</option>');
      echo ('<option value="1" selected>Archived</option>'); }
?>
</select>
 / 



    <script type="text/javascript">
        <!--
            function otherSelect() {
                var other = document.getElementById("otherBox");
                if (document.forms[0].en_stage.options[document.forms[0].en_stage.selectedIndex].value == "Lost") {
                    other.style.visibility = "visible";
                }
                else {
                    other.style.visibility = "hidden";
                }
            }
        //-->
    </script>


<select name="en_stage" id="en_stage" onchange="otherSelect()">
<?php
//Array of stages
$aStages = array("None", "Quote", "Prop", "Ordered", "Completed", "Lost");
$dbStage = $en_stage; // stored in database

foreach ($aStages as $en_stage)
{
if($en_stage == $dbStage) {
 echo "<option value=\"$en_stage\" selected>$en_stage</option>";
 } else
 {
  echo "<option value=\"$en_stage\">$en_stage</option>";
  }
}
?>
</select>




<div id="otherBox" style="visibility: hidden;">
<select name="en_lost" id="en_lost">
<?php
//Array of stages
$aLost = array("> Reason", "Price", "Product", "Resource", "Stock");
$dbLost = $en_lost; // stored in database

foreach ($aLost as $en_lost)
{
if($en_lost == $dbLost) {
 echo "<option value=\"$en_lost\" selected>$en_lost</option>";
 } else
 {
  echo "<option value=\"$en_lost\">$en_lost</option>";
  }
}
?>
</select>
</div>


</td></tr>
<tr><td>Reminder</td><td>

<input type="text" name="en_reminder" size="10" maxlength="10" value="<?=$en_reminder?>">

	<script type="text/javascript">
	new tcal ({
		'formname': 'enquiry',
		'controlname': 'en_reminder'
	});
	</script>
                <select size="1" name="en_reminder_hour">
                    <?php
                    for ($i = 0; $i <= 23; $i++)
                    {
                        if ($en_reminder_hour == $i) {
                    		echo ('<option value='.$i.' selected="selected">'.$i.'</option>');
                        }
                    	else {
                    		echo ("<option value=".$i.">".$i."</option>");
                    	}
                    }
                    ?>
                </select>
	</td></tr>
<tr><td>Reminder Note</td><td><input type="text" name="en_ReminderNote" size="67" maxlength="150" value="<?=$en_ReminderNote?>"></td></tr>

<tr><td>Prospect Source</td><td><input type="text" name="en_source" size="20" maxlength="100" value="<?=$en_source?>"></td></tr>

<tr><td colspan="2"><div id="liner"></div></td></tr>


<tr><td>Make / Model</td><td><input type="text" name="en_VehicleMake" size="20" maxlength="50" value="<?=$en_VehicleMake?>"><input type="text" name="en_VehicleModel" size="40" maxlength="50" value="<?=$en_VehicleModel?>"></td></tr>

<tr><td>Type / Term / MPA / Maint</td><td><input type="text" name="en_ProposalType" size="10" maxlength="20" value="<?=$en_ProposalType?>"><input type="text" name="en_ContractTerm" size="10" maxlength="25" value="<?=$en_ContractTerm?>"><input type="text" name="en_ContractMileage" size="10" maxlength="25" value="<?=$en_ContractMileage?>"><input type="text" name="en_Maintenance" size="10" maxlength="25" value="<?=$en_Maintenance?>"></td></tr>

<tr><td>Rental / Comms</td><td><input type="text" name="en_ContractPayment" size="10" maxlength="50" value="<?=$en_ContractPayment?>"><input type="text" name="en_Comms" size="10" maxlength="50" value="<?=$en_Comms?>"></td></tr>
<tr><td>Forename / Surname</td><td><input type="text" name="en_ApplicantForenameName" size="20" maxlength="50" value="<?=$en_ApplicantForenameName?>"><input type="text" name="en_ApplicantSurname" size="40" maxlength="50" value="<?=$en_ApplicantSurname?>"></td></tr>
<tr><td>Company</td><td><input type="text" name="en_ApplicantCompany" size="67" maxlength="50" value="<?=$en_ApplicantCompany?>"></td></tr>
<tr><td>Phone / Email</td><td><input type="text" name="en_ApplicantTelephone" size="20" maxlength="50" value="<?=$en_ApplicantTelephone?>"><input type="text" name="en_ApplicantEmailAddress" size="35" maxlength="50" value="<?=$en_ApplicantEmailAddress?>"><? if ($en_ApplicantEmailAddress <> '') {?><a title="Email <?=$en_ApplicantForenameName?>" href="mailto:<?=$en_ApplicantEmailAddress?>"><img alt="Send Email" valign="middle" src="../img/mail.png" /></a><?}else{}; ?></td></tr>
<tr><td>Phone2 / Email2</td><td><input type="text" name="en_ApplicantTelephone2" size="20" maxlength="50" value="<?=$en_ApplicantTelephone2?>"><input type="text" name="en_ApplicantEmail2" size="35" maxlength="50" value="<?=$en_ApplicantEmail2?>"><? if ($en_ApplicantEmail2 <> '') {?><a href="mailto:<?=$en_ApplicantEmail2?>"><img valign="middle" src="../img/mail.png" /></a><?}else{}; ?></td></tr>

<tr><td colspan="2"><div id="liner"></div></td></tr>


<tr><td>Reference No</td><td><input type="text" name="en_ConciliumNo" size="10" maxlength="20" value="<?=$en_ConciliumNo?>"></td></tr>
<tr><td>Quote No</td><td><input type="text" name="en_ArvalNo" size="10" maxlength="20" value="<?=$en_ArvalNo?>"></td></tr>
<tr><td>Other Quote Details</td><td><textarea rows="3" name="en_OtherQuote" cols="65" maxlength="252" ><?=$en_OtherQuote?></textarea></td>
</tr>
  
  
<tr><td><b>Notes</b></td><td><textarea rows="12" name="en_notes" cols="65" maxlength="500" ><?=$en_notes?></textarea></td></tr>


  </table>

  <input type="hidden" name="en_no" value="<?=$en_no?>" />
  <input type="submit" name="submit" id="submit" value="Submit" class="submitButton" />
</form>

<div id="liner"></div>

<?php 
  echo ('<p class=enqeditlist>Last updated: ' . $pagetext['en_timestamp'] .'</p>');
  
  reset($pagetext);
  while (list($result_nme, $result_val) = each($pagetext)) {
    echo('<p class=enqeditlist>'.substr($result_nme,3).':&nbsp;<b>'.$result_val.'</b></p>');
  }

  endif; 

?>

</div>

<div id="rightcolumn">

</div>

<div id="footer">

<? include('../footer.php'); ?>

</div>
</div>

</body>
</html>