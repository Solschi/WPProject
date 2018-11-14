<?php include 'wheretosave.php' ;
 //if user is not logged in they cannot acces this page
 if(empty($_SESSION['username'])){
    header('location: login.php');
}
?>
<?php
//fetch the record to be updat
    if(isset($_GET['edit_comment'])){
        //saving the id
        $id_comment = $_GET['edit_comment'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM comments WHERE id = $id_comment");
        $result_comm = mysqli_fetch_array($rec);
        $name = $result_comm['name'];
        $message = $result_comm['message'];
        $id_comment = $result_comm['id'];
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
    <hr style="color:green"/>
    <div class="top_menu">   
    <table class="nav_bar">
            <tr>
                <td><a href="admin.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Start</a> </td>
                <td><a href="admin_users.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Users</a></td>
                <td><a href="admin_products.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Products</a></td>                
                <td><a href="admin_statistica.php" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Buyers</a></td>
                <td><a href="login.php?logout='1'" class="btn btn-outline-success btn-lg btn-block" style="color:#66ff99; border:1px solid #66ff99">Log out</a></td>

            </tr>
        </table>

        <table class="table_comment">
            <tr style="border-bottom: 1px solid white">
                <td width="20%">Name</td>
                <td width="40%">Message</td>
                <td colspan="2">Action</td>
            </tr>
        <?php
        if($result_comments):
            //if is not empty
            if(mysqli_num_rows($result_comments)>0):
                while($comment = mysqli_fetch_assoc($result_comments)):
                    ?>
                    <tr>
                            <td><?php echo $comment['name'];?></td>
                            <td><?php echo $comment['message']; ?></td>
                            <td><a href="admin_comments.php?edit_comment=<?php echo $comment['id'];?>" class="btn btn-info" style="color:black">Edit</a></td>
                            <td><a href="wheretosave.php?delete_comment=<?php echo $comment['id'];?>" class="btn btn-danger" style="color:black">Delete</a></td>
                        </tr>
                <?php
                endwhile;
            endif;
        endif;
        ?>
        </table>
    <div class="mesaj">
    <?php if(isset($_SESSION['message3'])): ?>
        <?php   echo $_SESSION['message3']; 
                //unset($_SESSION['message3']);
         ?>
        <?php endif; ?>
    </div>
        <form method="POST" action="admin_comments.php">		

        <?php include 'errors.php'; ?>
        <div class="chenar_comment">
            <input type="hidden" name="id" value="<?php echo $id_comment; ?>"/>
            <label>Name</label><br/>
            <input type="text" name="name" class="insert_data" value="<?php echo $name; ?>"/><br/><br/>
            <label>Message</label><br/>
            <input type="text" name="message" class="insert_data" value="<?php echo $message; ?>"/><br/><br/>
           
            <?php if($edit_state == false): ?>
            <button type="submit" class="btn btn-success" style="background-color: #66ff99; color:black" name="create_comment">Create</button>
            <?php else : ?>
            <button type="submit" class="btn btn-primary" name="edit_comment" style="color:black">Update</button>
            <?php endif; ?>
        </div>
    </form>
    <br/>
</body>
</html>