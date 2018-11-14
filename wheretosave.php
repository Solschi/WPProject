<?php 
    session_start();
    //initialization
    $username = "";
    $email = "";
    $errors = array();
    $id = "";
    //connect to the registration database
    $db_user = mysqli_connect('localhost','root', '', 'cart');
    $db = mysqli_connect('localhost','root', '', 'registration');
    // new PDO('sqlite:C:\xampp\htdocs\PWProject\PHP'); 
    // sau asta ?? : mysqli_connect('localhost','root', '', 'registration');
    
    //if the regiter button is clicked
    if(isset($_POST['register'])){
        $username = mysqli_real_escape_string($db_user, $_POST['username']);
        $email = mysqli_real_escape_string($db_user, $_POST['email']);
        $password1 = mysqli_real_escape_string($db_user, $_POST['password1']);
        $password2 = mysqli_real_escape_string($db_user, $_POST['password2']);
        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");//add error to errors array

        }

        if(empty($email)){
            array_push($errors, "Email is required");//add error to errors array
               
        }
        if(empty($password1)){
            array_push($errors, "Password is required");//add error to errors array       
        }

        if($password1!=$password2){
            array_push($errors, "The two password do not match");//add error to errors array 
        }

        //if there are no errors, save user to database
        if(count($errors)==0){
            $password = md5($password1);//encrypt password before stoaring in database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email', '$password')";
            mysqli_query($db_user,$sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in,";
            header('location: home.php'); //redirect to home page
        }
    }

    //log user in from login page
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($db_user, $_POST['username']);
        $password = mysqli_real_escape_string($db_user, $_POST['password']);

        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");//add error to errors array

        }

        if(empty($password)){
            array_push($errors, "Password is required");//add error to errors array
               
        }
        if(count($errors) == 0){
            $password = md5($password);//encrypting password before comparing with that from database
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db_user, $query);
            if(mysqli_num_rows($result) == 1){
                $i = mysqli_fetch_assoc($result);
                $_SESSION['current_id'] = $i['id'];
                //log user in
                if($i['type']=="1"){
                    $_SESSION['success'] = "Let's do some changes,";
                    $_SESSION['username'] = $username;
                    header('location: admin.php');//redirect to admin page

                }else{
                    $_SESSION['success'] = "Welcome back,";
                    $_SESSION['username'] = $username;

                    header('location: home.php');//redirect to home page
                }
            }else {
                array_push($errors, "The username/password is wrong");
                //header('location: login.php');
            }

        }
    }

    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>
<?php
    date_default_timezone_set('Europe/Bucharest');
	//$comm=mysqli_connect('localhost','root','','registration');
    $errors1 = array();
    $name = "";
    $message = "";
    if(isset($_POST['commentSubmit'])){
        if(!$db){
            echo "Eroare";
        }
		$name = $_POST['name'];            
		$date = $_POST['date'];            
        $message = $_POST['message'];
       	if(empty($name)){
                array_push($errors1, "Name is required");//add error to errors array
    
        }  
        if(empty($message)){
            array_push($errors1, "Message is required");//add error to errors array

        }
        if(count($errors1) == 0){
            $sqlcomm = "INSERT INTO comments (name, date, message) VALUES ('$name','$date','$message')";
			$resultcomm = mysqli_query($db, $sqlcomm);

        }
    }
?>
<?php
//products:
$product_ids = array();
//session_destroy();
//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
	//if the session cart exists
	if(isset($_SESSION['shopping_cart'])){
    	//track how many products are in the shopping cart
		$count = count($_SESSION['shopping_cart']);
		//create sequential array for matching keys to product id's
		$product_ids = array_column($_SESSION['shopping_cart'], 'id');
		if(!in_array(filter_input(INPUT_GET,'id'), $product_ids)){
			//if the product isn't in the cart
			$_SESSION['shopping_cart'][$count] = array
			(
				'id' => filter_input(INPUT_GET,'id'),
				'name' => filter_input(INPUT_POST, 'name'),
				'image' => filter_input(INPUT_POST, 'image'),
				'writer' => filter_input(INPUT_POST, 'writer'),
				'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity'),
				'type' => filter_input(INPUT_POST, 'type')

            );
		}else{
			//if the product already exist
			//match array key to id of the product being added
			for($i=0; $i < count($product_ids); $i++){
				if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
					//increase de quantity
					$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');
				}
			}
		}
	}else{
		//shopping cart doesn't exist=>create 
		$_SESSION['shopping_cart'][0] = array
		(
			'id' => filter_input(INPUT_GET,'id'),
			'name' => filter_input(INPUT_POST, 'name'),
			'image' => filter_input(INPUT_POST, 'image'),                
			'writer' => filter_input(INPUT_POST, 'writer'),
			'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity'),
            'type' => filter_input(INPUT_POST, 'type')

            
		);
	}
}
?>
<?php function getComments($db){
		$sqlcommshow = "SELECT * FROM comments ORDER by date ASC";  
		$resultcommshow = mysqli_query($db, $sqlcommshow);
		if(mysqli_num_rows($resultcommshow)>0){
			while($rowcomm = mysqli_fetch_assoc($resultcommshow)){
                echo "<div class='afisare_mesaj'>
                    <div class='nume'>".$rowcomm['name']."</div>
                <div class='continut_mesaj'>".$rowcomm['message']."</div>
                </div>";
			}
		}
	}
?>
<?php
/*---------------------------------------------CHECKOUT----------------------------------------------------------*/
    $firstname="";
    $link=mysqli_connect('localhost','root','','cart');
    $lastname="";
    $phone="";
    $address="";
    $email="";
    $city="";
    $county="";
    $transport="";
    $plata="";
    $postalcode="";
    $country="Romania";
    $id_user="";
    $order_id="";
    $errorinfo=array();
    if(isset($_POST['submit_info']) ){
        $total= $_SESSION['total'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $city=$_POST['city'];
        $postalcode=$_POST['postalcode'];
        $county = $_POST['county'];
        if( isset($_POST['plata']) && isset($_POST['transport'])){
            $transport=$_POST['transport'];
            $plata=$_POST['plata'];
        }
        //Saving user_id
        $id_user = $_SESSION['current_id'];        
        if(empty($firstname)){
            array_push($errorinfo,"Firstname required");
        }
        if(empty($lastname)){
            array_push($errorinfo,"Lastname required");
        }
        if(empty($phone)){
            array_push($errorinfo,"Phone required");
        }
        if(empty($address)){
            array_push($errorinfo,"Address required");
        }
        if(empty($email)){
            array_push($errorinfo,"Email required");
        }
        if(empty($city)){
            array_push($errorinfo,"City required");
        }
        if(empty($county)){
            array_push($errorinfo,"County required");
        }
        if(empty($postalcode)){
            array_push($errorinfo,"Postal code required");
        }
        if(empty($plata)){
            array_push($errorinfo,"The way of paying is required");
        }
        if(empty($transport)){
            array_push($errorinfo,"Transport required");
        }
        if(count($errorinfo)==0){ 
            //ORDERS
            $orders=mysqli_connect('localhost','root','','cart');
            $orders_info ="INSERT INTO orders (total,user_id) VALUES ('$total','$id_user')";
            $resultorders = mysqli_query($orders, $orders_info);
            $orders_info ="SELECT * FROM orders ORDER BY id DESC";
            $resultorders = mysqli_query($orders, $orders_info);
            $i = mysqli_fetch_assoc($resultorders);
            $order_id = $i['id'];            
            $link_info = "INSERT INTO checkout (firstname, lastname, phone, address, email, city, county, postalcode, transport, plata, order_id, user_id) 
            VALUES ('$firstname','$lastname','$phone','$address','$email','$city','$county','$postalcode', '$transport', '$plata','$order_id','$id_user')";
            $linkresult = mysqli_query($link, $link_info);
            
            foreach($_SESSION['shopping_cart'] as $key => $product):
                if($product['type']==1):
                    $id_product = $product['id'];
                    $product_quantity = $product['quantity'];
                    $orders_products_info="INSERT INTO orders_products (quantity,order_id, product_id, user_id) VALUES ('$product_quantity','$order_id','$id_product','$id_user')";
                    $result_orders_products = mysqli_query($orders, $orders_products_info);
                endif;
                if($product['type']==2):
                    $id_product = $product['id'];
                    $product_quantity = $product['quantity'];
                    $orders_products_info="INSERT INTO orders_products (quantity,order_id, manga_id, user_id) VALUES ('$product_quantity','$order_id','$id_product','$id_user')";
                    $result_orders_products = mysqli_query($orders, $orders_products_info);
                endif;
               
   
            endforeach;
            ?>
            <script type="text/javascript">
                alert("Your command was added successfully");
            </script>
            <?php 
        }
	
}
/*----------------------------------------------------ADMIN-------------------------------------------------------*/

?>

<?php
    ///User work
    //1.create:
    $username="";
    $email="";
    $password="";
    $erroruser=array();
    if(isset($_POST['register_admin'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($erroruser, "Username is required");//add error to errors array

        }

        if(empty($email)){
            array_push($erroruser, "Email is required");//add error to errors array
               
        }
        if(empty($password)){
            array_push($erroruser, "Password is required");//add error to errors array       
        }


        //if there are no errors, save user to database
        if(count($erroruser)==0){
            $password = md5($password1);//encrypt password before stoaring in database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email', '$password')";
            mysqli_query($db_user,$sql);
            $_SESSION['message1'] = "User address created";
            header('location: admin_users.php'); //redirect to home page
        }
    }

    //2.List info
    $query_user = "SELECT * FROM users ORDER by id ASC";
    $result_user = mysqli_query($db_user, $query_user);
    //3.Edit    
    $edit_state=false;
    if(isset($_POST['edit_admin'])){
        $username = mysqli_real_escape_string($db_user,$_POST['username']);
        $email = mysqli_real_escape_string($db_user, $_POST['email']);
        $password = mysqli_real_escape_string($db_user, $_POST['password']);
        $id_user = mysqli_real_escape_string($db_user, $_POST['id']);

        if(empty($username)){
            array_push($erroruser, "Username is required");//add error to errors array

        }

        if(empty($email)){
            array_push($erroruser, "Email is required");//add error to errors array
               
        }
        if(empty($password)){
            array_push($erroruser, "Password is required");//add error to errors array       
        }
        //the actual update
        if(count($erroruser)==0){
            $password = md5($password1);//encrypt password before stoaring in database
            mysqli_query($db_user,"UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id_user");
            $_SESSION['message1'] = "User address updated";
            header('location:admin_users.php');
        }
    }
    //4.Delete
    if(isset($_GET['delete_admin'])){
        $theid = $_GET['delete_admin'];
        mysqli_query($db_user,"DELETE FROM users WHERE id=$theid");
        $_SESSION['message1'] = "User address deleted";
        header('location:admin_users.php');

    }
    /*---------------------------------------------BOOK----------------------------------------------------*/
    $name="";
    $writer="";
    $image="";
    $price="";
    $info="";
    $errorbook=array();
    //1.CREATE a new product:
    $products = mysqli_connect('localhost','root','','cart');
    if(isset($_POST['create_book'])){
        $name = $_POST['name'];
        $writer = $_POST['writer'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $info = $_POST['info'];

        //ensure that form fields are filled properly
        if(empty($name)){
            array_push($errorbook, "Name is required");//add error to errors array

        }
        if(empty($writer)){
            array_push($errorbook, "Writer is required");//add error to errors array

        }if(empty($price)){
            array_push($errorbook, "Price is required");//add error to errors array

        } 

        //if there are no errors, save user to database
        if(count($errorbook)==0){
            $sqlbook = "INSERT INTO products (name,writer,image,price,info) VALUES ('$name','$writer','$image','$price','$info')";
            mysqli_query($products,$sqlbook);
            $_SESSION['message2'] = "Book created";
            header('location: admin_products.php'); //redirect to home page
        }
    }
    //2.list info
    $query_products_book = "SELECT * FROM products ORDER by id ASC";
    $result_products_book = mysqli_query($products, $query_products_book);
    //3.edit info
	$edit_state=false;
    if(isset($_POST['edit_book'])){
        $name = mysqli_real_escape_string($products,$_POST['name']);
        $writer = mysqli_real_escape_string($products, $_POST['writer']);
        $image = mysqli_real_escape_string($products, $_POST['image']);
        $price = mysqli_real_escape_string($products, $_POST['price']);
        $info = mysqli_real_escape_string($products, $_POST['info']);
        $id = mysqli_real_escape_string($products, $_POST['id']);

        mysqli_query($products,"UPDATE products SET name='$name', writer='$writer', image='$image', price='$price', info='$info' WHERE id=$id");
        $_SESSION['message2'] = "Book updated";
        header('location:admin_products.php');

    }
    //4.Delete book
    if(isset($_GET['delete_book'])){
        $theid_book = $_GET['delete_book'];
        mysqli_query($products,"DELETE FROM products WHERE id=$theid_book");
        $_SESSION['message2'] = "Book deleted";
        header('location:admin_products.php');
    }

    /*-----------------------------------------MANGA-------------------------------------------------*/

    $name="";
    $writer="";
    $image="";
    $price="";
    $errormanga=array();
    //1.CREATE a new product:
    $products = mysqli_connect('localhost','root','','cart');
    if(isset($_POST['create_manga'])){
        $name = $_POST['name'];
        $writer = $_POST['writer'];
        $image = $_POST['image'];
        $price = $_POST['price'];

        //ensure that form fields are filled properly
        if(empty($name)){
            array_push($errormanga, "Name is required");//add error to errors array

        }
        if(empty($writer)){
            array_push($errormanga, "Writer is required");//add error to errors array

        }if(empty($price)){
            array_push($errormanga, "Price is required");//add error to errors array

        } 

        //if there are no errors, save user to database
        if(count($errormanga)==0){
            $sqlmanga = "INSERT INTO manga (name,writer,image,price) VALUES ('$name','$writer','$image','$price')";
            mysqli_query($products,$sqlmanga);
            $_SESSION['message2'] = "Manga created";
            header('location: admin_products.php'); //redirect to home page
        }
    }
    //2.Manga info
    $query_products_manga = "SELECT * FROM manga ORDER by id ASC";
    $result_products_manga = mysqli_query($products, $query_products_manga);
    //3.EDIT info
	$edit_state1=false;
    if(isset($_POST['edit_manga'])){
        $name = mysqli_real_escape_string($products,$_POST['name']);
        $writer = mysqli_real_escape_string($products, $_POST['writer']);
        $image = mysqli_real_escape_string($products, $_POST['image']);
        $price = mysqli_real_escape_string($products, $_POST['price']);
        $id = mysqli_real_escape_string($products, $_POST['id']);

        mysqli_query($products,"UPDATE manga SET name='$name', writer='$writer', image='$image', price='$price' WHERE id=$id");
        $_SESSION['message2'] = "Manga updated";
        header('location:admin_products.php');

    }
    //4.Delete book
    if(isset($_GET['delete_manga'])){
        $theid_manga = $_GET['delete_manga'];
        mysqli_query($products,"DELETE FROM manga WHERE id=$theid_manga");
        $_SESSION['message2'] = "Manga deleted";
        header('location:admin_products.php');
    }

    /*--------------------------------------------COMMENTS-----------------------------------------------*/
    $name="";
    $message="";
    $errorcomment=array();
    //1.Create a comment
    $comments = mysqli_connect('localhost','root','','registration');
    if(isset($_POST['create_comment'])){
        $name = mysqli_real_escape_string($comments,$_POST['name']);
        $message = mysqli_real_escape_string($comments, $_POST['message']);
       
        //ensure that form fields are filled properly
        if(empty($name)){
            array_push($errorcomment, "Name is required");//add error to errors array

        }
        if(empty($message)){
            array_push($errorcomment, "Message is required");//add error to errors array

        }

        //if there are no errors, save user to database
        if(count($errorcomment)==0){
            $sqlcomments = "INSERT INTO comments (name,message) VALUES ('$name','$message')";
            mysqli_query($comments,$sqlcomments);
            $_SESSION['message3'] = "Comment created";
            header('location: admin_comments.php'); //redirect to home page
        }
    }
    //2.List comments
    $query_comments = "SELECT * FROM comments ORDER by id ASC";
    $result_comments = mysqli_query($comments, $query_comments);
    //3.edit comments
	$edit_state=false;
    if(isset($_POST['edit_comment'])){
        $name = mysqli_real_escape_string($products,$_POST['name']);
        $message = mysqli_real_escape_string($products, $_POST['message']);
        $id_comment = mysqli_real_escape_string($products, $_POST['id']);

        mysqli_query($comments,"UPDATE comments SET name='$name', message='$message' WHERE id=$id_comment");
        $_SESSION['message3'] = "Comment updated";
        header('location:admin_comments.php');

    }
     //4.Delete
     if(isset($_GET['delete_comment'])){
        $theid = $_GET['delete_comment'];
        mysqli_query($db,"DELETE FROM comments WHERE id=$theid");
        $_SESSION['message3'] = "Comment deleted";
        header('location:admin_comments.php');

    }
?>