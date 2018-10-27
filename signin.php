<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>alert('Already logged in.');location='index.php';</script>";
}
?>

<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>
#main_div{
	background-color:rgb(255,255,255);
	width:40%;
	margin-left:30%;
	margin_right:30%;
	color:darkblue;
	font-size:125%;
	font-weight:bold;
	border-radius:5%;
}

#signin_submit{
	visibility:hidden;
	width:100%;
}

#signin_submit_btn{
	background-color:transparent;
	background-image:url("login_button.png");
	background-size:100% 100%;
	border:0;
	color:white;
	width:15%;
	height:4%;
	
}

input.login_form{
	width:98%;
	height:5%;
	margin-left:1%;
	margin-right:1%;
	padding-left:0.5%;
}



</style>

<body>
<div class="navbar_main" id="navbar">
	
	<div class="navbar_sub" id="navbar_logo"><img id="logo" src='logo_transparent.png'/></div>
	<a href="index.php"><div class="navbar_sub" id="navbar_sitename">De_Blog</div></a>
	<a href="signin.html"><div class="navbar_sub" id="navbar_sign">Sign In/Register</div></a>
	<a href=""><div class="navbar_sub" id="navbar_contactus">Contact Us </div></a>
	<div class="navbar_sub" id="navbar_search">
		<form name="search" method="POST"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button> <input type="text" name="search_text"/>
		</form>
	</div>
	
</div>

<br><br><br><br><br><br><br><br><br><br>

<div id='main_div'>
	<h1><center>Sign In</center></h1>
<pre>
<form id='login_form' method='POST' action='signin_success.php'>
 Username
<input class='login_form' type='text' name='username' placeholder='Username'/>

 Password
<input class='login_form' type='password' name='password' placeholder='Password'/>

 <button id='signin_submit_btn'><input id='signin_submit' type='submit'/></button>
</form>
 Not a member? <a href='register.php'>Click Here</a> to register.
 
</pre>

</div>
</body>
</html>