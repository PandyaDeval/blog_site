<?php
session_start();
$username=$_SESSION['username'];
if($username==''){
	echo "<script>location='signin.php';</script>";
}

$con=mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"de_blog") or die("Cannot conenect to database.");

$id=$_GET['id'];
$comment=addslashes($_POST['comment']);

$insert_qry="INSERT INTO `comments` VALUES('$id','$username','$comment')";
if(!mysqli_query($con,$insert_qry)){
	echo "<script>alert('Couldn\'t add comment');location='blog_detailed.php?id=$id';</script>";
	
}
else{
	echo "<script>location='blog_detailed.php?id=$id';</script>";
}

?>