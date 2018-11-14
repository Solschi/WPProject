<?php include 'wheretosave.php' ; 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="Icon" type="image/png" href="icon.png" class="icon" size="96x96">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href='home.css' rel='stylesheet'>
	</head>
	<body>
	<div class="top">
	<div class="navigation_bar">
		<ul >
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
		<form action="header.php" method="POST">
			<div class="search-box">
				<input type="text" class="search-box-input" placeholder="Search.." name="search"/>
				<button type="submit" class="search-box-button" name="submit-search">Go!</button>
			</div>
		</form>
		
		<a  href="cos.php"><img src="cart.png" class="cos-de-cumparaturi" title="Let's go shopping!"/></a>

		<div class="patratel">
		<?php if(isset($_SESSION['success'])): ?>
			<div class="welcome">
				<div class= "success">
						<?php
							echo $_SESSION['success'];
							unset($_SESSION['success']);
						?>
				</div>
			</div>
			<?php endif ?>
			<?php if(isset($_SESSION['username'])): ?>
			<div class="welcome">
				<div class="name">
					<?php echo $_SESSION['username']; ?>
				</div>
			</div>
			<div class="patratel_hover">
				<div class="logout"><a href="home.php?logout='1'" style="color: white; text-decoration:none; font-size:100%">Logout</a></div></div>
			<?php endif ?>
			<!-- ?php	if(isset($_SESSION["username"])){ ?>
				<p  style="color:white"><strong>
					<
						?php echo $_SESSION['username'] ?></strong></p>
				<p><a href="home.php?logout='1'" style="color: white; text-decoration:none">Logout</a></p>
				 ?php }else{
				?>
					<a class="loginelse" href="creazacont.php">You don't have an account?</a><br>
					<a class="loginelse" href="forgotpassword.php">Forgot your passwords?</a>

			?php } >?-->
		</div>
	</div>
</div>
    <div class="rest">
	<div id="slider">
		<figure>
			<img class="img1" src="books6.jpg" >
			<img class="img1" src="books1.jpg" >
			<img class="img1" src="books3.jpg" >
			<img class="img1" src="books4.jpg" >
			<img class="img1" src="books2.jpg" >
			
		</figure>
	</div>
	<br/><!--
	<
		?php include 'errors1.php';
		echo "<form method='POST' action='home.php'>
				
				
				
				<div class='inregistrare1'>
					<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'/>
					<img src='man.png' style='border-radius:50%;width:50px'/>Your name:<input type='text' name='name' class='nume_user'/><br/><br/>
					<textarea name='message'></textarea><br/>
					<button class='trimite_mesajul' name='commentSubmit' type='submit'>Post it!</button>
				</div><br/>
			</form>";
		getComments($db);
	?>-->
	<?php echo $_SESSION['current_id'];?>
	

	</div>
</body>
</html>