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
$imagename=$_FILES['user_image']['name'];
$imagetmp=addslashes(file_get_contents($_FILES['user_image']['tmp_name']));
if($imagename==''){
	$image_bool=0;
}
else{
	$image_bool=1;
}


$fetch_qry="SELECT * FROM `users`";
if(!mysqli_query($con,$fetch_qry)){
	mysqli_query($con,"CREATE TABLE `de_blog`.`users` ( `id` INT NOT NULL AUTO_INCREMENT ,  `fname` VARCHAR(50) NOT NULL ,  `lname` VARCHAR(50) NOT NULL ,  `email` VARCHAR(255) NOT NULL ,  `username` VARCHAR(255) NOT NULL ,  `password` VARCHAR(1000) NOT NULL ,  `image_bool` INT NOT NULL,  `image` LONGBLOB,    PRIMARY KEY  (`id`))");
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

	$insert_qry="INSERT INTO `users`(`fname`,`lname`,`email`,`username`,`password`,`image_bool`,`image`) VALUES('$fname','$lname','$email','$username','$pass','$image_bool','$imagetmp')";
	mysqli_query($con,$insert_qry);
	session_start();
	$_SESSION["username"]=$username;
	echo "<script>alert('You have successfully registered!');location='dashboard.php';</script>";
	
}

else{
	echo "<script>alert('None of the fields should remain empty. Please try again...');location='register.php';</script>";
}
?>