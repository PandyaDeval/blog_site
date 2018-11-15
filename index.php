<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>
			var x = setTimeout(verify_login,5);
			function verify_login(){
			document.getElementById('navbar_logout').style='visibility:visible;';
			document.getElementById('navbar_username').innerHTML='$username';
			if('$username'=='admin'){
				document.getElementById('username_link').href='admin_home.php';
			}
			else{
				document.getElementById('username_link').href='dashboard.php';
			}
		}
	</script>";
}

$con=mysqli_connect("localhost","root","") or die("Can't connect to server.");
mysqli_select_db($con,"de_blog") or die("Create a database first.");

if(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `blogs`"));
	$count=$count[0];
}


$fetch_qry="SELECT * FROM `blogs`";
$fetch_data=mysqli_query($con,$fetch_qry);
$tags='';
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	$tags.="$row[1],";
	$count-=1;
}

/*if(mysqli_query($con,"SELECT COUNT(*) FROM `users`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `users`"));
	$count=$count[0];
}


$fetch_qry="SELECT * FROM `users`";
$fetch_data=mysqli_query($con,$fetch_qry);
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	$tags.="$row[4],";
	$count-=1;
}*/
?>
<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>

.modal {
    display: none;
    position: fixed; 
    z-index: 1; 
    padding-top: 100px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 90%; 
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.6); 
}


.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
	color:black;
	height:70%;
	border-radius:5%;
}

iframe{
	width:90%;
	margin-left:5%;
	margin-right:5%;
	border:0;
	height:100%;
}

#mtbtn{
	background-color:black;
	border:0;
	text-decoration:underline;
	font-weight:bold;
	color:blue;
	font-family:comic sans ms;
	font-size:125%;
}

body{
	font-weight:bold;
	background:url('body_back.jpg') no-repeat fixed;
	color:white;
	padding:0px;
	margin:0px;
	font-family:comic sans ms;
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
	font-size:140%;
}

div.navbar_sub:hover{
	color:lightgreen;
	text-decoration:underline;
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
	height:100%;
	margin-left:5%;
	margin-right:5%;
	font-size:125%;
	background-color:black;
	padding-top:2%;
	padding-bottom:2%;
	border-radius:5%;
	font-family:comic sans ms;
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
	border-radius:7%;
}

#welcome_title{
	text-shadow: 3px 3px blue, -3px -3px orange, 3px -3px green, -3px 3px yellow;
	color:lightblue;
}
#welcome{
	opacity:0;
	position:fixed;
	width:50%;
	top:20%;
	left:10%;
	font-family:brush script mt;
	font-size:300%;
	display:inline-block;
}
#welcome.welcome_trans{
	opacity:1;
	position:fixed;
	width:50%;
	top:20%;
	left:37%;
	transition:1.5s;
	transition-timing-function:ease-in-out;
}

#to{
	opacity:0;
	position:fixed;
	width:50%;
	top:20%;
	right:-35%;
	font-family:brush script mt;
	font-size:300%;
}
#to.to_trans{
	opacity:1;
	position:fixed;
	width:50%;
	top:20%;
	right:-7%;
	transition:1.5s;
	transition-timing-function:ease-in-out;
}

#deblog{
	opacity:0;
	position:fixed;
	width:50%;
	bottom:5%;
	left:34%;
	font-family:brush script mt;
	font-size:400%;
}
#deblog.deblog_trans{
	opacity:1;
	position:fixed;
	width:50%;
	bottom:35%;
	left:34%;
	transition:1.5s;
	transition-timing-function:ease-in-out;
}

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
  color:red;
}

.autocomplete-items {
  position: absolute;
  background-color:black;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 50%;
  width:83%;
  left: 16%;
  right: 0;
  color:red;
  font-size:50%;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #000000; 
  border-bottom: 1px solid #ffffff; 
  
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: DodgerBlue !important; 
  
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
  
}

#contact_form{
	z-index:5;
	position:fixed;
	top:10%;
	left:20%;
	width:60%;
	height:55%;
	background-color:#888;
	border-radius:5%;
}

.contact_form_ip{
	background-color:transparent;
	color:white;
	border:0;
	border-bottom:2px solid black;
}
.contact_form_ip::placeholder{
	color:white;
}
</style>
<script>
var x = setTimeout(show,5);

function show(){
	document.getElementById("welcome").classList.add("welcome_trans");
	document.getElementById("to").classList.add("to_trans");
	document.getElementById("deblog").classList.add("deblog_trans");
}
function xyz(){
	contents=document.getElementById("contents");
	navbar=document.getElementById("navbar");
	image=document.getElementById("navbar_back");
	welcome_title=document.getElementById("welcome_title");
	//element.innerHTML=document.body.scrollTop;
	if(document.body.scrollTop>80){
		navbar.style="height:50px;";
		image.style="visibility:hidden;";
		welcome_title.style="display:none;";
	}
	else{
		element.style="height:100%;";
		image.style="visibility:visible;";
		welcome_title.style="opacity:1;";
	}
}

</script>

<body onscroll="xyz()">

<div class="navbar_main" id="navbar">
	
	<img id="navbar_back" src="home_navbar4.jpg"/>
	<div class="navbar_sub" id="navbar_logo"><img id="logo" src='logo_transparent.png'/></div>
	<a href="index.php"><div class="navbar_sub" id="navbar_sitename">De_Blog</div></a>
	<a href="signin.php"><div class="navbar_sub" id="navbar_sign">Sign In/Register</div></a>
	<a onclick="display_contact(1)"><div class="navbar_sub" id="navbar_contactus">Contact Us </div></a>
	<a id="username_link" href="dashboard.php"><div class="navbar_sub" id="navbar_username"></div></a>
	<a href="logout.php"><div class="navbar_sub" id="navbar_logout">Logout</div></a>
	<div class="navbar_sub" id="navbar_search">
		<form autocomplete="off" method="GET" action="search.php"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button><input type="text" id="search_text" name="search_text"/>
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
	echo "<div class='blog' id='blog$row[0]'><center>
		<img style='width:400px;height:400px;' src='$row[4]'/><br><br>
		$row[5]<br>
		Author: <button id='mtBtn' onclick='modal_open(\"$row[9]\")'>$row[9]</button><br><br>
		<h2>$row[1]</h2><br>
		<div id='short_desc$row[0]'>$row[2]<br><br><a class='read_more' href='blog_detailed.php?id=$row[0]'>Read more...</a></div>
		</center>
	</div><br><br><br>";
	$count-=1;
}

?>

<div style="display:none;" id="contact_form">
<button style='color:white;font-size:150%;margin-right:3%;margin-top:2%;background:transparent;border:0;float:right;' onclick='display_contact(0)'>&times;</button><br><br><br>
<center>
<form autocomplete="off" action="index.php" method="POST">
<input class="contact_form_ip" type='text' placeholder="Enter Name" name="contact_name"/><br><br>
<input class="contact_form_ip" type='text' placeholder="Enter Email" name="contact_email"/><br><br>
<textarea style="width:50%;height:40%;" class="contact_form_ip" placeholder="Enter Feedback" name="contact_feedback"></textarea><br><br>
<input style="background-color:black;color:white;width:10%;height:10%;" type="submit"/>
</form>
</center>
</div>

<div id="welcome_title">
<h1>
<div id="welcome">
Welcome
</div>
<div id="to">
to
</div>
<div id="deblog">
De_Blog!
</div>
</h1>
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

function modal_open(username) {
	iframe.src="author_description.php?username="+username;
    modal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += '<input type="hidden" value="' + arr[i] + '">';
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*initiate the autocomplete function on the "search_text" element, and pass along the countries array as possible autocomplete values:*/
var tags="<?php echo $tags;?>".split(',');
var ip=document.getElementById("search_text");
autocomplete(ip,tags);


function display_contact(x){
	event.preventDefault();
	if(x==1){
		document.getElementById('contact_form').style="display:block;"
	}
	else{
		document.getElementById('contact_form').style="display:none;"
	}
}
</script>

</html>

<?php

@$contact_name=$_POST['contact_name'];
@$contact_email=$_POST['contact_email'];
@$contact_feedback=addslashes($_POST['contact_feedback']);
if($contact_name!='' and $contact_email!='' and $contact_feedback!=''){
	$insert_qry="INSERT INTO `feedbacks`(`name`,`email`,`feedback`) VALUES('$contact_name','$contact_email','$contact_feedback')";
	if(mysqli_query($con,$insert_qry)){
		echo "<script>alert('Feedback submitted successfully. We will reach out to you soon.');</script>";
	}
	else{
		echo "<script>alert('Feedback could not be submitted.');</script>";
	}
}
?>

