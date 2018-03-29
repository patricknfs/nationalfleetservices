<?

include("../dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM pchprop";
$result=mysql_query($query);

$num=mysql_numrows($result); 
mysql_close();


?>

<h1>PCH Proposals</h1>

<table cellspacing="0" cellpadding="5" style="border-collapse: collapse">
<tr> 
<th>ID</th>
<th align="left">Salesperson</th>
<th align="left">Funder</th>
<th align="left">Quote No</th>
<th>Title</th>
<th>First Name</th>
</tr>

<?
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id"); 
$salesperson=mysql_result($result,$i,"salesperson");
$funder=mysql_result($result,$i,"funder");
$quoteno=mysql_result($result,$i,"quoteno");
$titleSelect=mysql_result($result,$i,"titleSelect");
$firstname=mysql_result($result,$i,"firstname");
?>

<tr> 
<td><? echo "$id"; ?></td>
<td><? echo "$salesperson"; ?></td>
<td><? echo "$funder"; ?></td>
<td><? echo "$quoteno"; ?></td>
<td><? echo "$titleSelect"; ?></td>
<td><? echo "$firstname"; ?></td>
</tr>
<?
++$i;
} 
echo "</table>";
?>