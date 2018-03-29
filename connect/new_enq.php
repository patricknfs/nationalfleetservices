<?
check_login(3);

?>

<h4>New Enquiries</h4>
<table id="reminder">
	<tr>
        <th width="6%">
            <a href="index.php?status=<?=$status?>&sortfield=en_no" title="Click to sort on this column">ID</a>
        </th>
		<th width="17%">
            <a href="index.php?status=<?=$status?>&sortfield=en_timestamp" title="Click to sort on this column">Added</a>
        </th>
        <th width="44%">
            <a href="index.php?status=<?=$status?>&sortfield=en_ApplicantForenameName" title="Click to sort on this column">Enquirer</a>
        </th>
		<th width="23%">
            <a href="index.php?status=<?=$status?>&sortfield=en_VehicleMake" title="Click to sort on this column">Vehicle</a>
        </th>
        <th width="10%">
            Owner
        </th>
    </tr>
    <?php
    
    while ($owners = mysql_fetch_array($result, MYSQL_ASSOC))
    {
	
	// If Company set then add syntax to $name
if ($owners['en_ApplicantCompany'] <> '') {
	$name2 = '<b>'.$owners['en_ApplicantCompany'].'</b>';
}else{
	$name2 = $owners['en_ApplicantForenameName'].' '.$owners['en_ApplicantSurname'];
};
	
        echo ('<tr><td><a href="http://www.fleetstreetltd.co.uk/connect/enquiry-'.$owners['en_no'].'">'.$owners['en_no'].'</a></td><td>'.date("d/m/y",strtotime($owners['en_timestamp'])).'</td><td>'.$name2.'</td><td>'.$owners['en_VehicleMake'].'</td><td><a onclick="return getowned();" href="getowned.php?en_no='.$owners['en_no'].'">Claim</a></td></tr>');
		
        echo ("\n");
    }
    ?>
</table>