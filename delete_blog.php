<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>
		window.onload = function verify_login(){
			document.getElementById('navbar_logout').style='visibility:visible;';
			document.getElementById('navbar_username').innerHTML='$username';
		}
	</script>";
}
else{
	echo "<script>location='signin.php';</script>";
}

$id=$_GET['id'];

$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

$delete_qry="DELETE FROM `blogs` WHERE id='$id'";
if(mysqli_query($con,$delete_qry)){
	echo "<script>alert('Blog deleted successfully.');location='dashboard.php';</script>";
}
?>