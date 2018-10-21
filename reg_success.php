<?php

$con=mysqli_connect("localhost","root","") or die("Cannot Connect to server...");
if(!mysqli_select_db($con,"de_blog")){
		mysqli_query($con,"CREATE DATABASE de_blog");
		mysqli_select_db($con,"de_blog");
}

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$username=$_POST['username'];
$pass=$_POST['pass'];
$cnfpass=$_POST['cnfpass'];

$fetch_qry="SELECT * FROM `users`";
if(!mysqli_query($con,$fetch_qry)){
	mysqli_query($con,"CREATE TABLE `de_blog`.`users` ( `id` INT NOT NULL AUTO_INCREMENT ,  `fname` VARCHAR(50) NOT NULL ,  `lname` VARCHAR(50) NOT NULL ,  `email` VARCHAR(255) NOT NULL ,  `username` VARCHAR(255) NOT NULL ,  `password` VARCHAR(1000) NOT NULL ,    PRIMARY KEY  (`id`))");
}
if($fname!='' && $lname!='' && $email!='' && $username!='' && $pass!='' && $cnfpass!=''){
	
	if(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`")){
		$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`"));
		$count=$count[0];
	}

	$fetch_data=mysqli_query($con,$fetch_qry);
	while($count>0){
		$row=mysqli_fetch_row($fetch_data);
		
		if($email==$row[3]){
			echo "<script>alert('Email has already been used before. Please Try Again...');location='register.php';</script>";
		}
		
		if($username==$row[4]){
			echo "<script>alert('Username has already been used before. Please Try Again...');location='register.php';</script>";
		}
		
		if($pass!=$cnfpass){
			echo "<script>alert('\'Password\' and \'Confirm Passwords\' fields do not match. Please Try Again...$cnfpass');location='register.php'</script>";
		}
		$count-=1;
	}

	$insert_qry="INSERT INTO `users`(`fname`,`lname`,`email`,`username`,`password`) VALUES('$fname','$lname','$email','$username','$pass')";
	mysqli_query($con,$insert_qry);
	echo "<script>alert('You have successfully registered!');window.location.assign('index.php');</script>";
	
}

else{
	echo "<script>alert('None of the fields should remain empty. Please try again...');location='register.php'</script>";
}
?>