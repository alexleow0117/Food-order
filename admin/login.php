<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>
            Login -Food Order System
        </title>
        <link rel="stylesheet" href="../css/admin.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login']; //Displaying Session Message
                    unset($_SESSION['login']); //Removing Session Message
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message']; //Displaying Session Message
                    unset($_SESSION['no-login-message']); //Removing Session Message
                }
            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                <br>
                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>
            <!-- Login Form Ends Here -->
            <br><br>
            <p class="text-center">Create By - Alex</a></p>
        </div>
    </body>

</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //process for login
        //1. get the data from login form
        //$username=$_POST['username'];
        $username=mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password=md5($_POST['password']);
        $password=mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the query
        $res=mysqli_query($conn,$sql);

        //4. count rows to check whether the user exists or not
        $count=mysqli_num_rows($res);

        if($count==1){
            //User available and login success
            $_SESSION['login']= "<div class='success'>Login Sucessful.</div>";
            $_SESSION['user']=$username; // to check whether the user is logged in or not and logout will unset it

            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/');
        }else{
            //User not available and login fail
            $_SESSION['login']= "<div class='error text-center'>Login Failed.</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/login.php');
        }
    }

?>