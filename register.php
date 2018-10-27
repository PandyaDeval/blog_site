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
	background-image:url("register_button.png");
	background-size:100% 100%;
	border:0;
	color:white;
	width:13%;
	height:7%;
	
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
}

#background{
	margin:20px;
	font-family:comic sans ms;
	color:white;
	background-color:black;
	padding:2%;
	border-radius:5%;
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

<div id="background">
<h1><center><font style='text-decoration:underline;'>Register</font></center></h1><br>
<pre><form id='reg_form' action='reg_success.php' method='POST' enctype="multipart/form-data">
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

  Profile Picture  
<input class='reg_form' type='file' name='user_image'/>

	
  <button id='reg_submit_btn'><input type='submit' id='reg_submit'/></button>
	
</form>
</pre>
</div>

</body>
</html>
 