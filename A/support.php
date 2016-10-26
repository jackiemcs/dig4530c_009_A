<?PHP
  require_once("includes/config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
<title>Stream Alley Support - Carmela San Diego</title>
<link href="css/reset.css" type="text/css" rel="stylesheet">
<link href="css/styles.css" type="text/css" rel="stylesheet">
<link rel="icon" href="img/favicon.png" type="image/gif">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
	<body>
		<div class="dancakes">
			<div id="sticky" class="section group">
				<div class="col span_4_of_12">
					<div id="logo">
						<a href='home.php'><img src="img/streamalley_logo.png" height="34" width="220" alt="website logo"></a>
					</div>
				</div>
				<div class="col span_4_of_12">
					<ul id="nav1">
						<li><a href='shop.php'>SHOP</a></li>
						<li><a href='packages.php'>PACKAGES</a></li>
						<li><a href='aboutus.php'>ABOUT</a></li>
						<li class="active"><a href='support.php'>SUPPORT</a></li>
					</ul>
				</div>
				<div class="col span_4_of_12">
					<ul id="account">
						<li>
							<div id="input_container">
							    <input type="text" id="input" placeholder="Search Stream Alley">
							    <img src="img/search2.png" height="25" width="25" alt="search icon" id="input_img">
							</div>
						</li>
						<li><a href='signin.php'>SIGN IN</a></li>
						<li><a href='viewcart.php'><img src="img/shoppingbag2.png" height="20" width="20" alt="shopping bag"></a></li>
					</ul>
				</div>
			</div>
			<div class="section group">
				<div class="col span_12_of_12">
					<div id="logo2">
						<a href='home.php'><img src="img/favicon.png" height="30" width="30" alt="website logo"></a>
					</div>
					<a href='viewcart.php'><img src="img/shoppingbag2.png" height="30" width="30" alt="shopping bag"></a>
					<div id="showmenu">
						<img src="img/menubutton.png" height="30" width="30" alt="menu button">
					</div>
					<div class="menu" style="display: none;">
					<ul id="nav2">
						<li><a href='shop.php'>SHOP</a></li>
						<li><a href='packages.php'>PACKAGES</a></li>
						<li><a href='aboutus.php'>ABOUT</a></li>
						<li><a href='support.php'>SUPPORT</a></li>
					</ul>
					</div>
				</div>
			</div>
			<div class="section group" style="padding-top:60px;">
				<div class="col span_12_of_12">
					<div class="categories">
						C U S T O M E R&nbsp;&nbsp;&nbsp;&nbsp;S U P P O R T
					</div>
					<hr>
				</div>
			</div>
			<div class="section group" style="padding-top:30px; padding-bottom:60px;">
				<div class="col span_3_of_12">
				</div>
				<div class="col span_3_of_12">
					<div id="aboutpic">
						<div id="aboutus">
						Please contact us for any questions or problems that you have regarding a product or a package that you purchased and we will be happy to entertain you. Answers to general questions can also be found on our <a href='#'><span>FAQ</span></a> page.
						<br>
						<br>
						<div class="contacttitle">
							LOCATION:
						</div>
						<div class="contactdesc">
							428 Lost Stars Ave. Portland, OR 97204
						</div>
						<br>
						<br>
						<div class="contacttitle">
							PHONE NUMBER:
						</div>
						<div class="contactdesc">
							1-866-STREAMALLEY
						</div>
						<br>
						<br>
						<div class="contacttitle">
							FOLLOW US
						</div>
						<div class="socmediaicons2">
							<a href='#'><img src="img/facebook.png" height="15" width="15" alt="facebook icon"></a>
							<a href='#'><img src="img/instagram.png" height="15" width="15" alt="instagram icon"></a>
							<a href='#'><img src="img/twitter.png" height="15" width="15" alt="twitter icon"></a>
							<a href='#'><img src="img/pinterest.png" height="15" width="15" alt="pinterest icon"></a>
						</div>
					</div>
					</div>
				</div>
				<div class="col span_1_of_12">
				</div>
				<div class="col span_4_of_12">
					<div class="contacttitle">
						EMAIL US:
					</div>
					<form>
					  <input type="text" name="firstname" placeholder="Name" class="contactemail">
					  <br>
					  <input type="text" name="lastname" placeholder="Email" class="contactemail">
					  <br>
					  <textarea type="text" name="message" id="contactmessage"></textarea>
					  <br>
					  <input type="button" value="Submit" class="allbutton">
					</form>
				</div>
				<div class="col span_1_of_12">
				</div>
			</div>
		</div>
		<footer>
				<div class="section group" style="background-color:#eeedea">
					<div class="col span_4_of_12">
						<div class="verticalLine">
								<div class="footertitle">
									FOLLOW US
								</div>
								<div class="socmediaicons">
									<a href='#'><img src="img/facebook.png" height="15" width="15" alt="facebook icon"></a>
									<a href='#'><img src="img/instagram.png" height="15" width="15" alt="instagram icon"></a>
									<a href='#'><img src="img/twitter.png" height="15" width="15" alt="twitter icon"></a>
									<a href='#'><img src="img/pinterest.png" height="15" width="15" alt="pinterest icon"></a>
								</div>
								<br>
								<hr>
								<br>
								<div id="footeraddress">
								428 Lost Stars Ave. Portland, OR 97204
								</div>
						</div>
					</div>
					<div class="col span_4_of_12">
						<div class="verticalLine">
							<div class="footertitle">
								GO TO
							</div>
							<div class="navitems">
								<a href='shop.php'>Shop</a>
								<br>
								<a href='packages.php'>Packages</a>
								<br>
								<a href='aboutus.php'>About Us</a>
								<br>
								<a href='support.php'>Support</a>
							</div>
						</div>
					</div>
					<div class="col span_4_of_12">
						<div class="footertitle">
							CUSTOMER CARE
						</div>
						<div class="navitems">
							<a href='#'>Track Order</a>
							<br>
							<a href='#'>Privacy Policy</a>
							<br>
							<a href='termsofserv.php'>Terms of Services</a>
							<br>
							<a href='#'>FAQ</a>
						</div>
					</div>
				</div>
				<div class="section group" style="background-color:#e6e6e2">
					<div class="col span_12_of_12">
						<div id="designedby">
							THIS SITE IS NOT OFFICIAL AND IS AN ASSIGNMENT FOR A UCF DIGITAL MEDIA COURSE. DESIGNED BY CARMELA SAN DIEGO. <span>#igotdrunkonmytears</span>
						</div>
					</div>
				</div>
			</footer>
	</body>
</html>