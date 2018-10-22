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

$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

$title=addslashes($_POST['title']);
$short_desc=addslashes($_POST['short_desc']);
$long_desc=addslashes($_POST['long_desc']);
$imagelink=$_POST['imagelink'];

if($title!='' && $short_desc!='' && $long_desc!=''){
	$insert_qry="INSERT INTO `blogs`(`title`,`short_description`,`long_description`,`image_link`,`username`) VALUES('$title','$short_desc','$long_desc','$imagelink','$username')";
	if(mysqli_query($con,$insert_qry)){
		echo "<script>location='dashboard.php'</script>";
	}
}
else{
	echo "<script>alert('Title, Short Description and Long Description must be filled.');location='write.php';</script>";
}

?>