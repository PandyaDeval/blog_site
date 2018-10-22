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

<?php
$con=mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"de_blog") or die("Cannot conenect to database.");
$id=$_GET["id"];
$fetch_qry="SELECT * FROM `blogs` WHERE id=$id";
$data=mysqli_fetch_row(mysqli_query($con,$fetch_qry));
$ext_description=wordwrap(nl2br($data[3]),135);
?>

<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>
#blog{
	margin:20px;
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

<div id="blog"/>
<?php
		echo "<center>
			<img src='$data[4]' style='width:500px;height:500px;'/><br><br>
			<h1>$data[1]</h1>
		</center><br>
		<h3>$data[5] ( +5:30 GMT )</h3><br>
		<h2><pre>$ext_description</pre></h2>
		<br><br>
		<h3><pre>$data[6] Likes       $data[7] Comments</pre></h3>
		";	
	?>
</div>
</body>
</html>




