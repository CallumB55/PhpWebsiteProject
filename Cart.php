<!DOCTYPE html><!-- -->
<html>

<header id="header" >
<link rel="stylesheet" type="text/css" href="PRStyle.css">
<script type="text/javascript" src="PRjavascript.js"></script>

<title>Cart-Polaris Retreats</title>

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
<h1 id="title">Your cart</h1>



<p id="bodyText">
Please call us on 12345678 to book and pay. <br>To edit your add things to your cart you require an account.<br>Please have your account email address as well as your dietary information and requirements of any disabled clients who may be with you, so we can tailor our experience.
<form action="BookingConfirmation.php" method="post">
<ul>
<?php
include('dbConnection.php');
echo "<h2>Rooms</h2>";
if(isset($_COOKIE["customer"])){
$query = "SELECT c.id as cid, h.name as hotelName,r.roomType,h.CheckInTime,h.CheckOutTime,c.startDate,DATE_ADD(c.startDate, INTERVAL c.StayDuration DAY) as endDate, (r.Price * c.StayDuration) as price  from cart c inner join room r on c.RoomID= r.ID and c.RoomID is not null".
" and c.CustomerEmail ='".$_COOKIE["customer"].
"' inner join hotel h on r.HotelID = h.id";

$result = mysqli_query($db, $query);
$i = 0;
while($row = mysqli_fetch_assoc($result)){
	$i++;
	if($i % 2){
	echo "<li><div id=\"colour1\"><a>"; 
	}
	else{
	echo  "<li> <div id=\"colour2\"><a>";
	}
	echo "<h3>".$row['hotelName']." - ".$row['roomType']."</h3>".
	"<p>Check in:".$row["CheckInTime"]." Check out:". $row["CheckOutTime"]."<br>".
	"Start of stay:".$row["startDate"]." End of stay:".$row["endDate"].
	"<br>Price:£".$row['price']."<br></p>";	
	

	echo "
	<form action=\"RemoveFromCart.php\" method=\"post\">
	<input type=\"hidden\" name=\"cartID\" value=\"".$row["cid"]."\">".
	"<input id=\"removeFromCart \" type=\"submit\" value=\"Remove\">".
	"</form>";
	
	echo "</a></div></li>";
	}
	
	echo "<h2>Spa Experiences (these can also be booked at reception)</h2>";
	
	$query = "select c.SpaPackageID, max(h.name) as hotelName,max(s.PackageType) as PackageType, c.startDate as date,".
" max(s.Price)*COUNT(c.SpaPackageID) as price, COUNT(c.SpaPackageID) as numberOfPeople  from cart c inner join".
" spapackage s on c.SpaPackageID = s.id and c.CustomerEmail = '".$_COOKIE["customer"]
."' and c.SpaPackageID is not null inner join hotel h on h.id = s.HotelID group by c.SpaPackageID,c.startDate";

$result = mysqli_query($db, $query);
$i = 0;
while($row = mysqli_fetch_assoc($result)){
	$i++;
	if($i % 2){
	echo "<li><div id=\"colour1\"><a>"; 
	}
	else{
	echo  "<li> <div id=\"colour2\"><a>";
	}
	echo "<h2>".$row['hotelName']."</h2>".
	"<p>Date:".$row["date"]."<br> Experience:".$row["PackageType"].
	"<br>Number of people:".$row["numberOfPeople"].
	"<br>Price:£".$row['price']."<br></p>";	
	

	echo "
	<form action=\"RemoveSpaFromCart.php\" method=\"post\">
	<input type=\"hidden\" name=\"spaPackageID\" value=\"".$row["SpaPackageID"]."\">".
	"<input type=\"hidden\" name=\"date\" value=\"".$row["date"]."\">".
	"<input id=\"removeSpaFromCart \" type=\"submit\" value=\"Remove\">".
	"</form>";
	
	echo "</a></div></li>";
	}
	echo "<h2>Dining Experiences (these can also be booked at reception)</h2>";
	
	$query = "select c.RestrauntID, max(h.name) as hotelName,max(s.MealType) as MealType, max(c.startDate) as date, COUNT(c.RestrauntID) as numberOfPeople  from cart c inner join restraunt s on c.RestrauntID = s.id and c.CustomerEmail = '".
	$_COOKIE["customer"]."' and c.RestrauntID is not null inner join hotel h on h.id = s.HotelID group by c.RestrauntID";

$result = mysqli_query($db, $query);
$i = 0;
while($row = mysqli_fetch_assoc($result)){
	$i++;
	if($i % 2){
	echo "<li><div id=\"colour1\"><a>"; 
	}
	else{
	echo  "<li> <div id=\"colour2\"><a>";
	}
	echo "<h2>".$row['hotelName']."</h2>".
	"<br><p>Date:".$row["date"]."<br> Experience:".$row["MealType"].
	"<br>Number of people:".$row["numberOfPeople"].
	"<br></p>";	
	

	echo "
	<form action=\"RemoveRestrauntFromCart.php\" method=\"post\">
	<input type=\"hidden\" name=\"RestrauntID\" value=\"".$row["RestrauntID"]."\">".
	"<input type=\"hidden\" name=\"date\" value=\"".$row["date"]."\">".
	"<input id=\"removeRestrauntFromCart \" type=\"submit\" value=\"Remove\">".
	"</form>";
	
	echo "</a></div></li>";
	}
}
?>

</ul>
</form>
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
