<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br/><br/>

            <?php
                    if(isset($_SESSION['add'])){ //Checking whether the session is set of not
                        echo $_SESSION['add']; //Displaying Session Error Message
                        unset($_SESSION['add']); //Removing Session Error Message
                    }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter your name">
                            <?php
                                if(isset($_POST['full_name']) && empty($_POST['full_name'])){
                                    echo "<span class=\"errorMessage\">Please enter your Full Name</span>";
                                }
                            ?>
                        </td>

                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" placeholder="Enter your username">
                            <?php
                                if(isset($_POST['username']) && empty($_POST['username'])){
                                    echo "Please enter your Username";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter your password">
                            <?php
                                if(isset($_POST['password']) && empty($_POST['password'])){
                                    echo "Please enter your Password";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                        
                    </tr>

                </table>

            </form>
        </div>
    </div>


<?php include('partials/footer.php'); ?>

<?php 
    // Process the value from Form and save it in database
    // Check whether the button is clicked or not

    if(isset($_POST['submit'])){
        // Button Clicked
        // echo "Button Clicked";

        //1. Get the Data from Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        $flag = true;

        if(empty($_POST['full_name'])){
            $flag = false;
        }

        if($flag == true){
            //2. SQL Query to save the data into database
            $sql="INSERT INTO tbl_admin SET
                full_name='$full_name',
                username='$username',
                password='$password'
            ";

            //3. Execute Query and save data in database
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
            if($res==TRUE){
                // Date inserted
                // echo "Data inserted";
                // Create a Session Variable to display message
                $_SESSION['add'] ="Admin Added Successfully";
                // Redirect Page to Manage Admin
                header("location:".SITEURL.'admin/manage-admin.php');
            }else{
                // Failed to inserted data
                // echo "Failed to insert data";
                // Create a Session Variable to display message
                $_SESSION['add'] ="Failed to Add Admin";
                // Redirect Page to Add Admin
                header("location:".SITEURL.'admin/add-admin.php');
            }
        }


    }
?>