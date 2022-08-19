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
            $path="../images/category/".$image_name;
            //remove the image
            $remove=unlink($path);

            //if failed to remove image then add error message and stop the process
            if($remove==false){
                //set the session message
                $_SESSION['remove']="<div class='error'>Failed to Delete Category Image.</div>";
                //redirect to manage category page
                header("location:".SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete from database
        $sql="DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn, $sql);

        //check whether the data is delete from database or not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
            //redirect to manage category page
            header("location:".SITEURL.'admin/manage-category.php');
        }else{
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage category page
            header("location:".SITEURL.'admin/manage-category.php');
        }

    }else{
        //redirect to manage category page
        header("location:".SITEURL.'admin/manage-category.php');
    }
?>