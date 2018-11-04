<?php
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

if(mysqli_query($con,"SELECT COUNT(*) FROM `users`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `users`"));
	$count=$count[0];
}


$fetch_qry="SELECT * FROM `users`";
$fetch_data=mysqli_query($con,$fetch_qry);
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	$tags.="$row[4],";
	$count-=1;
}

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
		<form autocomplete="off" name="search" method="POST"> 
			 <button id="submitbtn"><input type="submit" id="submit"/></button> <input type="text" id="search_text" name="search_text"/>
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
<script>
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

</script>
</html>
 