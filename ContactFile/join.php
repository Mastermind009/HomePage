<?php
header("Content-type: text/javascript"); 
if($_POST)
{
$host="127.0.0.1";
$user="root";
$pass="";
$db="us2";
$conn = mysql_connect($host,$user,$pass);
            
if(! $conn ) 
{
 die('Could not connect: ' . mysql_error());
}
mysql_select_db($db);
session_start();
if(isset($_POST['fname']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$birthday=$_POST['birthday'];
$email=$_POST['email'];
$mobno=$_POST['mobno'];
$company=$_POST['company'];

$query = "INSERT INTO contactme". "(firstname, lastname, birthday, company, email, mobno) ". "VALUES('$fname','$lname','$birthday','$company','$email','$mobno');";
$retval = mysql_query( $query, $conn );
            
if(! $retval ) {
 die('Could not enter data: ' . mysql_error());
}
else{
$query = "SELECT * FROM contactme"; //You don't need a ; like you do in SQL
$result = mysql_query($query);

echo "<table>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td>";  //$row['index'] the index here is a field name
echo '<td><input name="edit" class ="edit" type="button" value="Edit" onclick="edit(\''.$row['firstname'].'\',\''.$row['lastname'].'\',\''.$row['birthday'].'\',\''.$row['email'].'\',\''.$row['mobno'].'\',\''.$row['company'].'\')"></td>';
echo '<td><input name="delete" class="del" type="button" value="Delete" width="2em" onclick="del(\''.$row['firstname'].'\',\''.$row['lastname'].'\')"></td></tr>';
}

echo "</table>"; //Close the table in HTML

mysql_close();
}
}
}
else 
{ }

?>
<html>
<head>
<style>
.edit{
	margin-left : 50px;
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 2px 2px;
    cursor: pointer;
}
.del{
	margin-left : 20px;
    background-color: #f44336; /*RED */
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 2px 2px;
    cursor: pointer;
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<script type="text/javascript">
function edit(a,b,c,d,e,f)
{
	document.getElementById("firstname").value = a;
	document.getElementById("lastname").value = b;
	document.getElementById("birthday").value = c;
	document.getElementById("company").value = d;
	document.getElementById("email").value = e;
	document.getElementById("mobno").value = f;
	}

function del(p,q)
{
	dataString = 'fnames='+ p;
	$.ajax({
		
type: "POST",
url: "calldelete.php",
data: dataString,
success: function(data){
alert(data);

}
});
	
	}
	</script>
<body>

</body>
</html>