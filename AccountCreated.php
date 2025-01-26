<!DOCTYPE html><!-- -->
<html>

<header id="header" >
<link rel="stylesheet" type="text/css" href="PRStyle.css">
<script type="text/javascript" src="PRjavascript.js"></script>


<title>Account Created-Polaris Retreats</title>

<a href="Homepage.php">
<img id="logo" src="images/PRLogo.png" width="90px"  style="float: left"/> 
</a>
<a href="Cart.php">
<img id="logo" src="images/ShoppingCart.png" width="50px"  style="float: right"/>
</a>
<p id="accountLinks" <?php 
if(isset($_COOKIE["customer"])){
	echo "hidden";
}
?>>
<a href="RegisterAccount.php">
Register Account
</a>
|
<a href="SignIn.php">
Sign In
</a>
</p>
<?php 
if(isset($_COOKIE["customer"])){
	$customerName = "select FirstName from customer where email ='".$_COOKIE["customer"]."'";
	include('dbConnection.php');
	$getName = mysqli_query($db, $customerName);
	while($row = mysqli_fetch_assoc($getName)){
	echo "<p id=\"accountLinks\">Welcome back ".$row["FirstName"]."! | ".
	"<a href=\"SignedOut.php\">Sign Out</a></p>";
	}

}
?>



</header>




<body>
<div id="sidebar">
		<div id="nav">
			<ul>
				<li><a href="HotelSearch.php">Hotels</a></li>
				</br>
				<li><a href="Spas.php">Spas</a></li>
				</br>
				<li><a href="Restraunts.php">Dining experiences</a></li>
				</br>
				<li><a href="Contents.php">Contents</a></li>
				</br>
				<li><a href="Report.php">Report</a></li>
				<?php
				if(isset($_COOKIE["customer"])){if($_COOKIE["customer"] != 'admin@pr.com'){$hasAccess=False;}else{$hasAccess=True;}}else{$hasAccess = False;}
				if($hasAccess){
					echo "</br>
				<li><a href=\"Admin.php\">Admin</a></li>";
				}
				?>
			</ul>
		</div>
</div>
<div class="main">
<h1 id="title">Create your Polaris Retreats account</h1>



<p id="bodyText">
<?php
include('dbConnection.php');
$emailAlreadyUsed = "SELECT Email FROM customer WHERE Email = '".mysqli_real_escape_string($db,$_POST["email"])."'";
$dupeTest = mysqli_query($db, $emailAlreadyUsed);
if(mysqli_num_rows($dupeTest)!=0){
	echo "This E-mail address is already in use. Try another or simply sign in.";
}
else{
	$checkForAddress = "select id from address where BuildingName ='".mysqli_real_escape_string($db,$_POST["BuildingName"]).
	"' and CityName ='".mysqli_real_escape_string($db,$_POST["CityName"]).
	"'and Country='".mysqli_real_escape_string($db,$_POST["Country"]).
	"' and PostCode='".mysqli_real_escape_string($db,$_POST["PostCode"]).
	"'and StreetName='".mysqli_real_escape_string($db,$_POST["StreetName"])."'";
	$addressCheck = mysqli_query($db, $checkForAddress);
	if(mysqli_num_rows($addressCheck)==0){
	$in2AddressQ = "insert into address (BuildingName,CityName,Country,PostCode,StreetName) values ('".
	mysqli_real_escape_string($db,$_POST["BuildingName"])."','".mysqli_real_escape_string($db,$_POST["CityName"])."','".mysqli_real_escape_string($db,$_POST["Country"])."','".
	mysqli_real_escape_string($db,$_POST["PostCode"])."','".mysqli_real_escape_string($db,$_POST["StreetName"])."')";
	$in2Address = mysqli_query($db, $in2AddressQ);
	$addressCheck = mysqli_query($db, $checkForAddress);
	
	while($AddID= mysqli_fetch_assoc($addressCheck)){
	$addressID = $AddID["id"];
	}
	
	
	}
	else{
		while($AddID = mysqli_fetch_assoc($addressCheck)){
		$addressID = $AddID["id"];
		}
	}
	$insertCustomer = "insert into customer (Email,AddressID,FirstName,Gender,Password,PhoneNo,SecondName) values ('".
	mysqli_real_escape_string($db,$_POST["email"])."',".$addressID.",'".mysqli_real_escape_string($db,$_POST["firstName"]).
	"','".mysqli_real_escape_string($db,$_POST["gender"])."','".mysqli_real_escape_string($db,$_POST["password"])."','".
	mysqli_real_escape_string($db,$_POST["PhoneNo"])."','".mysqli_real_escape_string($db,$_POST["secondName"])."')";
	$insertIn2Cust = mysqli_query($db, $insertCustomer);
	$cookName = "customer";
	$customerEmail =  mysqli_real_escape_string($db,$_POST["email"]);
	setcookie($cookName,$customerEmail);
	echo "Thank you for signing up with Polaris Retreats";
}
?>


</p>







</div>
<footer id="footer">
<strong>Polaris Retreats</strong><small> copyright 2020</small> 
<a href="https://www.instagram.com/"><img id="logo" src="images/instagram.png" width="30px"/></a>

<a href="https://twitter.com/search-home?lang=en-gb"><img id="logo" src="images/twitter.png" width="30px" /></a>

<a href="https://en-gb.facebook.com/"><img id="logo" src="images/facebook.png" width="30px" /></a>

</footer>
</body>





</html>
