<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>
			var x = setTimeout(verify_login,10);
			function verify_login(){
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
$ext_description=wordwrap(nl2br($data[3]),122);
?>

<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>
#blog{
	margin:20px;
	font-family:comic sans ms;
	color:white;
	background-color:black;
	padding:2%;
	border-radius:5%;
}

pre{
	font-family:comic sans ms;
}

#cmt_submit{
	display:none;
	width:100%;
}

#cmt_submit_btn{
	background-color:green;
	background-size:100% 100%;
	border:0;
	color:white;
	width:5%;
	height:5%;
	text-align:center;
	font-size:100%
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
		<h3>$data[5] ( +5:30 GMT )<br><br>
		Author: <button id='mtBtn' onclick='modal_open(\"$data[9]\")'>$data[9]</button><br><br>
		<h2><pre>$ext_description</pre></h2>
		<br><br>
		";	
		
		if($username!=''){
			if(strpos($data[7],$username)==''){
				echo "<h3><pre><iframe src='likes.php?id=$id&inc=0' scrolling='no' style='padding:0px;overflow:hidden;width:40px;height:30px;'></iframe><button onclick='like()' style='border:0;width:40px;height:30px;background:none;'><img id='like_btn' style='width:100%;height:100%;' src='like.png'/></button>      <!--$data[7] Comments--></pre></h3>";
			}
			else{
				echo "<h3><pre><iframe src='likes.php?id=$id&inc=0' scrolling='no' style='padding:0px;overflow:hidden;width:40px;height:30px;'></iframe><button onclick='like()' style='border:0;width:40px;height:30px;background:none;'><img id='like_btn' style='width:100%;height:100%;' src='liked.png'/></button>      <!--$data[7] Comments--></pre></h3>";
			}
		}
?>

<h2>Comments:- </h2>

<form method='POST' action='comment_success.php?id=<?php echo $id;?>'>

<textarea placeholder='Add comment here' style='width:50%;height:10%;' name='comment'></textarea><br><br>
<button id='cmt_submit_btn'><input id='cmt_submit' type='submit'></input>Submit</button>

</form>
<?php

if(mysqli_query($con,"SELECT COUNT(*) FROM `comments` WHERE blog_id=$id")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `comments` WHERE blog_id=$id"));
	$count=$count[0];
}

$comment_qry="SELECT * FROM `comments` WHERE blog_id=$id";
$comment_data=mysqli_query($con,$comment_qry);
while($count>0){
	$row=mysqli_fetch_row($comment_data);
	$comment=wordwrap(nl2br($row[2]),122);
	echo "<button id='mtBtn' onclick='modal_open(\"$row[1]\")'>$row[1]</button>: 
	$comment<br><br>";
	$count-=1;
}
?>
</div>

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

var like_btn = document.getElementById("like_btn");

function modal_open(username) {
	iframe.src="author_description.php?username="+username;
    modal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function like(){
	var id="<?php echo $id;?>";
	var inc="1";
	like_btn.src='liked.png';
	iframe.src='likes.php?id='+id+'&inc='+inc;
	location='blog_detailed.php?id='+id;
}
</script>
</html>




