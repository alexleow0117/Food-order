<?php

    //Include constants.php file here
    include('../config/constants.php');

    //check whether the id and image name value is set or not
    if(isset($_GET['id']) and isset($_GET['image_name'])){
        //get the value and delete
        //echo "get value and delete";

        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical image file is available
        if($image_name !=""){
            //image is available. So remove it
            $path="../images/food/".$image_name;
            //remove the image
            $remove=unlink($path);

            //if failed to remove image then add error message and stop the process
            if($remove==false){
                //set the session message
                $_SESSION['upload']="<div class='error'>Failed to Delete Food Image.</div>";
                //redirect to manage food page
                header("location:".SITEURL.'admin/manage-food.php');
                //stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete from database
        $sql="DELETE FROM tbl_food WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn, $sql);

        //check whether the data is delete from database or not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
            //redirect to manage food page
            header("location:".SITEURL.'admin/manage-food.php');
        }else{
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
            //redirect to manage food page
            header("location:".SITEURL.'admin/manage-food.php');
        }

    }else{
        //redirect to manage food page
        $_SESSION['unauthorize']="<div class='error'>Unauthorize Access.</div>";
        header("location:".SITEURL.'admin/manage-food.php');
    }

?>