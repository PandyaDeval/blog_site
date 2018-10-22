<?php
	
?>
<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>

#reg_submit{
	visibility:hidden;
	width:100%;
}

#reg_submit_btn{
	background-color:transparent;
	background-image:url("register_button.jpg");
	background-size:100% 100%;
	border:0;
	color:white;
	width:15%;
	height:5%;
	
}


input.reg_form{
	width:98%;
	height:5%;
	margin-left:1%;
	margin-right:1%;
	padding-left:0.5%;
}

#reg_form{
	font-size:125%;
	font-weight:bold;
	color:green;
}

</style>
<body>
<div class="navbar_main" id="navbar">
	
	<div class="navbar_sub" id="navbar_logo"><img id="logo" src='logo_transparent.png'/></div>
	<a href="index.php"><div class="navbar_sub" id="navbar_sitename">De_Blog</div></a>
	<a href="signin.php"><div class="navbar_sub" id="navbar_sign">Sign In/Register</div></a>
	<a href="contactus.html"><div class="navbar_sub" id="navbar_contactus">Contact Us</div></a>
	<div class="navbar_sub" id="navbar_search">
		<form name="search" method="POST"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button> <input type="text" name="search_text"/>
		</form>
	</div>
	
	
</div>
<br><br><br><br>

<h1><center><font style='color:green;text-decoration:underline;'>Register</font></center></h1><br>
<pre><form id='reg_form' action='reg_success.php' method='POST'>
  First Name<font style='color:red;'>*</font>
  
<input class='reg_form' type='text' name='fname' placeholder='First Name'/>
	
  Last Name<font style='color:red;'>*</font>
  
<input class='reg_form' type='text' name='lname' placeholder='Last Name'/>
	
  Email<font style='color:red;'>*</font>
  
<input class='reg_form' type='email' name='email' placeholder='Email'/>
	
  Username<font style='color:red;'>*</font>
  
<input class='reg_form' type='text' name='username' placeholder='Username'/>
	
  Password<font style='color:red;'>*</font>
  
<input class='reg_form' type='password' name='pass' placeholder='Password'/>
	
  Confirm Passowrd<font style='color:red;'>*</font>
  
<input class='reg_form' type='password' name='cnfpass' placeholder='Confirm Password'/>

	
  <button id='reg_submit_btn'><input type='submit' id='reg_submit'/></button>
	
</form>
</pre>

</body>
</html>
 