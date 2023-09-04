<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['booked'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $tid = $_POST['tid'];
   $tid = filter_var($tid, FILTER_SANITIZE_STRING);
   $table_name = $_POST['table_name'];
   $table_name = filter_var($table_name, FILTER_SANITIZE_STRING);
   $t_size = $_POST['t_size'];
   $t_size = filter_var($t_size, FILTER_SANITIZE_STRING);
   $book_time = $_POST['book_time'];
   $book_time = filter_var($book_time, FILTER_SANITIZE_STRING);
   $booked = $_POST['booked'];
   $booked = filter_var($booked, FILTER_SANITIZE_STRING);
   $placed_on = $_POST['placed_on'];
   $placed_on = filter_var($placed_on, FILTER_SANITIZE_STRING);

   $check_booked_tables_numbers = $conn->prepare("SELECT * FROM `booked_tables` WHERE id = ? AND user_id = ?");
   $check_booked_tables_numbers->execute([$tid, $user_id]);

   $check_tables = $conn->prepare("SELECT * FROM `tables` WHERE user_id = ?");
   $check_tables->execute([$user_id]);

   if($check_booked_tables_numbers->rowCount() > 0){
      $message[] = 'table booked successfully!';
   }
   elseif($check_tables->rowCount() > 0){
         
      $insert_booked_tables = $conn->prepare("INSERT INTO `booked_tables`(user_id, tid, name, email, number,table_name,  t_size, book_time, booked, placed_on) VALUES(?,?,?,?,?,?,?,?,?,?)");
      $insert_booked_tables->execute([$user_id, $tid, $name, $email, $number, $table_name, $t_size, $book_time, $booked, $placed_on]);

      if($booked == 'book'){

         $delete_tables = $conn->prepare("DELETE FROM `tables` WHERE user_id = ?");
         $delete_tables->execute([$user_id]);

         $message[] = 'table is booked!';
         header('location:bookings.php');}
   }else{
      $message[] = 'already booked!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>table checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>checkout</h3>
</div>

<section class="checkout">

   <h1 class="title">summary</h1>

<form action="" method="post">

   <div class="cart-items">

      <h3>table details</h3>

      <?php
         $select_tables = $conn->prepare("SELECT * FROM `tables` WHERE user_id = ?");
         $select_tables->execute([$user_id]);
         if($select_tables->rowCount() > 0){
            $fetch_tables = $select_tables->fetch(PDO::FETCH_ASSOC);

      ?>

      <input type="hidden" name="tid" value="<?= $fetch_tables['tid']; ?>">
      <input type="hidden" name="table_name" value="<?= $fetch_tables['table_name']; ?>">
      <input type="hidden" name="book_time" value="<?= $fetch_tables['book_time']; ?>">
      <input type="hidden" name="t_size" value="<?= $fetch_tables['t_size']; ?>">
      <input type="hidden" name="booked" value="<?= $fetch_tables['status']; ?>">

      <p>Table Name :<span class="name"><?= $fetch_tables['table_name']; ?></span></p>
      <p>Booking Time :<span class="name"><?= $fetch_tables['book_time']; ?></span></p>
      <p>Booked Chairs :<span class="name"><?= $fetch_tables['t_size']; ?></span></p>

      <?php
            }else{
               echo '<p class="empty">your table is empty!</p>'; 
            }
      ?>
     
   </div></br>

   <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">


   <div class="user-info">

      <h3>your info</h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
       
      <a href="update_profile.php" class="click_btn">update info</a>
   </br> </br> </br> </br>

   <div class="box">
      <p>Once if you book you can't cancel but you can inform us </p>
      
   </div>
      <input type="hidden" name="placed_on" value="<?= $fetch_booked_tables[date('Y-m-d')]; ?>">
      
      <input type="submit" value="book" name="booked" class="btn <?php if($fetch_tables['user_id'] == ''){echo 'disabled';} ?>" >
      
   </div>

</form>
   
</section>









<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>