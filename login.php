<?php

    $conn = mysqli_connect('localhost','root','','studentsgate') or die('Error in connection');

    if($_POST){

        if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['username'])) {
            $userNameErr = "Only letters and white space allowed in username";
        }else{
            $username = htmlspecialchars($_POST['username']);
        }
        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
            
        }else{
            $passwordErr = "password is empty";   
        }

        
        $query = "select * from users where username = '$username' ";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            
            if($row['username'] == $username && $row['password'] ==  $password){
                session_start();
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                header("location:home.php");
                // echo "Logged in!";
            }else{
                $error = 'username or password error';
            }
        }else{
            $error = 'username or password error';
        }

        if(isset($_SESSION['id'])){
            header("location:home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>home</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/font-awesome.min.css">

        
    </head>
    <body class="sb-nav-fixed">
        <div class="container login-box">
            

            <?php
            
                if(!empty($error)){
                    echo "<h3 style='background-color: red;'> $error </h3>";
                }
                if(!empty($userNameErr)){
                    echo "<h3 style='background-color: red;'> $userNameErr </h3>";
                }
                if(!empty($passwordErr)){
                    echo "<h3 style='background-color: red;'> $passwordErr </h3>";
                }
                
            ?>

            <div class="row justify-content-center">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h1 class="text-center font-weight-light my-4">Welcome in Students Gate</h1></div>
                    <div class="card-body">
                        <form method="post" action="login.php">
                            <div class="row mb-3">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="username">User Name:</label>
                                    <input type="text" class="form-control" name="username" id="username" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="pwd">Password:</label>
                                    <input type="password" class="form-control"  name="password" id="password" require>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-primary col-lg-6 col-md-6">Login</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </body>
</html>