<!DOCTYPE html><!-- -->
<html>

<header id="header" >
<link rel="stylesheet" type="text/css" href="PRStyle.css">
<script type="text/javascript" src="PRjavascript.js"></script>

<title>Hotels-Polaris Retreats</title>

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
<h1 id="title">Polaris Retreats Hotels</h1>



<p id="bodyText">

<ul>
<?php
include('dbConnection.php');
$query = "SELECT max(h.id) as hid, max(h.Name) as name,max(h.CheckInTime) as CheckInTime,max(h.CheckOutTime) as CheckOutTime,
 max(h.Description) as Description,max(r.RoomType) as roomtype,
 max(r.Price*"
 . mysqli_real_escape_string ($db,$_POST["nightsStaying"]).
") as price,count(concat(h.ID,r.RoomType)) as numOfRooms,
concat(max(a.BuildingName),' ',max(StreetName),' ',max(CityName),' ',
max(PostCode)) as fullAddress FROM hotel h INNER join room r
 on h.ID = r.HotelID and r.id not in (select RoomID from roombooking WHERE (DateEnd >= '"
. mysqli_real_escape_string ($db, $_POST["startDate"]).
"') and (DateStart <= DATE_ADD('"
. mysqli_real_escape_string ($db,$_POST["startDate"]).
"', INTERVAL "
. mysqli_real_escape_string ($db,$_POST["nightsStaying"]).
" DAY)))
inner join address a on a.id = h.AddressID and h.Name = '"
. mysqli_real_escape_string ($db,$_POST["hotels"]).
"'    group by concat(h.ID,r.RoomType)";

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
	echo "<h3>".$row['name']."</h3>".
	"<p>".$row['roomtype']."    £".$row['price']."<br>Rooms available: ".$row['numOfRooms']."<br> Address:".$row['fullAddress']."<br>Check in time:".
	$row["CheckInTime"]." Check out time:".$row["CheckOutTime"].
	 "<br>Features:<br>".$row["Description"]."<br>";	
	$q2 = "select PackageType from spapackage where hotelID =". $row['hid'];

	$res2 = mysqli_query($db, $q2);
	while($r2 =mysqli_fetch_assoc($res2)){
		echo $r2["PackageType"]."<br>";
		}
	$q3 = "select MealType from restraunt where MealType like '%guest%' and hotelID =". $row['hid'];
	$res3 = mysqli_query($db, $q3);
	while($r3 =mysqli_fetch_assoc($res3)){
		echo $r3["MealType"]."<br>";
		}
	if(isset($_COOKIE["customer"])){

	echo "<form action=\"RoomAddedToCart.php\" method=\"post\"><input type=\"hidden\" name=\"roomtype\" value=\"".$row["roomtype"]."\">".
	"<input type=\"hidden\" name=\"hid\" value=\"".$row["hid"]."\">".
	"<input type=\"hidden\" name=\"nightsStaying\" value=\"".mysqli_real_escape_string ($db, $_POST["nightsStaying"])."\">".
	"<input type=\"hidden\" name=\"startDate\" value=\"".mysqli_real_escape_string ($db, $_POST["startDate"])."\">".
	"<input id=\"addToCart \" type=\"submit\" value=\"Add To Cart\"></form>";
	}
	echo "</a></div></li>";
	}

?>

</ul>

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
