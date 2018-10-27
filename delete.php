<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>
			var x = setTimeout(verify_login,5);
			function verify_login(){
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
	<a href='write.php' class='dashboard_navbar_sub' id='write'>Write Blog</a>
	<a href='edit.php' class='dashboard_navbar_sub' id='edit'>Edit Blog</a>
	<a href='delete.php' class='dashboard_navbar_sub' id='delete'>Delete Blog</a>
</div>

<?php
$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

if(mysqli_query($con,"SELECT COUNT(*) FROM `blogs` WHERE username='$username'")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `blogs` WHERE username='$username'"));
	$count=$count[0];
}

$fetch_qry="SELECT * FROM `blogs` WHERE username='$username'";
$fetch_data=mysqli_query($con,$fetch_qry);
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "<div class='blog' id='blog$row[0]'>
	<center>
		<img style='width:400px;height:400px;' src='$row[4]'/><br><br>
		$row[5]<br>
		Author: <button id='mtBtn' onclick='modal_open(\"$row[8]\")'>$row[8]</button><br><br>
		<h2>$row[1]</h2><br>
		<div id='short_desc$row[0]'>$row[2]<br><br><a class='read_more' href='delete_blog.php?id=$row[0]'>Delete Blog</a></div>
	</center>
	</div><br>";
	$count-=1;
}

?>

<div id="myModal" class="modal">

  <div class="modal-content">
    <iframe id="modal_iframe"></iframe>
  </div>

</div>

</body>

<script>
var modal = document.getElementById('myModal');

var btn = document.getElementById("myBtn");

var iframe = document.getElementById("modal_iframe");

function modal_open(username) {
	iframe.src="author_description.php?username="+username;
    modal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</html>