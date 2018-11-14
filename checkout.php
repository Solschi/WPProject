<?php include('wheretosave.php'); 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<?php 
	if(empty($_SESSION['shopping_cart'])):
		header('location:cos.php');
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
			<li><a href="contact.php">Contact</a></li>
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
		<div class="informati">Paid information</div>
		<div class="inregistrare" style="text-align:center">
		<form action="checkout.php" method="POST">
		<?php include('errorsinfo.php'); ?>
		Last Name:<br/>
		<input type="text" name="lastname" value="<?php echo $lastname; ?>" maxlength="30"/><br/>
		First Name:<br/>
		<input type="text" name="firstname" value="<?php echo $firstname;?>" maxlength="30"/><br/>
		Phone number:<br/>
		<input type="text" name="phone" value="<?php echo $phone; ?>" maxlength="10"/><br/>
		Email:<br/>
		<input type="text" name="email" value="<?php echo $email;?>" maxlength="30"/><br/>
		Address:<br/>
		<input type="text" name="address" value="<?php echo $address;?>" maxlength="30"/><br/>
		City:<br/>
		<input type="text" name="city" value="<?php echo $city; ?>" maxlength="30"/><br/>
		Postal code:<br/>
		<input type="text" name="postalcode" value="<?php echo $postalcode;?>" maxlength="6"/><br/>
		County:<br/>
		<select name="county">
			<option value="alba">Alba</option>
			<option value="arad">Arad</option>
			<option value="arges">Arges</option>
			<option value="bacau">Bacau</option>
			<option value="bihor">Bihor</option>
			<option value="bistrita">Bistrita</option>
			<option value="bistritaNasaud">Bistrita Nasaud</option>
			<option value="botosani">Botosani</option>
			<option value="braila">Braila</option>
			<option value="brasov">Brasov</option>
			<option value="bucuresti">Bucuresti</option>
			<option value="buzau">Buzau</option>
			<option value="calarasi">Calarasi</option>
			<option value="caras">Caras</option>
			<option value="cluj">Cluj</option>
			<option value="constanta">Constanta</option>
			<option value="covasna">Covasna</option>
			<option value="dambovita">Dambovita</option>
			<option value="dolj">Dolj</option>
			<option value="galati">Galati</option>
			<option value="giurgiu">Giurgiu</option>
			<option value="gorj">Gorj</option>
			<option value="Harghita">Harghita</option>
			<option value="hunedoara">Hunedoara</option>
			<option value="ialomita">Ialomita</option>
			<option value="iasi">Iasi</option>
			<option value="ilfov">Ilfov</option>
			<option value="maramures">Maramures</option>
			<option value="mehedinti">Mehedinti</option>
			<option value="mures">Mures</option>
			<option value="neamt">Neamt</option>
			<option value="olt">Olt</option>
			<option value="prahova">Prahova</option>
			<option value="salaj">Salaj</option>
			<option value="sibiu">Sibiu</option>
			<option value="suceava">Suceava</option>
			<option value="teleorman">Teleorman</option>
			<option value="timis">Timis</option>
			<option value="tulcea">Tulcea</option>
			<option value="valcea">Valcea</option>
			<option value="vaslui">Vaslui</option>
			<option value="vrancea">Vrancea</option>
		</select><br/>
		Country:<br/>
		<input type="text" name="country" value="Romania" /><br/>
		Trasnport:<br/>
		<input type="radio" name="transport" value="curier"/>Curier (Cargus) - 14.99 RON<br>
		<input type="radio" name="transport" value="store"/>Brasov (from the store) - FREE<br>
		How would you like to pay?<br/>
		<input type="radio" name="plata" value="creditcard"/>Credit card<br/>
		<input type="radio" name="plata" value="ramburs"/>Ramburs<br/>
		<?php $id_user=$_SESSION['current_id'];?>
		<input type="hidden" name="user_id" value="<?php $id_user;?>"/>

		<input type="hidden" name="id" value="<?php $id;?>"/>
		<input type="submit" name="submit_info" value="FINISH!"/>
	</form>
	</div>
	
</body>
</html>
