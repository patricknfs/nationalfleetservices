<?
check_login(1);
?>

<h4>New Enquiries</h4>
<table id="reminder">
	<tr>
        <th width="6%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_no" title="Click to sort on this column">ID</a>
        </th>
		<th width="17%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_timestamp" title="Click to sort on this column">Added</a>
        </th>
        <th width="44%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_ApplicantForenameName" title="Click to sort on this column">Enquirer</a>
        </th>
		<th width="23%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_VehicleMake" title="Click to sort on this column">Vehicle</a>
        </th>
        <th width="10%">
            <a href="enqlist.php?status=<?=$status?>&theowner=<?=$theowner?>&sortfield=en_owner" title="Click to sort on this column">Owner</a>
        </th>
    </tr>
    <?php
    
    while ($owners = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        echo ('<tr><td><a href="http://www.fleetstreetltd.co.uk/connect/admin/enquiry-'.$owners['en_no'].'">'.$owners['en_no'].'</a></td><td>'.date("d/m/y",strtotime($owners['en_timestamp'])).'</td><td><b>'.$owners['en_ApplicantCompany'].'</b>&nbsp;'.$owners['en_ApplicantForenameName'].'&nbsp;'.$owners['en_ApplicantSurname'].'</td><td>'.$owners['en_VehicleMake'].'</td><td><a onclick="return getowned();" href="getowned.php?en_no='.$owners['en_no'].'">Claim</a></td></tr>');
		
        echo ("\n");
    }
    ?>
</table>