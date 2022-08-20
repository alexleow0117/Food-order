<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>

            <br/><br/>

            <?php
                    if(isset($_SESSION['add'])){ //Checking whether the session is set of not
                        echo $_SESSION['add']; //Displaying Session Error Message
                        unset($_SESSION['add']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['remove'])){ //Checking whether the session is set of not
                        echo $_SESSION['remove']; //Displaying Session Error Message
                        unset($_SESSION['remove']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['delete'])){ //Checking whether the session is set of not
                        echo $_SESSION['delete']; //Displaying Session Error Message
                        unset($_SESSION['delete']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['no-category-found'])){ //Checking whether the session is set of not
                        echo $_SESSION['no-category-found']; //Displaying Session Error Message
                        unset($_SESSION['no-category-found']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['update'])){ //Checking whether the session is set of not
                        echo $_SESSION['update']; //Displaying Session Error Message
                        unset($_SESSION['update']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['upload'])){ //Checking whether the session is set of not
                        echo $_SESSION['upload']; //Displaying Session Error Message
                        unset($_SESSION['upload']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['failed-remove'])){ //Checking whether the session is set of not
                        echo $_SESSION['failed-remove']; //Displaying Session Error Message
                        unset($_SESSION['failed-remove']); //Removing Session Error Message
                    }
            ?>

            <br/><br/>

                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //query to get all category
                        $sql="SELECT * FROM tbl_category";

                        //execute query
                        $res=mysqli_query($conn, $sql);

                        //count rows
                        $count=mysqli_num_rows($res);

                        //create serial number variable and assign value as 1
                        $sn=1;

                        //check whether we have data in database or not
                        if($count>0){
                            //we have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res)){
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php
                                                //check whether image name is availble or not
                                                if($image_name!=""){
                                                    //display the image
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }else{
                                                    //display the error message 
                                                    echo "<div class='error'>Image not added.</div>";
                                                }
                                            ?>
                                            
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>
                                <?php
                            }

                        }else{
                            //we do not have data
                            //we will display the message inside table
                            ?>
                                <tr>
                                    <td colspan="6"><div class="error">No Category Added.</div></td>
                                </tr>

                            <?php
                        }
                    ?>



                </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>