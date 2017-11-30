<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">

                            <?php 
                                if (isset($_POST['submit'])) {
                                    $cat_title = $_POST['cat_title'];

                                    if ($cat_title == '' || empty($cat_title)) {
                                        echo "<div class='alert alert-danger' role='alert'>
                                                This field should not be empty
                                            </div>";
                                    } else {

                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUE('{$cat_title}')";

                                        $create_category_query = mysqli_query($connection, $query);

                                        if (!$create_category_query) {
                                            die('Query Failed ' . mysqli_error($connection));
                                        };
 
                                    }
                                }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input id="cat-title" class="form-control" type="text" name="cat_title" />
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category" />
                                </div>
                            </form>
                            
                                    
                                    <?php
                                        if (isset($_GET['edit'])) {
                                            $cat_id = $_GET['edit'];
                                            $query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
                                            $select_categories_id = mysqli_query($connection, $query);

                                        while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            ?>
                                        <form action="" method="post">
                                        <div class="form-group">
                                            <label for="cat-title">Edit Category</label>
                                        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" id="cat-title" class="form-control" type="text" name="cat_title" />
                                        <?php } ?> 
                                    
                                        </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="submit" name="submit" value="Update Category" />
                                            </div>
                                        </form>
                                    <?php } ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //FIND ALL CATEGORIES QUERY
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);

                                         while ($row = mysqli_fetch_assoc($select_categories)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>
                                                    <td>{$cat_id}</td>
                                                    <td>{$cat_title}</td>
                                                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                                                    <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                                                </tr>";
                                        }
                                    ?>

                                    <?php //DELETE CATEGORY QUERY 
                                        if (isset($_GET['delete'])) {
                                            $cat_id_delete = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE cat_id={$cat_id_delete}";

                                            $delete_query = mysqli_query($connection, $query);
                                            header('Location: categories.php');

                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>