<?PHP
  require_once("includes/config.php");

  if($functions->CheckLogin())
  {
  	if($_SESSION['user_access']="admin")
	{
		header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/admin.php");
	}
	elseif($_SESSION['user_access']="premium")
	{
		header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/premium.php");
	}
	else
	{
		header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/client.php");
	}
  }

  if(isset($_POST['submittedLogin']))
  {
	if($functions->Login())
	{
		if($_SESSION['user_access']="admin")
		{
			header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/admin.php");
		}
		elseif($_SESSION['user_access']="premium")
		{
			header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/premium.php");
		}
		else
		{
			header("Location: http://sulley.cah.ucf.edu/~dig4530c_009/A/client.php");
		}
    }
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
			<div class="section group" style="padding-top:60px">
				<div class="col span_12_of_12">
					<div class="categories">
						S I G N &nbsp;&nbsp;&nbsp;&nbsp;I N
					</div>
					<hr>
				</div>
			</div>
				<div class="section group" style="padding-top:60px margin-bottom:60px ">
					<div class="col span_4_of_12">
					</div>
					<div class="col span_4_of_12">
						<div class="loginform">
							<form id="LoginForm" action='<?php echo $functions->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
								<input type='hidden' name='submittedLogin' id='submittedLogin' value='1'/>
								<div>
									<span class='error'><?php echo $functions->GetErrorMessage(); ?></span>
								</div>
								<div>
									<input type="text" name="email" value="" class="form_input required" placeholder="email" />
								</div>
								<div>
									<input type="password" name="password" value="" class="form_input required" placeholder="password" />
								<div>
									Keep Me Logged In
									<input type="checkbox" name="loginCheck" value="value1" checked/> 
								</div>
								<input type="submit" name="submitLogin" class="form_submit" id="submitLogin" value="SIGN IN" />
							</form>
						</div>

						<script type='text/javascript'>
							var frmvalidator  = new Validator("LoginForm");
							frmvalidator.EnableOnPageErrorDisplay();
							frmvalidator.EnableMsgsTogether();

							frmvalidator.addValidation("email","req","Please provide your email");

							frmvalidator.addValidation("password","req","Please provide the password");
						</script>
					</div>
					<div class="col span_4_of_12">
					</div>
				</div>
				<div class="section group" style="padding-top:60px margin-bottom:60px ">
					<div class="col span_4_of_12">
					</div>
					<div class="col span_4_of_12">
					<div class ="productcat" id="productcat3">
						<p>Don't have an account?</p>
                  		<a href="register.php">SIGN UP</a>
						<p>Are you an admin? Click <a href='admin.php'>HERE</a>.</p>
					</div>
					</div>
					<div class="col span_4_of_12">
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
								<div id="socmediaicons">
									<a href='https://www.facebook.com/' target='_blank'><img src="img/facebook_icon.png" height="25" width="25" alt="facebook icon"></a>
									<a href='https://www.instagram.com/' target='_blank'><img src="img/instagram_icon.png" height="25" width="25" alt="instagram icon"></a>
									<a href='https://www.twitter.com/' target='_blank'><img src="img/twitter_icon.png" height="25" width="25" alt="twitter icon"></a>
									<a href='https://www.pinterest.com/' target='_blank'><img src="img/pinterest_icon.png" height="25" width="25" alt="pinterest icon"></a>
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
							<a href='#'>Terms of Services</a>
							<br>
							<a href='#'>FAQ</a>
							<br>
							<a href='#'>Contact Us</a>
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