<?php include('wheretosave.php'); 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manga</title>
	<link rel="Icon" type="image/png" href="icon.png" class="icon" size="96x96">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href='home.css' rel='stylesheet'>
</head>
<body>
<br/>
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
		</div>
	</div>
</div>
<div class="rest">
	<div style="clear:left"></div>
	<?php

		$connect_manga = mysqli_connect('localhost','root','','cart');
		$query_manga = 'SELECT * FROM manga ORDER by id ASC';

		$result1 = mysqli_query($connect_manga, $query_manga);

		if($result1):
			//if is not empty
			if(mysqli_num_rows($result1)>0):
				while($product_manga = mysqli_fetch_assoc($result1)):
				//we can print in here
				//print_r($product);
				?>
		<div class="col-sm-4 col-md-3">
			<form method="POST" action="manga.php?action=add&id=<?php echo $product_manga['id']; ?>">
			
                <div class="border_img_manga">
					<img src="<?php echo $product_manga['image']; ?>" class="img" />  
					<div class="text_border"></div>
								<div class="pret_text"><?php echo $product_manga['name']; ?><br/><?php echo $product_manga['writer'] ?><br/>
                            	<?php echo $product_manga['price']; ?>Ron</div>
								<div class="buton_cantitate">   
									<input type="text" name="quantity" class="adauga_cantitate" value="1"/>
									<input type="submit" name="add_to_cart" style="margin-top:5px" class="buton_adauga_in_cos" value="Add"/>
								</div>
								<!-- saving info for showing it in cos -->
								<input type="hidden" name="id" value="<?php echo $product_manga['id']; ?>"/>
								<input type="hidden" name="name" value="<?php echo $product_manga['name']; ?>"/>
                            	<input type="hidden" name="price" value="<?php echo $product_manga['price']; ?>"/>
								<input type="hidden" name="image" value="<?php echo $product_manga['image']; ?>"/>
								<input type="hidden" name="writer" value="<?php echo $product_manga['writer']; ?>"/>
								<input type="hidden" name="type" value="<?php echo $product_manga['type']; ?>"/>
								</div>
                        </form>
		</div>
		<?php
		endwhile;
	endif;
endif;
?>
	<?php if(isset($_POST['add_to_cart'])):
		?>
		<script type="text/javascript">
            alert("Your manga was added successfully");
            </script>
			<?php
	endif; ?>
	</div>
</body>
</html>