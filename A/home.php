<?PHP
  require_once("includes/config.php");

  if($functions->CheckLogin())
  {
  	header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/client.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
<title>Stream Alley</title>
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
						<li><a href='support.php'>SUPPORT</a></li>
					</ul>
				</div>
				<div class="col span_4_of_12">
					<ul id="account">
						<li>
							<div id="input_container">
							    <form action="searchresult.php" method="GET">
							    	<input type="text" id="input" name="search" placeholder="Search Stream Alley">
							    	<input type="submit" value="Search">
								</form>
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
			<div class="section group">
				<div class="col span_12_of_12">
					<div class="img-wrapper">
						<div id="heroimage">
							<img src="img/heroimage3.jpg" alt="hero image">
						</div>
						<div class="img-overlay">
							<a href='shop.php'><button type="button" id="button_id">S H O P&nbsp;<span id="streamicon"><img src="img/favicon.png" height="35" width="35" alt="website logo"></span>&nbsp;N O W</button></a>
						</div>
					</div>
				</div>
			</div>
			<div class="section group" style="padding-top:30px">
				<div class="col span_1_of_12">
				</div>
				<div class="col span_10_of_12">
					<div id="discount">
					 	<span id="shopnow">SAVE 25% ON ALL DEVICE ACCESSORIES</span>|&nbsp;&nbsp;S H O P&nbsp;&nbsp;&nbsp;N O W
					</div>
				</div>
				<div class="col span_1_of_12">
				</div>
			</div>
			<div class="section group" style="padding-top:50px">
				<div class="col span_12_of_12">
					<div class="categories">
						T O D A Y ' S &nbsp;&nbsp;&nbsp;&nbsp; P I C K S
					</div>
				</div>
			</div>
			<div class="section group">
				<?php
					$functions->Featured();
				?>
			</div>

			<div class="section group" style="padding-top:150px">
				<div class="col span_12_of_12">
					<div class="categories">
						T O P &nbsp;&nbsp;&nbsp;&nbsp; F A V O R I T E S
					</div>
				</div>
			</div>
			<div class="section group" style="padding-bottom:100px">
				<?php
					$functions->Favorites();
				?>
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
