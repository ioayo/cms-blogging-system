<form action="" method="post">
     <?php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
            $select_categories_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" id="cat-title" class="form-control" type="text" name="cat_title" />
    <?php } ?> 
     <?php //DELETE CATEGORY QUERY 
        if (isset($_POST['update_category'])) {
            $cat_id_update = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title='{$cat_id_update}' WHERE cat_id={$cat_id}";

            $update_query = mysqli_query($connection, $query);

            if(!$update_query) {
                die("query failed" . mysqli_error($connection));
            };
            header('Location: categories.php');

        }
    ?>

    </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category" />
        </div>
    </form>
<?php } ?>