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
else{
	echo "<script>location='signin.php';</script>";
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
	$tags.="$row[10],";
	$count-=1;
}


?>

<html>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="navbar_static.css"/>
<style>
#blog{
	margin:20px;
}

td{
	border-left:2px solid white;
	border-right:2px solid white;
	
}

th{
	border:2px solid white;
}

table{
	width:94%;
	border:2px solid white;
	margin-left:3%;
	margin-right:3%;
	border-collapse:collapse;
}

.tabs{
	background:transparent;
	border:1px solid white;
	color:white;
	width:10%;
	height:5%;
}

</style>

<body>
<div class="navbar_main" id="navbar">
	
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

<br><br><br><br>

<div class="blog">
<pre>     <button class="tabs" onclick="switch_tabs(0)">Users</button> <button class="tabs" onclick="switch_tabs(1)">Feedbacks</button></pre>
<br><br>
<div id="user_table">
<?php
$fetch_qry="SELECT * FROM `users`";
$fetch_data=mysqli_query($con,$fetch_qry);
echo "<table><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>Password</th></tr>";
while($row=mysqli_fetch_array($fetch_data)){
	echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td><button id='mtBtn' onclick='modal_open(\"$row[4]\")'>$row[4]</button></td><td>$row[5]</td></tr>";
}
?>

</table>
</div>

<div style='font-size:100%;display:none;' id="feedbacks">
<?php
$fetch_qry="SELECT * FROM `feedbacks`";
$fetch_data=mysqli_query($con,$fetch_qry);
while($row=mysqli_fetch_row($fetch_data)){
	$feedback_text=wordwrap(nl2br($row[3]),122);
	echo "<pre>  <a href='mailto:$row[2]'>$row[1]</a>: 
  $row[4]
  
  $feedback_text</pre>";
}
?>
</div>

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
tags=tags.filter((v,i) => tags.indexOf(v) == i);
var ip=document.getElementById("search_text");
autocomplete(ip,tags);



function switch_tabs(x){
	if(x==0){
		document.getElementById('user_table').style="display:block;color;";
		document.getElementById('feedbacks').style="display:none;";
	}
	else{
		document.getElementById('feedbacks').style="display:block;";
		document.getElementById('user_table').style="display:none;";
	}
}


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
