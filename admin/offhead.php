<? // Important there are no spaces to line breaks here

error_reporting(E_ALL ^ E_NOTICE);

session_start();
include('../check.php');
check_login(1);
include('includes/functions.php');
?>

<a href="add.php">Add New</a> | 

<a href="multi_edit.php">Edit All</a> | 

<a href="index.php">View Offers</a> | 

<a href="logins.php">Manage Logins</a> |

<a href='../logout.php'>Logout (<?=$_SESSION['username'];?>)</a>

<br />

<hr />