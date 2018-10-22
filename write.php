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
?>

<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>
#blog{
	margin:20px;
}
#dashboard_navbar{
	position:fixed;
	width:20%;
	height:25%;
	top:20%;
	right:0;
	background-color:purple;
	text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

div.dashboard_navbar_sub{
	position:fixed;
	width:20%;
	right:0;
	font-weight:bold;
	color:white;
	font-size:150%;
	text-align:center;
}

#write{
	top:22%;
}

#edit{
	top:30%;
}

#delete{
	top:38%;
}

#write_submit{
	display:none;
	width:100%;
}

#write_submit_btn{
	background-color:green;
	background-size:100% 100%;
	border:0;
	color:white;
	width:15%;
	height:5%;
	text-align:center;
	font-size:125%
}


input.write_blog_form{
	width:98%;
	height:5%;
	margin-left:1%;
	margin-right:1%;
	padding-left:0.5%;
}

#write_form{
	font-size:125%;
	font-weight:bold;
	color:green;
}

textarea{
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
	<a href="signin.php"><div class="navbar_sub" id="navbar_sign">Sign In/Register</div></a>
	<a href=""><div class="navbar_sub" id="navbar_contactus">Contact Us </div></a>
	<a href="dashboard.php"><div class="navbar_sub" id="navbar_username"></div></a>
	<a href="logout.php"><div class="navbar_sub" id="navbar_logout">Logout</div></a>
	<div class="navbar_sub" id="navbar_search">
		<form name="search" method="POST"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button> <input type="text" name="search_text"/>
		</form>
	</div>
	
</div>

<br><br><br><br>

<div id='dashboard_navbar'>
	<a href='write.php'><div class='dashboard_navbar_sub' id='write'>Write Blog</div></a>
	<a href='edit.php'><div class='dashboard_navbar_sub' id='edit'>Edit Blog</div></a>
	<a href='delete.php'><div class='dashboard_navbar_sub' id='delete'>Delete Blog</div></a>
</div>

<h1><center><font style='color:green;text-decoration:underline;'>Write a Blog</font></center></h1><br>
<pre><form id='write_blog' action='write_success.php' method='POST'>
  Title<font style='color:red;'>*</font>
  
<input class='write_blog_form' type='text' name='fname' placeholder='Blog Title'/>
	
  Short Description<font style='color:red;'>*</font>
  
<input class='write_blog_form' type='text' name='lname' placeholder='Short Description'/>
	
  Long Description<font style='color:red;'>*</font>
  
<textarea class='write_blog_form' name='email' placeholder='Long Description'></textarea>
	
  Image Link<font style='color:red;'>*</font>
  
<input class='write_blog_form' type='text' name='imagelink' placeholder='Image Link'/>
	
  
  <button id='write_submit_btn'><input type='submit' id='write_submit'/>Create!</button>
	
</form>
</pre>