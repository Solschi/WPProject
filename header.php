<!--<
	?php 
	include 'db.php'; 
?>-->
<?php include('wheretosave.php'); 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="Icon" type="image/png" href="icon.png" class="icon" size="96x96">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">	
    <link href='home.css' rel='stylesheet'>

    <title>Search and found</title>
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
		<form action="" method="POST">
			<div class="search-box">
				<input type="text" class="search-box-input" placeholder="Search.." name="search">
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
					<?php echo $_SESSION['username'] ?>
				</div>
			</div>
			<div class="patratel_hover">
				<div class="logout"><a href="home.php?logout='1'" style="color: white; text-decoration:none; font-size:100%">Logout</a></div></div>
			<?php endif ?>
		</div>
	</div>
</div>
<div>
	<div class="rest">		
	<?php
	$conn=mysqli_connect('localhost','root','','cart');
    if(isset($_POST['submit-search'])){
        $search=mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR writer LIKE '%$search%'";
        $sql1 = "SELECT * FROM manga WHERE name LIKE '%$search%'";
        
        $resultbook = mysqli_query($conn, $sql);
        $resultmanga = mysqli_query($conn, $sql1);
        
        $queryResultbook = mysqli_num_rows($resultbook);
        $queryResultmanga = mysqli_num_rows($resultmanga);
        if($queryResultbook > 0){
            while($row = mysqli_fetch_assoc($resultbook)){	
				
				echo    "	<form method='POST' action='header.php?action=add&id=".$row['id']."'>
							<div class='col-sm-4 col-md-3'>
								<div class='border_img'>
									<img src='".$row['image']."' class='img'/>
									<div class='text_border'>".$row['info']."</div>
									<div class='pret_text'>".$row['name']."<br/>".$row['writer']."<br/>".$row['price']."&nbsp;RON<br/></div>
									<div class='buton_cantitate'>
										<input type='text' name='quantity' class='adauga_cantitate' value='1'/>
										<input type='submit' name='add_to_cart' style='margin-top:5px' class='buton_adauga_in_cos' value='Add'/>
									</div>
									<input type='hidden' name='id' value='".$row['id']."'/>
									<input type='hidden' name='name' value='".$row['name']."'/>
									<input type='hidden' name='price' value='".$row['price']."'/>
									<input type='hidden' name='image' value='".$row['image']."'/>
									<input type='hidden' name='writer' value='".$row['writer']."'/>
									<input type='hidden' name='type' value='".$row['type']."'/>
									</div>
							</div>
							</form>";
                        
			}
        }
        if ($queryResultmanga > 0){
                while($rowmanga = mysqli_fetch_assoc($resultmanga)){
					echo    "<form method='POST' action='header.php?action=add&id=".$rowmanga['id']."'>
							<div class='col-sm-4 col-md-3'>
								<div class='border_img_manga'>
									<img src='".$rowmanga['image']."' class='img'/>
									<div class='pret_text'>".$rowmanga['name']."<br/>".$rowmanga['writer']."<br/>".$rowmanga['price']."&nbsp; RON<br/></div>
										<div class='buton_cantitate'>
										<input type='text' name='quantity' class='adauga_cantitate' value='1'/>
										<input type='submit' name='add_to_cart' style='margin-top:5px' class='buton_adauga_in_cos' value='Add'/>
									</div>
									<input type='hidden' name='id' value='".$rowmanga['id']."'/>
									<input type='hidden' name='name' value='".$rowmanga['name']."'/>
									<input type='hidden' name='price' value='".$rowmanga['price']."'/>
									<input type='hidden' name='image' value='".$rowmanga['image']."'/>
									<input type='hidden' name='writer' value='".$rowmanga['writer']."'/>
									<input type='hidden' name='type' value='".$rowmanga['type']."'/>
								</div>
							</div>
							</form>";
                }
        }
        if($queryResultbook == 0 && $queryResultmanga == 0){
            echo "There are no result matching your search!";
        }
    }
    ?>
	<?php if(isset($_POST['add_to_cart'])):
		?>
		<script type="text/javascript">
            alert("Your product was added successfully");
            </script>
			<?php
	endif; ?>
</div>
</div>

</div>
</body>
</html>