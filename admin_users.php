<?php include 'wheretosave.php' ;
 //if user is not logged in they cannot acces this page
 if(empty($_SESSION['username'])){
    header('location: login.php');
}
?>
<?php
//fetch the record to be updat
    if(isset($_GET['edit_admin'])){
        //saving the id
        $id_user = $_GET['edit_admin'];
        $edit_state = true;
        $reces = mysqli_query($db_user, "SELECT * FROM users WHERE id = $id_user");
        $result_users = mysqli_fetch_array($reces);
        $username = $result_users['username'];
        $email = $result_users['email'];
        $password = $result_users['password'];
        $id_user = $result_users['id'];
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Users</title>
		<link rel="Icon" type="image/png" href="bookicon.png" class="icon" size="96x96">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href='admin.css' rel='stylesheet'>
	</head>
	<body>
    <img src="admin.png" class="img_admin"/>
    <div class="welcome">
    <?php if(isset($_SESSION['username'])): ?>
		<?php echo $_SESSION['username']; ?>
    <?php endif; ?>
    </div>
    <hr/>
    <div class="top_menu">   
    <table class="nav_bar">
            <tr>
                <td><a href="admin.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Start</a></td>
                <td><a href="admin_products.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Products</a> </td>
                <td><a href="admin_comments.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Comments</a></td>                
                <td><a href="admin_statistica.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Buyers</a></td>
                <td><a href="login.php?logout='1'" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Log out</a></td>

            </tr>
        </table>

        <div class="centru_left">
        <table class="table_user">
            <tr style="border-bottom: 1px solid #66ff99; font-weight:bold">
                <td width="40%">Username</td>
                <td width="40%">Email</td>
                <td colspan="2">Action</td>
            </tr>
        <?php
            //if is not empty
                while($user = mysqli_fetch_assoc($result_user)):
                    if($user['type']==0):?>
                        <tr>
                            <td><?php echo $user['username'];?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><a href="admin_users.php?edit_admin=<?php echo $user['id'];?>"  style="color:black" class="btn btn-info">Edit</a></td>
                            <td><a href="wheretosave.php?delete_admin=<?php echo $user['id'];?>"  style="color:black" class="btn btn-danger">Delete</a></td>
                        </tr>
                <?php endif;
                endwhile;
        ?>
        </table>
    </div>
    <div class="mesaj">
    <?php   if(isset($_SESSION['message1'])):
                echo $_SESSION['message1'];
              // unset($_SESSION['message1']); 
    endif; ?>
    </div>
        <form method="POST" action="admin_users.php">		

        <?php include('erroruser.php'); ?>
        <div class="chenar">
            <input type="hidden" name="id" value="<?php echo $id_user;?>"/>
            <label>Username</label>
            <input type="text" name="username" class="insert_data" value="<?php echo $username; ?>"/><br/><br/>
            <label>Email</label>
            <input type="text" name="email" class="insert_data" value="<?php echo $email; ?>"/><br/><br/>
            <label>Password</label>
            <input type="password" class="insert_data" name="password"><br/><br/>
            <?php if($edit_state == false): ?>
            <button type="submit" class="btn btn-success" style="color:black; background-color:#66ff99" name="register_admin">Create</button>
            <?php else : ?>
            <button type="submit" class="btn btn-primary" style="color:black" name="edit_admin">Update</button>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>