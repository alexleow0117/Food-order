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

                    <tr>
                        <td>1. </td>
                        <td>AlexLeow</td>
                        <td>Alex</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Category</a>
                            <a href="#" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>