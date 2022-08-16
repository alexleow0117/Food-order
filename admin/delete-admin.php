<?php
    
    //Include constants.php file here
    include('../config/constants.php');

    //1. get the ID of admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true){
        //Query executed successfully and Admin deleted
        //echo"Admin Deleted";
        //Create Session Variable to display message
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
        // Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        //Failed to Delete Admin
        //echo"Failed to Deleted Admin";
        $_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try again</div>";
        // Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    //3. Redirect to Manage Admin page with message (success/error) 

?>
