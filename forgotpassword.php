<!DOCTYPE html>
<html>
<head>
	<link href='home.css' rel='stylesheet'>
	<link rel="Icon" type="image/png" href="icon.png" class="icon" size="96x96">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Forgot password?</title>
</head>
<body>
	<div class="top">
		<div class="navigation_bar">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a>Products</a>
					<ul>
						<li><a href="books.php">Books</a></li>
						<li><a href="manga.php">Manga</a></li>

					</ul>
				</li>
				<li><a href="aboutUs.php">About Us</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<div class="search_and_destroy">
			<div class="search-box">
				<input type="text" class="search-box-input" placeholder="Search..">
				<button class="search-box-button">Go!</button>
			</div>
			
			<a  href="cos.php"><img src="cart.png" class="cos-de-cumparaturi" title="Let's go shopping!"/></a>
			
			<div class="patratel">
				<div class="cont">Options</div>
					<div class="patratel_hover">
						<a class="login" href="login.php">Login</a><br>
						<a class="loginelse" href="creazacont.php">You don't have an account?</a>	
					</div>
				</div>
			</div>

		</div>
		
	</div>
	<div class="rest">
		<div class="inregistrare">
			<div style="text-align:left"><b>Forgot your password?</b><br><br>
				<form method="POST">Write your email address:<br><br>
					Email&nbsp;
					<input type="text" name="username" maxlength="30" id="username"/><br><br>
					<input type="submit" name="submit" value="Send" style="margin-left:14%" onclick="valideaza();"/>
				</form>
				<script type="text/javascript">	
					function valideaza(){
						var nume=document.getElementById('username');
								if(nume.value==""){
									alert('The address can not be empty');
								}
					}
				</script>
			</div>
		</div>
	</div>
</body>
</html>