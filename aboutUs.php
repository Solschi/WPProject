<?php include('wheretosave.php'); 
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
				<?php if(isset($_SESSION["username"])): ?>
				<div class="welcome">
					<div class="name">
						<?php echo $_SESSION['username']; ?>
					</div>
				</div>
				<div class="patratel_hover">
					<div class="logout"><a href="home.php?logout='1'" style="color: white; text-decoration:none; font-size:100%">Logout</a></div></div>
			<?php endif ?>
		</div>
		
		</div>
	</div>
    <div class="rest">
    	
		<div class="textAboutUs">
			&nbsp; &nbsp; &nbsp;Some people like to read on a screen. Other people need the variety and artistry, the sight, smell, 
			and feel of actual books.They love seeing them on their shelves; they love having shelves for them.<br>
			&nbsp; &nbsp; &nbsp;They love taking them along when they leave the house, and stacking them by their bedsides. They 
			love finding old letters and bookmarks in them. They like remembering where they bought them or who 
			they received them from.<br>
			&nbsp; &nbsp; &nbsp;They want to read in a way that offers a rich experience, more than the words only: the full offering 
			of a book. They are particular about covers, they want to surround themselves with the poetry of good design.<br/>
			&nbsp; &nbsp; &nbsp;They can't pass a bookstore without going in and getting something, they keep a library card and use 
			it.<br/>
			&nbsp; &nbsp; &nbsp;They are allergic to cheap bestsellers; they delight in the out-of-the-way and the rare, the well-made and the hard-to-accomplish. They take care of their books; they  know a book is only theirs until it passes on to someone else. They are good stewards of a timeless object.
			<br>
			&nbsp; &nbsp; &nbsp;These are the people we're working for.
		</div>
		
	
	</div>
</body>
</html>