<?php include('wheretosave.php'); 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<?php 
	if(empty($_SESSION['shopping_cart'])):
		header('location:books.php');
	endif;
?>
<?php
//detele button
if(filter_input(INPUT_GET,'action')=='delete'){
	//loop trhough shopping cart
	foreach($_SESSION['shopping_cart'] as $key =>$product){
		if($product['id']==filter_input(INPUT_GET, 'id')){
			//now what product to remove
			unset($_SESSION['shopping_cart'][$key]);
		}
	}
	//reset session array keys so they match with $product_ids numeric array
	$_SESSION['shopping_cart']=array_values($_SESSION['shopping_cart']);
}
//pre_r($_SESSION);

//add button
if(filter_input(INPUT_GET,'action')=='add'){
	//loop trhough shopping cart
	foreach($_SESSION['shopping_cart'] as $key =>$product){
		if($product['id']==filter_input(INPUT_GET, 'id')){
			$_SESSION['shopping_cart'][$key]['quantity'] ++;
		}
	}
	//reset session array keys so they match with $product_ids numeric array
	$_SESSION['shopping_cart']=array_values($_SESSION['shopping_cart']);
}
//remove button
if(filter_input(INPUT_GET,'action')=='remove'){
	//loop trhough shopping cart
	foreach($_SESSION['shopping_cart'] as $key =>$product){
		if($product['id']==filter_input(INPUT_GET, 'id')){
			if($product['quantity']==1){
				unset($_SESSION['shopping_cart'][$key]);				
			}else{
				$_SESSION['shopping_cart'][$key]['quantity'] --;
			}
		}
	}
	//reset session array keys so they match with $product_ids numeric array
	$_SESSION['shopping_cart']=array_values($_SESSION['shopping_cart']);
}
function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
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
		</div>
		</div>
	</div>
		<div class="rest">
	<table>
		<tr style="font-weight:bold; text-align:center; background-color:#cc33ff; border:2px solid purple">
			<td style="border:2px solid purple" width="40%">Product Name</td>
			<td style="border:2px solid purple" width="10%">Quantity</td>
			<td style="border:2px solid purple" width="10%">Price</td>
			<td style="border:2px solid purple" width="15%">Total</td>
			<td style="border:2px solid purple" width="15%">Action</td>
		</tr>
		<?php
			if(!empty($_SESSION['shopping_cart'])):
				//if the shopping cart is not empty
				$total=0;
				foreach($_SESSION['shopping_cart'] as $key => $product):
				?>
				<tr>
					<td style="text-align:center"><img src="<?php echo $product['image']?>" style="width:100px; height:120px; border-radius:5%; float:left"/><br/>
					<div class="float:right"><?php echo $product['name']; ?><br/><?php echo $product['writer']?></div></td>
					<td style="text-align:center"><?php echo $product['quantity']; ?></td>
					<td style="text-align:center"><?php echo $product['price']; ?>&nbsp;Ron</td>
					<td style="text-align:center"><?php echo number_format($product['quantity']*$product['price'],2); ?>&nbsp;Ron</td>
					<td style="text-align:center">
						
						<a href="cos.php?action=add&id=<?php echo $product['id']?>" class="remove_buton" title="Add more!">+</a>&nbsp;&nbsp;
						<a href="cos.php?action=remove&id=<?php echo $product['id']?>" class="remove_buton" title="Delete one!">-</a>&nbsp;&nbsp;
						<a href="cos.php?action=delete&id=<?php echo $product['id']; ?>" class="remove_buton" title="Delete all!">x</a>
					</td>
				</tr style="font-weight:bold">
				<?php
					$total = $total + ($product['quantity']* $product['price']);
					endforeach;
					$_SESSION['total']=$total;

				?>
				<tr style="font-weight:bold; border:2px solid purple">
					<td colspan="3" style="align:right;  border:2px solid purple">Total</td>
					<td colspan="2" style="text-align:center;  border:2px solid purple">
					<?php echo number_format($total,2); ?>&nbsp;Ron</td>
				</tr>
				</table>
				<?php
					 //checkout button only if the shopping cart is not empty?>
					<div style="text-align:center; color:#3d004d; font-size:150%">Add contact details</div>
					<a href="checkout.php" name="checkout" class="checkout">Checkout</a>
				<?php
				endif;
		?>
	</div>
	
</body>
</html>
