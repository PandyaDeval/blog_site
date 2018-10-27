<?php
$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

$username=$_GET['username'];

$fetch_qry="SELECT * FROM `users` WHERE username='$username'";
$row=mysqli_fetch_row(mysqli_query($con,$fetch_qry));

if($row[6]==1){
	$image_content="<img name='bgimage' src='data:image/png;base64,".base64_encode($row[7])."' width='50%' height='50%'/><br><br>";
}
else{
	$image_content="<img width='50%' height='50%' src='default_user.png'/><br><br>";
}
echo "<h2><center>
$image_content
Name: $row[1] $row[2]
<br><br>
E-mail: $row[3]
</center>
</h2>";
?>
