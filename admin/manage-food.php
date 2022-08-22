<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>

            <br/><br/>
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br/><br/><br/>

                <?php
                    if(isset($_SESSION['add'])){ //Checking whether the session is set of not
                        echo $_SESSION['add']; //Displaying Session Error Message
                        unset($_SESSION['add']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['delete'])){ //Checking whether the session is set of not
                        echo $_SESSION['delete']; //Displaying Session Error Message
                        unset($_SESSION['delete']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['upload'])){ //Checking whether the session is set of not
                        echo $_SESSION['upload']; //Displaying Session Error Message
                        unset($_SESSION['upload']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['unauthorize'])){ //Checking whether the session is set of not
                        echo $_SESSION['unauthorize']; //Displaying Session Error Message
                        unset($_SESSION['unauthorize']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['update'])){ //Checking whether the session is set of not
                        echo $_SESSION['update']; //Displaying Session Error Message
                        unset($_SESSION['update']); //Removing Session Error Message
                    }

                    if(isset($_SESSION['remove-failed'])){ //Checking whether the session is set of not
                        echo $_SESSION['remove-failed']; //Displaying Session Error Message
                        unset($_SESSION['remove-failed']); //Removing Session Error Message
                    }
                ?>

            <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //create sql query to get all the food
                        $sql="SELECT * FROM tbl_food";

                        //execute the query
                        $res=mysqli_query($conn, $sql);

                        //count rows to check whether we have foods or not
                        $count=mysqli_num_rows($res);

                        //create serial number variable and assign value as 1
                        $sn=1;

                        if($count>0){
                            //we have food
                            //get the foods from database and display
                            while($row=mysqli_fetch_assoc($res)){
                                //get the values from individual columns
                                $id=$row['id'];
                                $title=$row['title'];
                                $price=$row['price'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                            <?php
                                                //check whether we have image or not
                                                if($image_name==""){
                                                    //we do not have image, display error message
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }else{
                                                    //we have image, display image
                                                    ?>
                                                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name;?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }else{
                            //food not addded in database
                            echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
                        }
                    ?>



                </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>