<?php
session_start();
$username=$_SESSION['username'];
if($username!=''){
	echo "<script>
			var x = setTimeout(verify_login,10);
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
	$tags.="$row[10],";
	$count-=1;
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





