<?php
session_start();
$con=mysqli_connect("localhost","root","") or die("Cannot Connect to server...");

mysqli_select_db($con,"de_blog") or die ("cannot connect to database.");

$username=$_POST['username'];
$password=$_POST['password'];

if($username!='' && $password!=''){
	$fetch_qry="SELECT * FROM `users`";
	$fetch_data=mysqli_query($con,$fetch_qry);
	if(mysqli_query($con,"SELECT COUNT(*) FROM `users`")){
		$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `users`"));
		$count=$count[0];
	}
	$flag=1;
	while($count>0){
		$row=mysqli_fetch_row($fetch_data);
		if($username==$row[4]){
			if($password==$row[5]){
				$flag=0;
				$_SESSION['username']=$username;
				echo "<script>location='dashboard.php';</script>";
			}
		}
		$count-=1;
	}
	if($flag){
		echo "<script>alert('Incorrect username or password. Please try again.');location='signin.php';</script>";
	}
}
else{
	echo "<script>alert('Incorrect username or password. Please try again.');location='signin.php';</script>";
}
?>