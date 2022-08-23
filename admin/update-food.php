<?php include('partials/menu.php'); ?>

            <?php
                //check whether the id is set or not
                if(isset($_GET['id'])){
                    //Get the ID and all other details
                    //echo "Get data";
                    $id=$_GET['id'];
                    //create sql query to get all other details
                    $sql2="SELECT * FROM tbl_food WHERE id=$id";

                    $res2=mysqli_query($conn, $sql2);

                    //get the value based on query executed
                    $row2=mysqli_fetch_assoc($res2);

                    
                    //get the individual values of selected food    
                    $title=$row2['title'];
                    $description=$row2['description'];
                    $price=$row2['price'];
                    $current_image=$row2['image_name'];
                    $current_category=$row2['category_id'];
                    $featured=$row2['featured'];
                    $active=$row2['active'];
                    
                }else{
                    //redirect to manage food
                    header("location:".SITEURL.'admin/manage-food.php');
                }
            ?>

            <?php
                if(isset($_POST['submit'])){
                    //echo "checked";
                    //1. get all the values from our form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $current_image=$_POST['current_image'];
                    $category=$_POST['category'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    //2. updating new image if selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name'])){
                        //get the image details
                        $image_name=$_FILES['image']['name'];

                        //check whether the image is available or not
                        if($image_name !=""){
                            //image available
                            //A. upload the new image

                            //auto rename our image
                            //get the extension of our image(jpg, png, gif, etc) e.g. "special.food1.jpg"
                            $buffer=explode('.',$image_name);
                            $ext=end($buffer);

                            //rename the image
                            $image_name="Food-Name-".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg
                            
                            //get the source path and destination path
                            $src_path=$_FILES['image']['tmp_name'];
                            $dest_path="../images/food/".$image_name;

                            //finally upload  the image
                            $upload=move_uploaded_file($src_path,$dest_path);

                            //check whether the image is uploaded or not
                            //and if the image is not upload then we will stop the process and redirect with error message
                            if($upload==false){
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                                // Redirect Page to Manage Food
                                header("location:".SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }

                            //B. remove the current image if available
                            if($current_image!=""){
                                //current image is availalbe
                                //remove the image
                                $remove_path="../images/food/".$current_image;

                                $remove=unlink($remove_path);
    
                                //check whether the image is remove or not
                                //if failed to remove then display message and stop the process
                                if($remove==false){
                                    //failed to remove image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image.</div>";
                                    header("location:".SITEURL.'admin/manage-food.php');
                                    die();//stop the process
                                }
                            }

                        }else{
                            $image_name=$current_image; //default image when image is not selected
                        }

                    }else{
                        $image_name=$current_image; //default image when button is not clicked
                    }

                    //3. update the database
                    $sql3="UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                    ";
                    //execute the query
                    $res3=mysqli_query($conn, $sql3);

                    //4. redirect to manage category with message
                    //check whether executed or not
                    if($res3==true){
                        //categiry updated
                        $_SESSION['update']="<div class='success'>Food Updated Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }else{
                        //failed to update category
                        $_SESSION['update']="<div class='error'>Failed to update food.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>

            <br><br>

            

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image !=""){
                                    //display the image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                }else{
                                    //display error message
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image:</td>
                        <td>
                            <input type="file" name="image" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">

                                <?php
                                    //query to get active categories
                                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                    //execute the query
                                    $res=mysqli_query($conn, $sql);
                                    //count rows
                                    $count=mysqli_num_rows($res);

                                    //check whether category available or not
                                    if($count>0){
                                        //category available
                                        while($row=mysqli_fetch_assoc($res)){
                                            $category_title=$row['title'];
                                            $category_id=$row['id'];

                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                            <?php
                                        }
                                    }else{
                                        //category not available
                                        echo "<option value='0'>Category Not Available.</option>";
                                    }
                                ?>

                                
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked"; } ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked"; } ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

            

        </div>
    </div>

<?php include('partials/footer.php'); ?>