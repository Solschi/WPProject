<?php 
    session_start();
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
					'price' => filter_input(INPUT_POST, 'price'),
					'quantity' => filter_input(INPUT_POST, 'quantity')
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
				'price' => filter_input(INPUT_POST, 'price'),
				'quantity' => filter_input(INPUT_POST, 'quantity')
			);
		}
	}
?>