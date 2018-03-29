<head>
<style>
	body {
		font-family: Arial;
		font-size: 10pt;
	}
	
	table {
		font-family: Arial;
		font-size: 10pt;
		border:1px solid #DDD;
	}
	
	th {
		background: #F5F5F5;
		border-bottom:1px solid #DDD;
	}
	
	table tr {
	background-color: #FFF;
	}

	table tr:hover {
	background-color: #f5f5f5;
	}
	
	table td {
		border-bottom:1px solid #DDD;
	}
	
</style>
</head>

<body>

<?
include ("offhead.php");

include("../dbinfo.inc.php");
mysql_connect("213.171.219.91",$username,$password);

$query="UPDATE offers SET 
pic='{$_GET['ud_pic']}',
make='{$_GET['ud_make']}',
model='{$_GET['ud_model']}',
product='{$_GET['ud_product']}',
initial='{$_GET['ud_initial']}',
term='{$_GET['ud_term']}',
mileage='{$_GET['ud_mileage']}',
maint='{$_GET['ud_maint']}',
stock='{$_GET['ud_stock']}',
pch='{$_GET['ud_pch']}',
rental='{$_GET['ud_rental']}',
comms='{$_GET['ud_comms']}',
co2='{$_GET['ud_co2']}',
mpg='{$_GET['ud_mpg']}',
expire='{$_GET['ud_expire']}',
source='{$_GET['ud_source']}' WHERE id='{$_GET['ud_id']}'";

@mysql_select_db($database) or die( "Unable to select database");
mysql_query($query);

echo "Offers Updated";

mysql_close();
?>