<?php
session_start();
$username=$_SESSION['username'];
if($username==''){
	echo "<script>location='signin.php';</script>";
}

$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

$id=$_GET['id'];
$inc=$_GET['inc'];

$fetch_qry="SELECT * FROM `blogs` WHERE id='$id'";
$row=mysqli_fetch_row(mysqli_query($con,$fetch_qry));
$likes=$row[6];

if($inc==0){
	echo "<span style='margin:0px;color:white;font-weight:bold;font-size:120%;'>$likes</span>";
}
else{
	if(strpos($row[7],$username)==''){
		$user_likes=$row[7].",".$username;
		$likes+=1;
		$update_qry="UPDATE `blogs` SET likes='$likes',user_likes='$user_likes' WHERE id='$id'";
		mysqli_query($con,$update_qry);
	}
	echo "<span style='margin:0px;color:white;font-weight:bold;font-size:120%;'>$likes</span>";
}
?>