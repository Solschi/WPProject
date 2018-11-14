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
                <td><a href="admin_users.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Users</a></td>
                <td><a href="admin_products.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Products</a></td>                
                <td><a href="admin_comments.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Comments</a> </td>
                <td><a href="admin_statistica.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Buyers</a></td>
                <td><a href="login.php?logout='1'" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Log out</a></td>

            </tr>
        </table>
    </div>
</div>
</body>
</html>