<?php
  //initialization
  $username = "";
  $email = "";
  $errors = array();

  //connect to the registration database
  $db = mysqli_connect('localhost','root', '', 'registration');
    //admin part
    //1.login:
    if(isset($_POST['register_admin'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");//add error to errors array

        }

        if(empty($email)){
            array_push($errors, "Email is required");//add error to errors array
               
        }
        if(empty($password)){
            array_push($errors, "Password is required");//add error to errors array       
        }


        //if there are no errors, save user to database
        if(count($errors)==0){
            $password = md5($password1);//encrypt password before stoaring in database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email', '$password')";
            mysqli_query($db,$sql);
            $_SESSION['msg'] = "Adress saved";
            header('location: admin_users.php'); //redirect to home page
        }
    }
    //2.List info
    $query_user = "SELECT * FROM users ORDER by id ASC";
    $result_user = mysqli_query($db, $query_user);
    //3.Edit
    $edit_state=false;
    if(isset($_POST['update_admin'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $id = mysqli_real_escape_string($db, $_POST['id']);

        mysqli_query($db,"UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id");
        $_SESSION['msg'] = "Adress updated";
        header('location:admin_users.php');

    }
    //4.Delete
    if(isset($_GET['delete_admin'])){
        $theid = $_GET['delete_admin'];
        mysqli_query($db,"DELETE FROM users WHERE id=$theid");
        $_SESSION['msg'] = "Adress deleted";
        header('location:admin_users.php');

    }

    //logout admin
    if(isset($_GET['logout_admin'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>