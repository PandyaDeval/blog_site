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
?>
<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>

body{
	font-weight:bold;
	background-color:black;
	color:white;
	padding:0px;
	margin:0px;
}

#navbar{
	position:fixed;
	transition:0.7s;
	width:100%;
	height:100%;
	top:0px;
	background-color:darkblue;
	text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
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
	top:0.8%;
	left:1.6%;
}

#navbar_sitename{
	left:4.5%;
}

#navbar_sign{
	left:14%;
}

#navbar_contactus{
	left:29%;
}

#navbar_username{
	right:30%;
}

#navbar_logout{
	right:20%;
	visibility:hidden;
}

#navbar_search{
	right:4%;
}

#navbar_back{
	display:inline-block;
	transition:0.35s;
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

div.blog{
	display:block;
	width:90%;
	height:700px;
	margin-left:5%;
	margin-right:5%;
	font-size:125%;
}

input:focus{
	outline-style:none;
	border: 2px solid red;
}

input{
	border:1.5px solid black;
}

button:hover{
	cursor:pointer;
}

a.read_more{
	background-color:rgb(76,175,80);
	color:white;
	text-decoration:none;
	padding:5px;
	font-weight:bold;
}

</style>
<script>
function xyz(){
	contents=document.getElementById("contents");
	navbar=document.getElementById("navbar");
	image=document.getElementById("navbar_back");
	//element.innerHTML=document.body.scrollTop;
	if(document.body.scrollTop>80){
		navbar.style="height:50px;";
		image.style="visibility:hidden;";
	}
	else{
		element.style="height:100%;";
		image.style="visibility:visible;";
	}
}
</script>
<body onscroll="xyz()">

<div class="navbar_main" id="navbar">
	
	<img id="navbar_back" src="home_navbar4.jpg"/>
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
<br><br><br><br><br><br><br><br>
<?php
$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

if(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`"));
	$count=$count[0];
}

$fetch_qry="SELECT * FROM `blogs`";
$fetch_data=mysqli_query($con,$fetch_qry);
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "<div class='blog' id='blog$row[0]'>
		<img style='width:400px;height:400px;' src='$row[4]'/><br><br>
		$row[5]<br>
		Author: $row[8]<br><br>
		<h2>$row[1]</h2><br>
		<div id='short_desc$row[0]'>$row[2]<br><br><a class='read_more' href='blog_detailed.php?id=$row[0]'>Read more...</a></div>
	</div><br>";
	$count-=1;
}

?>
<div id="footer"></div>
</body>
</html>

