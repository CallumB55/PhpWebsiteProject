<!DOCTYPE html><!-- -->
<html>

<header id="header" >
<link rel="stylesheet" type="text/css" href="PRStyle.css">
<script type="text/javascript" src="PRjavascript.js"></script>


<title>Edit Users-Polaris Retreats</title>

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
<h1 id="title">Polaris Retreats Edit Users</h1>




<p id="bodyText">
<?php
	if($_COOKIE["customer"] = 'admin@pr.com'){
	include('dbConnection.php');
	if(isset($_POST["removeUser"])){
		$removeQ = "delete from customer where Email='".$_POST["customers"]."'";
		$remove = mysqli_query($db, $removeQ);
		echo "<script type='text/javascript'>".
	"alert('User deleted.');".
	"window.location.replace(\"Admin.php\")".
	"</script>";
	}
	elseif(isset($_POST["changePsw"])){
		echo "<form action=\"ChangePassword.php\" method=\"post\">".
		"<label for=\"password\">Password:</label>".
		"<input type=\"password\" id=\"password\" name=\"password\" required>".
		"<label for=\"password2\">  Retype password:</label>".
		"<input type=\"password\" id=\"password2\" name=\"password2\" required><br>".
		"<input type=\"hidden\" name=\"email\" value=\"".$_POST["customers"]."\">".
		"<input type=\"submit\" value=\"Submit\" ></form>";
	}
	elseif(isset($_POST["getPsw"])){
		$selectQ = "select Password from customer where Email='".$_POST["customers"]."'";
		$select = mysqli_query($db, $selectQ);
	while($row = mysqli_fetch_assoc($select)){
		echo "<script type='text/javascript'>".
	"alert('This users password is:".$row["Password"]."');".
	"window.location.replace(\"Admin.php\")".
	"</script>";
	}
	}
	else{
	echo "<script type='text/javascript'>".
	"alert('User not found.');".
	"window.location.replace(\"Admin.php\")".
	"</script>";		
	}
	#$spaInfoQ = "select ID from spaPackage where PackageType='".$_POST["packagetype"]."' and HotelID='".$_POST["hid"]."' limit 1";
	#$spaInfo = mysqli_query($db, $spaInfoQ);
	#while($spa= mysqli_fetch_assoc($spaInfo)){
	#	$spaID = $spa["ID"];
	#}
	
	
	
	#$spa2CartQ = "Insert into cart (spaPackageID,CustomerEmail,startDate) Values (".$spaID.",'".$_COOKIE["customer"]."','".$_POST["startDate"]."')";
	#$spa2Cart = mysqli_query($db, $spa2CartQ);

	#echo "<script type='text/javascript'>".
	#"alert('Product added to cart.');".
	#"window.history.back();".
	#"</script>";
	}
	else{
		echo "<script type='text/javascript'>".
	"alert('This page can only be accessed by an admin.');".
	"window.location.replace(\"Homepage.php\")".
	"</script>";
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
