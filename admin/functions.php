<?php 

function insert_categories() {
	global $connection;
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

}

function findAllCategories() {
  global $connection;
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
}

function deleteCategory() {
  global $connection;
  $cat_id_delete = $_GET['delete'];
  $query = "DELETE FROM categories WHERE cat_id={$cat_id_delete}";

  $delete_query = mysqli_query($connection, $query);
  header('Location: categories.php');
}






?>