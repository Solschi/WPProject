<?php include 'wheretosave.php';
//if user is not logged in they cannot acces this page
    if(empty($_SESSION['username'])){
        header('location: login.php');
    }?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
		<link rel="Icon" type="image/png" href="bookicon.png" class="icon" size="96x96">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href='admin.css' rel='stylesheet'>
	</head>
	<body>
    <img src="admin.png" class="img_admin"/>
    <?php
    ?>
    <div class="welcome">
    <?php if(isset($_SESSION['success'])): ?>
		<?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
		?>
	<?php endif ?>
	<?php if(isset($_SESSION['username'])): ?>
		<?php echo $_SESSION['username']; ?>
    <?php endif; ?>
</div>
    <hr/>
    <div class="top_menu">
        <table class="nav_bar">
            <tr>
                <td><a href="admin.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Start</a> </td>
                <td><a href="admin_users.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Users</a></td>
                <td><a href="admin_products.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Products</a></td>
                <td><a href="admin_comments.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Comments</a></td>                
                <td><a href="login.php?logout='1'" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Log out</a></td>
            </tr>
        </table>
    </div>
    <div class="centru_left">
    <br/>
    <div style="font-size:300%"><strong>STATISTICS:</strong>
    </div>
    <br/><br/>
    
    <?php
        $legatura_users = mysqli_connect('localhost','root','','cart');
        $users = "SELECT * FROM users ORDER BY id ASC";
        $connection_users = mysqli_query($legatura_users, $users);
        while($user = mysqli_fetch_assoc($connection_users)):
            if($user['type']==0):
                ?>
                <table style="margin-left:1%; width:40%; font-size:200%">
                    <tr><td colspan="2"></td></tr>
                    <tr>
                        <td width="40%">Username</td>
                        <td style="text-align:center; border:1px solid #66ff99"><strong><?php echo $user['username'];?></strong></td>
                    </tr>
                    <tr>
                    <td>Email address</td>
                    <td style="text-align:center"><?php echo $user['email'];?></td>
                    </tr>
            </table>
                <?php
                $user_id = $user['id'];
                //$legatura_contact = mysqli_connect('localhost','root','','cart');
                
                $contact = "SELECT * FROM checkout ORDER BY id ASC";
                $connection_contact = mysqli_query($legatura_users, $contact);
                ?><br/><?php
            
                while($checkout = mysqli_fetch_assoc($connection_contact)):

                   if($checkout['user_id']==$user_id):
                        $order_id=$checkout['order_id'];
                        ?><br/>
                        <table style=" width:50%; margin-left:5%; font-size:150%">
                            <tr>
                                <td colspan="2" style="text-align:center;  border-bottom:1px solid #66ff99">
                                <strong>CONTACT ADDRESS</strong> 
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td width="50%">Last Name</td>
                                <td width="50%"><?php echo $checkout['lastname'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>First Name</td>
                                <td><?php echo $checkout['firstname'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>Address:</td>
                                <td><?php echo $checkout['address'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>Email Address:</td>
                                <td><?php echo $checkout['email'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>City:</td>
                                <td><?php echo $checkout['city'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>County:</td>
                                <td><?php echo $checkout['county'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>Phone Number:</td>
                                <td><?php echo $checkout['phone'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td> Postal Code: </td>
                                <td><?php echo $checkout['postalcode'];?></td>
                            </tr>
                            <tr style="border-bottom:1px solid #adebad">
                                <td>Transport: </td>
                                <td><?php echo $checkout['transport'];?></td>
                            </tr>
                            <tr>
                                <td>Way Of Paying:</td>
                                <td><?php echo $checkout['plata'];?></td>
                            </tr>
                   </table>
                        <?php
                        $orders = "SELECT * FROM orders ORDER BY id ASC";
                        $connection_orders = mysqli_query($legatura_users, $orders);
                        while($order = mysqli_fetch_assoc($connection_orders)):
                            if($order_id == $order['id']):
                                ?><br/>
                                <table style="width:70%; text-align:center; margin-left:10%; font-size:150%"> 
                                                <tr><td colspan="5" style="text-align:center; border-bottom:1px solid #66ff99"><strong>ORDER</strong></td></tr>
                                                <tr style="border-bottom:1px solid #adebad">
                                                <td width="35%">Product's Name</td>
                                                <td width="20%">Product's Writer</td>
                                                <td width="15%">Product's Price</td>
                                                <td width="20%">Product's Image</td>
                                                <td width="10%">Quantity</td>
                                                </tr>
                                                <?php
                                $orders_products = "SELECT * FROM orders_products ORDER BY id ASC";
                                $connection_orders_products = mysqli_query($legatura_users, $orders_products);
                                while($order_product = mysqli_fetch_assoc($connection_orders_products)):
                                    if($order_id == $order_product['order_id']):
                                        if(!empty($order_product['product_id'])):
                                            $id_book = $order_product['product_id'];
                                            $products = "SELECT * FROM products ORDER BY id ASC";
                                            $connection_products = mysqli_query($legatura_users, $products);
                                            
                                            while($product = mysqli_fetch_assoc($connection_products)):
                                                if($id_book == $product['id']):
                                                    echo "  <tr style='border-bottom:1px solid #adebad'>
                                                            <td>".$product['name']."</td>
                                                            <td>".$product['writer']."</td>
                                                            <td>".$product['price']."</td>
                                                            <td><img src='".$product['image']."' style='width:50%; height:100px; padding:2%'/></td>
                                                            ";
                                                endif;
                                            endwhile; 
                                        endif;
                                        
                                        if(!empty($order_product['manga_id'])):
                                            $id_manga = $order_product['manga_id'];
                                            $manga = "SELECT * FROM manga ORDER BY id ASC";
                                            $connection_manga = mysqli_query($legatura_users, $manga);
                                            while($man = mysqli_fetch_assoc($connection_manga)):
                                                if($id_manga == $man['id']):
                                                    echo "  <tr style='border-bottom:1px solid #adebad'>
                                                            <td>".$man['name']."</td>
                                                            <td>".$man['writer']."</td>
                                                            <td>".$man['price']."</td>
                                                            <td><img src='".$man['image']."' style='width:50%; height:100px; padding:2%'/></td>
                                                            ";
                                                endif;
                                            endwhile; 
                                        endif;
                                        echo "<td>".$order_product['quantity']."</td>
                                                </tr>";       
                                    endif;
                                endwhile;
                                ?>
                                <tr>
                                    <td colspan="3"><strong><?php echo "Total Cost: "; ?></strong></td>
                                    <td colspan="2" style="margin-left:5%; text-align:center"><strong><?php echo $order['total'];?></strong></td>                                
            
                                </tr>
                                </table><?php
                            endif;
                        endwhile; 
                        echo "<br/><br/>";
                 
                 
                    endif;   
                endwhile;
            
            
            echo "<br/>";
            endif;
        endwhile;
    ?>
    </div>
</body>
</html>