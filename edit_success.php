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

$id=$_SESSION['id'];
$_SESSION['id']='';

$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

$title=addslashes($_POST['title']);
$short_desc=addslashes($_POST['short_desc']);
$long_desc=addslashes($_POST['long_desc']);
$imagelink=$_POST['imagelink'];
if($imagelink==''){
	$imagelink='http://sheffieldhatters.com/wp-content/uploads/2017/06/Afrobarometer-default-graphic-blog-banner.jpg';
}

$update_qry="UPDATE `blogs` SET title='$title', short_description='$short_desc', long_description='$long_desc', image_link='$imagelink' WHERE id='$id'";
if(mysqli_query($con,$update_qry)){
	echo "<script>alert('Blog editted successfully!');location='dashboard.php';</script>";
}
?>