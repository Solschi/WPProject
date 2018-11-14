<?php include ('wheretosave.php') ;
 //if user is not logged in they cannot acces this page
 if(empty($_SESSION['username'])){
    header('location: login.php');
}
?>
<?php
//fetch the record to be updated
    if(isset($_GET['edit_book'])){
        //saving the id
        $id_product = $_GET['edit_book'];
		$edit_state = true;
        $rec_book = mysqli_query($products, "SELECT * FROM products WHERE id = $id_product");
        $result_book = mysqli_fetch_array($rec_book);
        $name = $result_book['name'];
        $writer = $result_book['writer'];
        $image = $result_book['image'];
        $price = $result_book['price'];
        $info = $result_book['info'];
        $id_product = $result_book['id'];
    }
?>
<?php
//fetch the record to be updat
    if(isset($_GET['edit_manga'])){
        //saving the id
        $id_product = $_GET['edit_manga'];
		$edit_state1 = true;
        $rec_manga = mysqli_query($products, "SELECT * FROM manga WHERE id = $id_product");
        $result_manga = mysqli_fetch_array($rec_manga);
        $name = $result_manga['name'];
        $writer = $result_manga['writer'];
        $image = $result_manga['image'];
        $price = $result_manga['price'];
        $id_product = $result_manga['id'];
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Products</title>
		<link rel="Icon" type="image/png" href="bookicon.png" class="icon" size="96x96">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href='admin.css' rel='stylesheet'>
	</head>
	<body>
    <img src="admin.png" class="img_admin"/>
    <hr/>
    <div class="top_menu">   
    <table class="nav_bar">
            <tr>
                <td><a href="admin.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Start</a> </td>
                <td><a href="admin_users.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Users</a></td>
                <td><a href="admin_comments.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Comments</a></td>                
                <td><a href="admin_statistica.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Buyers</a></td>
                <td><a href="login.php?logout='1'" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Log out</a></td>

            </tr>
    </table>
    <br/>
    <a href="#up" style="position:fixed"><img src="up0.png" style="width:20px; height:20px" /></a>
    <a name="up"></a><br/>
    <a href="#book" style="margin-left:45%"><button class="btn btn-light" style="color:black; background-color:#66ff99">BOOKS</button></a>
    <a href="#manga"><button class="btn btn-light" style="color:black; background-color:#66ff99">MANGA</button></a>
        <div class="mesaj">
    <?php if(isset($_SESSION['message2'])): ?>
        <?php   echo $_SESSION['message2']; 
               // unset($_SESSION['message2']);
         ?>
        <?php endif; ?>
    </div>
    <div style="clear:both"></div>
    <table width="80%" style="margin-right:auto; margin-top:2%; margin-bottom:2%; margin-left:auto">
    <tr>
    <td width="50%">
        <form method="POST" action="admin_products.php">		
		<?php include('errorbook.php');?>
        <div class="chenar_book">
            <input type="hidden" name="id" value="<?php echo $id_product; ?>"/>
            <label>Name</label><br/>
            <input type="text" name="name" class="insert_data" value="<?php echo $name; ?>"/><br/><br/>
            <label>Writer</label><br/>
            <input type="text" name="writer" class="insert_data" value="<?php echo $writer; ?>"/><br/><br/>
            <label>Image</label><br/>
            <input type="text" name="image" class="insert_data" value="<?php echo $image; ?>"/><br/><br/>
            <label>Price</label><br/>
            <input type="text" name="price" class="insert_data" value="<?php echo $price; ?>"/><br/><br/>
            <label>Information</label><br/>
            <input type="text" name="info" class="insert_data" value="<?php echo $info; ?>"/><br/><br/>
             <?php if($edit_state == false): ?>
            <button type="submit" class="btn btn-success" style="color:black; background-color:#66ff99" name="create_book">Create</button>
            <?php else : ?>
            <button type="submit" class="btn btn-primary" style="color:black" name="edit_book">Update</button>
            <?php endif; ?>
        </div>
    </form>
    </td>
    <td width="50%">
    <form method="POST" action="admin_products.php">		
        <?php include('errormanga.php');?>
        <div class="chenar_manga">
            <input type="hidden" name="id" value="<?php echo $id_product; ?>"/>
            <label>Name</label><br/>
            <input type="text" name="name" class="insert_data" value="<?php echo $name; ?>"/><br/><br/>
            <label>Writer</label><br/>
            <input type="text" name="writer" class="insert_data" value="<?php echo $writer; ?>"/><br/><br/>
            <label>Image</label><br/>
            <input type="text" name="image" class="insert_data" value="<?php echo $image; ?>"/><br/><br/>
            <label>Price</label><br/>
            <input type="text" name="price" class="insert_data" value="<?php echo $price; ?>"/><br/><br/>
             <?php if($edit_state1 == false): ?>
            <button type="submit" class="btn btn-success" style="color:black; background-color:#66ff99" name="create_manga">Create</button>
            <?php else : ?>
            <button type="submit" class="btn btn-primary"  style="color:black" name="edit_manga">Update</button>
            <?php endif; ?>
        </div>
    </form>
    </td>
    </tr>
    </table>
    <a name="book"></a>
        <table class="table_product">
            <tr style="border-bottom: 1px solid white; font-size:200%">
                <td width="15%">Name</td>
                <td width="8%">Writer</td>
                <td width="6%">Image</td>
                <td width="6%">Price</td>
                <td width="50%">Information</td>
                <td colspan="2">Action</td>
            </tr>
        <?php
        if($result_products_book):
            //if is not empty
            if(mysqli_num_rows($result_products_book)>0):
                while($product = mysqli_fetch_assoc($result_products_book)):
                    ?>
                    
                        <tr>
                            <td><?php echo $product['name'];?></td>
                            <td><?php echo $product['writer'];?></td>
                            <td><img src="<?php echo $product['image'];?>" class="book_img"/></td>
                            <td><?php echo $product['price'];?></td>
                            <td><?php echo $product['info'];?></td>
                            <td><a href="admin_products.php?edit_book=<?php echo $product['id'];?>" class="btn btn-info" style="color:black">Edit</a></td>
                            <td><a href="wheretosave.php?delete_book=<?php echo $product['id'];?>" class="btn btn-danger" style="color:black">Delete</a></td>
                        </tr>
                <?php 
                endwhile;
            endif;
        endif;
        ?>
        </table>
        <a name="manga"></a>
        <table class="table_product">
            <tr style="border-bottom: 1px solid white; font-size:200%">
                <td width="25%">Name</td>
                <td width="20%">Writer</td>
                <td width="5%">Image</td>
                <td width="15%">Price</td>
                <td colspan="2">Action</td>
            </tr>
        <?php
        if($result_products_book):
            //if is not empty
            if(mysqli_num_rows($result_products_manga)>0):
                while($product = mysqli_fetch_assoc($result_products_manga)):
                    ?>
                    
                        <tr>
                            <td><?php echo $product['name'];?></td>
                            <td><?php echo $product['writer'];?></td>
                            <td><img src="<?php echo $product['image'];?>" class="book_img"/></td>
                            <td><?php echo $product['price'];?></td>
                            <td><a href="admin_products.php?edit_manga=<?php echo $product['id'];?>" style="color:black" class="btn btn-info">Edit</a></td>
                            <td><a href="wheretosave.php?delete_manga=<?php echo $product['id'];?>" style="color:black" class="btn btn-danger">Delete</a></td>
                        </tr>
                <?php 
                endwhile;
            endif;
        endif;
        ?>
        </table>
</body>
</html>