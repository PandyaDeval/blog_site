<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>
#navbar{
	position:fixed;
	transition:0.4s;
	width:100%;
	height:100%;
	top:0px;
	background-color:grey;
}

div.navbar_sub{
	position:fixed;
	top:1.2%;
	display:inline-block;
	font-weight:bold;
	color:white;
	font-size:150%;
}

#logo{
	height:40px;
	width:40px;
}

#navbar_logo{
	top:0.9%;
	left:1.6%;
}

#navbar_sitename{
	left:4.5%;
}

#navbar_sign{
	left:14%;
}

#navbar_contactus{
	left:28%;
}

#navbar_search{
	right:4%;
}

#navbar_back{
	display:inline-block;
	transition:0.4s;
	width:100%;
	height:100%;
	postion:absolute;
}

#submit{
	visibility:hidden;
	width:100%;
}

#submitbtn{
	background-color:transparent;
	background-image:url("search_button.png");
	background-size:100% 100%;
	border:0;
	color:white;
	width:30px;
	height:30px;
	
}
</style>
<script>
function xyz(){
	element=document.getElementById("navbar");
	image=document.getElementById("navbar_back");
	//element.innerHTML=document.body.scrollTop;
	if(document.body.scrollTop>80){
		element.style="height:50px;";
		image.style="visibility:hidden;";
	}
	else{
		element.style="height:100%;";
		image.style="visibility:visible;";
	}
}
</script>
<body onscroll="xyz()" style='padding:0px;margin:0px;'>

<div class="navbar_main" id="navbar">
	
	<img id="navbar_back" src="home_navbar4.jpg"/>
	<div class="navbar_sub" id="navbar_logo"><img id="logo" src='logo_transparent.png'/></div>
	<a href="index.php"><div class="navbar_sub" id="navbar_sitename">De_Blog</div></a>
	<a href="signin.php"><div class="navbar_sub" id="navbar_sign">Sign In/Register</div></a>
	<a href=""><div class="navbar_sub" id="navbar_contactus">Contact Us </div></a>
	<div class="navbar_sub" id="navbar_search">
		<form name="search" method="POST"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button> <input type="text" name="search_text"/>
		</form>
	</div>
	
</div>

<br><br><br><br><br><br><br><br><br><br>


<pre>
asdasd

absa
absa

absa
absa


absa
absa
abs
absa
absa
absa
abs
absa
abs
absa
absa
abs
absa
abs




















































aaaa
</pre>
<div id="footer"></div>
</body>
</html>

<?php
session_start();
$_SESSION["username"]="";
$_SESSION["password"]="";
?>