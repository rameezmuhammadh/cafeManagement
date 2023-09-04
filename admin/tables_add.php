<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_table'])){

   $table_name = $_POST['table_name'];
   $table_name = filter_var($table_name, FILTER_SANITIZE_STRING);
   $t_size = $_POST['t_size'];
   $t_size = filter_var($t_size, FILTER_SANITIZE_STRING);
   $book_time = $_POST['book_time'];
   $book_time = filter_var($book_time, FILTER_SANITIZE_STRING);
   $t_category = $_POST['t_category'];
   $t_category = filter_var($t_category, FILTER_SANITIZE_STRING);

   $select_book_tables = $conn->prepare("SELECT * FROM `book_tables` WHERE table_name = ? AND t_category =? AND t_size =? AND book_time =? ");
   $select_book_tables->execute([$table_name, $t_category, $t_size, $book_time]);

   if($select_book_tables->rowCount() > 0){

      $message[] = 'this table already exists!!';
   }
   else{

   $insert_book_tables = $conn->prepare("INSERT INTO `book_tables`(table_name, t_size,  book_time, t_category) VALUES(?,?,?,?)");
   $insert_book_tables ->execute([$table_name, $t_size, $book_time, $t_category]);

         $message[] = 'new table added!';

      }
   }



if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_book_tables = $conn->prepare("DELETE FROM `book_tables` WHERE table_id = ?");
   $delete_book_tables ->execute([$delete_id]);
   $delete_tables = $conn->prepare("DELETE FROM `tables` WHERE tid = ?");
   $delete_tables ->execute([$delete_id]);
   header('location:tables_add.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add table</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add table section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add table</h3>
      <input type="text" required placeholder="enter table name" name="table_name" maxlength="100" class="box">
      <input type="text" required placeholder="enter booking time" name="book_time" maxlength="100" class="box">
      <input type="text" required placeholder="enter chairs count" name="t_size" maxlength="100" class="box">
      <select name="t_category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="Lunch Table">lunch table</option>
         <option value="Dinner Table">dinner table</option>
      </select>
      
      <input type="submit" value="add_table" name="add_table" class="btn">
   </form>

</section>

<!-- add table section ends -->

<!-- show table section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_book_tables  = $conn->prepare("SELECT * FROM `book_tables`");
      $show_book_tables ->execute();
      if($show_book_tables ->rowCount() > 0){
         while($fetch_book_tables  = $show_book_tables ->fetch(PDO::FETCH_ASSOC)){  
   ?>

   <div class="box">

      <div class="flex">

         <h3 class="name"><?= $fetch_book_tables ['table_name']; ?></h3>

         <p class="category"><?= $fetch_book_tables ['book_time']; ?></p>

         <p class="category"><?= $fetch_book_tables ['t_size']; ?></p>

         <p class="category"><?= $fetch_book_tables ['t_category']; ?></p>
         
      </div>
      
      <div class="flex-btn">
         <a href="tables_add.php?delete=<?= $fetch_book_tables['table_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>

   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no table added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show table section ends -->








<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>