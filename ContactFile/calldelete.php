<?php

$host="127.0.0.1";
$user="root";
$pass="";
$db="us2";
$conn = mysql_connect($host,$user,$pass);
$fnames=$_POST['fnames'];   
if(! $conn ) 
{
 die('Could not connect: ' . mysql_error());
}
else
{
mysql_select_db($db);
session_start();
$query = "DELETE FROM contactme WHERE firstname='".$fnames."'";
$retval = mysql_query( $query, $conn );
if($retval>=1)
echo "Records were deleted successfully.";
else
echo "ERROR: Could not able to execute $sql. " . mysql_error();


}
?>