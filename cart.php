<?php include('wheretosave.php'); 
    //if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<link rel="Icon" type="image/png" href="icon.png" size="96x96">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link href='home.css' rel='stylesheet'>

<body>
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
	
	<div class="search-box">
		<input type="text" class="search-box-input" placeholder="Search..">
		<button class="search-box-button">Go!</button>
	</div>
	
	<a  href="cos.php"><img src="cart.png" class="cos-de-cumparaturi" title="Let's go shopping!"/></a>
	
	<div class="patratel">

        <?php if(isset($_SESSION['success'])): ?>
            <div class= "success">
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
            </div>
            
        <?php endif ?>
        <?php if(isset($_SESSION["username"])): ?>
            <p  style="color:white"><strong><?php echo $_SESSION['username'] ?></strong></p>
            <p><a href="home.php?logout='1'" style="color: white; text-decoration:none">Logout</a></p>
        <?php endif ?>

		
	</div>
	<div style="clear:left"></div>
	<!--<div class="border_img">-->
    <?php

        $connect = mysqli_connect('localhost','root','','cart');
        $query = 'SELECT * FROM products ORDER by id ASC';
		
		$result = mysqli_query($connect, $query);

        if($result):
            //if is not empty
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                //we can print in here
                //print_r($product);
                ?>
				
				<div class="col-sm-4 col-md-3">
                    <form method="POST" action="cos.php?action=add&id=<?php echo $product['id']; ?>">
                     <div class="border_img">
							<img src="<?php echo $product['image']; ?>" class="img" />  
                            <div class="text_border"><?php echo $product['info'];?></div>
							<div class="sub_text_border"> 
								<div class="pret_text"><?php echo $product['name']; ?><br/>
                            	$ <?php echo $product['price']; ?></div>
								<div class="buton_cantitate">   
									<input type="text" name="quantity" class="adauga_cantitate" value="1"/>
									<input type="submit" name="add_to_cart" style="margin-top:5px" class="buton_adauga_in_cos" value="Add"/>
								</div>
								<input type="hidden" name="name" value="<?php echo $product['name']; ?>"/>
                            	<input type="hidden" name="price" value="<?php echo $product['price']; ?>"/>
								</div>
							</div>
                        </form>
				</div>
                <?php
                endwhile;
            endif;
        endif;
	?>
	
	
	<div class="inregistrare">
	<form method="POST">
		<pre style="font-family:Arial; font-size:25px">Name <input type="text" name="Name" style="maxlength:50" id="nume"/></pre>
	</form>
	<pre style="font-family:Verdana font-size:25px">Your opinion is essential to us:</pre>
	<textarea name="Comments" rows="5" cols="50" id="textul"></textarea>
	<p></p>
	<input type="submit" name="submit" value="Send" style="margin-left:25%" onclick="valideaza();"/>
	</div>
	<script type="text/javascript">	
		function valideaza(){
			var nume=document.getElementById('nume');
					if(nume.value==""){
						alert('Name can not be empty');
					}
					
			var citat=document.getElementById('textul');
				if(citat.value==""){
					alert('The comment can not be empty');
			}
		}
	</script>
	
</body>
</html>