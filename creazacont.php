<?php include('wheretosave.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link href='home.css' rel='stylesheet'>
	<link rel="Icon" type="image/png" href="icon.png" class="icon" size="96x96">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Register</title>
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
				<li><a href="contact.php">Comments</a></li>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="rest">
		<form method="POST" action="creazacont.php">
            <!-- display validation errors here-->
			<div class="inregistrare" style="text-align:center">

				<?php include('errors.php'); ?>
				
                <label>Username</label>
			    <input type="text" name="username" value="<?php echo $username; ?>">
				<p></p>
           
                <label>Email</label>
			    <input type="text" name="email" value="<?php echo $email; ?>">
				<p></p>
                <label>Password</label>
			    <input type="password" name="password1">
           		<p></p> 
                <label>Confirm password</label>
				<input type="password" name="password2">
				<p></p>
                <button type="submit" name="register" class="btn">Log in</button>
			</div>
		</form>
	</div>
</body>
</html>