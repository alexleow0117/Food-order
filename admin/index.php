<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login']; //Displaying Session Message
                        unset($_SESSION['login']); //Removing Session Message
                    }
                ?>
                <br><br>
                <div class="bgborder col-4 text-center">
                    <h1>5</h1>
                    Categories
                </div>

                <div class="bgborder col-4 text-center">
                    <h1>5</h1>
                    Categories
                </div>

                <div class="bgborder col-4 text-center">
                    <h1>5</h1>
                    Categories
                </div>

                <div class="bgborder col-4 text-center">
                    <h1>5</h1>
                    Categories
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>