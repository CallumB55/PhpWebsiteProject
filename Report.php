<!DOCTYPE html><!-- -->
<html>

<header id="header" >
<link rel="stylesheet" type="text/css" href="PRStyle.css">
<script type="text/javascript" src="PRjavascript.js"></script>


<title>Report-Polaris Retreats</title>

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
<h1 id="title">Polaris Retreats Report</h1>




<p id="bodyText" >
Polaris Retreats website report by Callum Binns<br>
 <br>
Navigation and general style<br>
The overall format for each page is a header, sidebar and fixed footer. Help with various alignments came from this page (www.w3schools.com,b, n.d.). The header carries links to login and sign out on the right, with links to the users shopping cart in the shape of a real supermarket shopping trolly. This is similar to Amazon.com, one of the worlds largest online market places. This is important as Jakobs law (Neilsen, 2019) can be summarized as meaning that your website should emulate others that your users will likely have used to allow them to apply layout knowledge they have learned from elsewhere. The header has the logo at the top left, which also like Amazon, Premier Inn and Tesco; goes back to the homepage. <br>
The sidebar has links to other pages in the website, these links darken on mouse hover. This aids in the ‘Visibility of system status’ (Nielsen, 2017) which is the first heuristic for user interface design. Showing the user that the website is ready to respond to their input, is reassuring and proves the site is working. The admin option is only visible when logged in as an ‘admin’.<br>
In the footer is the specified name and copyright information as well as links at the bottom right to social media. There was a problem with this footer for UX however. Setting an absolute position of the bottom of the webpage seemed to produce a small gap. On less populated webpages it became clear that this gap was as a result of the footer going to the bottom of the body of the page, lower than the sidebar. No solution was found to have it sit at the bottom of small pages and wait off-screen at the bottom of large ones. The compromise developed was a kind of viewing ‘window’ for the user. Whereby all content on the site is viewed through the header, footer and sidebar. This has some benefits in the way it always provides the user with consistency as well as with constant access to familiar navigation, it also focusses their view to a smaller screen-space. However, it can feel claustrophobic on more populated pages such as the cart.<br>
As an added note each page has a title that describes that page’s function, allowing the user to easily navigate to the correct page should they have pages open across multiple tabs.<br>
All colour choices are intended to reflect the night sky. Whites and off-whites of the moon. A deep navy blue and black. This is appropriate as the company offers hospitality experiences in the north of England. Polaris is the north star and is easily identifiable in the night sky. Therefore all design choices feed into this idea.<br>
Homepage<br>
 The homepage is not as dynamic as intended. Attempts to automate the slideshow by making the image change on a timer failed. Should you set a Unix time in javascript and then continually check the time until it is equal to a number x-seconds greater then the script will break on attempting to check the time every tick. It seems javascript has no effective waiting function without downloading pre-made libraries which I did not want to do as this seemed a minor point. The user is still fully capable of pressing the greater than arrow to move the images along, these images will loop around when the final one is reached. This page also sets the standard for those to come, centre aligned white text with a larger font size for the header at the top of the page. The text on this page is a simple, welcoming mission statement.<br>
Hotels<br>
 This section starts with a simple form, asking questions that a potential customer should be able to answer with ease. It is likely they have searched for hotels in the area they are looking to say and have now chosen Polaris retreats. The lack of other text (outside of the familiar header, footer and sidebar) helps make the purpose of this page clear. This fits within Neilsen’s heuristic on ‘Aesthetic and minimalist design’ (Nielsen, 2017), only essential information is visible.<br>
Searching with this form then displays rooms in a list with plenty of relevant information. Each room is in a zebra striped block to make it clear to the user where one room offer ends and the next begins. They have access to general info like a description along the lines of ‘A country retreat in the Yorkshire Dales.’ As well as information on dining and spa experiences. The most important information; the room type and price appear first as well as an address. For users who have come to the site to buy rather than decide, it is important that they can compare at a glance. The prices have already been multiplied by the number of nights they requested to stay and room types that are fully booked at any point within the date range they request are not displayed. Also displayed is the number of rooms available of that type, giving them an idea of the kind of time pressure they are under to book the room before anyone else. At the bottom of each room (assuming the user is signed in) is displayed an ‘Add To Cart’ button, as is standard on many other sites. <br>
Dining experiences<br>
 The process for viewing these is even easier than viewing hotels rooms, while maintaining the overall appearance to keep consistency within the website. The user is requested no information and simply is displayed a list of all available dining experiences. The only information required before adding one of these to their cart is a date and time of booking. The user can select this very easily as they are presented with a HTML5 standard calendar and date selector of their choice, provided they use their browser often this will be familiar as it is the same across all websites they visit. This makes use of the ‘Consistency and standards’(Nielsen, 2017)  heuristic. <br>
Spas<br>
 The spa section is again the same as the restaurant and hotels section. Zebra striped options, all laid out and standard HTML date-time inputs. The difference being that the spa has a price. Also like the other categories, clicking add to cart actually redirects the user to another page as this was found to be the best way of manipulating the database. This requires some minor inconvenience in that the user must click ‘ok’ on the popup confirmation though they are quickly redirected to where they were before. This was achieved with the help of the W3Schools history back method tutorial (www.w3schools.com,c, n.d.). <br>
Cart<br>
 As the site is not expected to deal with transactions as well as not being overly sensitive to specific customer requests or the circumstances at the hotel at that time. It is assumed that booking will take place over the phone where a receptionist can better meet the customers need but where they can also look at the customers cart by requesting their email address over the phone and then looking at the database. Before making this phone call however, customers can review their cart and remove items where necessary. Clicking the remove button either removes one person if it is a spa or dining experience or the room if it is a room booking. The reason being that while spas and dining experiences serve many customers a room is a physical space which can only serve a single booking at a time, any bookings for later times are seen as distinct across all three categories. However, after removing something the user needs to see the change, a redirect tutorial was useful for this (www.w3schools.com,d, n.d.).  <br>
Sign in<br>
 The sign in page itself is straightforward. The user will input their email and password (or the admin details) and a cookie is set on their machine. This does not comply with EU data protection laws, as the user is not informed or asked.<br>
Register account<br>
 <br>
 To register an account the user must fill in a lengthy form. The data in this form is inserted into both the address and customer tables. Many fields make use of the required html attribute to ensure the user’s required details are correct. There is also a javascript function to check that both passwords are the same when submitted. The back end does not trust user inputs and (like some other areas of the site) makes use of ‘mysqli_real_escape_string’ in its procedural format, as learned at ((www.w3schools.com, a, n.d.)A failure of this section and the site is that plain text passwords are stored and used. There is little meaningful security around this.<br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 Bibliography<br>
www.w3schools.com. -a (n.d.). PHP mysqli real_escape_string() Function. [online] Available at: https://www.w3schools.com/php/func_mysqli_real_escape_string.asp.<br>
www.w3schools.com. -b (n.d.). CSS Layout - Horizontal & Vertical Align. [online] Available at: https://www.w3schools.com/css/css_align.asp.<br>
<br>
Neilsen, J. (2019). Jakob’s Law of Internet User Experience (Video). [online] Nielsen Norman Group. Available at: https://www.nngroup.com/videos/jakobs-law-internet-ux/.<br>
Nielsen, J. (2017). 10 Heuristics for User Interface Design: Article by Jakob Nielsen. [online] Nielsen Norman Group. Available at: https://www.nngroup.com/articles/ten-usability-heuristics/.<br>
www.w3schools.com. -c (n.d.). History back() Method. [online] Available at: https://www.w3schools.com/jsref/met_his_back.asp.<br>
www.w3schools.com. -d (n.d.). How To Redirect to Another Webpage. [online] Available at: https://www.w3schools.com/howto/howto_js_redirect_webpage.asp [Accessed 1 Dec. 2020].<br>
<br>
<br>




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
