<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:booking.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

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
   <h3>booking details</h3>
</div>

<section class="orders">

   <h1 class="title">your table booking details</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your tables</p>';
      }else{
         $select_booked_tables = $conn->prepare("SELECT * FROM `booked_tables` WHERE user_id = ?");
         $select_booked_tables->execute([$user_id]);
         if($select_booked_tables->rowCount() > 0){
            while($fetch_booked_tables = $select_booked_tables->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">

      <p>table name : <span><?= $fetch_booked_tables ['table_name']; ?></span></p>
      <p>chairs : <span><?= $fetch_booked_tables ['t_size']; ?></span></p>
      <p>booking time : <span><?= $fetch_booked_tables ['book_time']; ?></span></p>
      <p>user name : <span><?= $fetch_booked_tables ['name']; ?></span></p>
      <p>email : <span><?= $fetch_booked_tables ['email']; ?></span></p>
      <p>number : <span><?= $fetch_booked_tables ['number']; ?></span></p>
      <p>booked : <span><?= $fetch_booked_tables ['booked']; ?></span></p>
      

   </div>
   <?php
      }
      }else{
         echo '<p class="empty">no booked yet!</p>';
      }
      }
   ?>

   </div>

</section>

<section class="orders">

   <h1 class="title">your EVENT booking details</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your tables</p>';
      }else{
         $select_event = $conn->prepare("SELECT * FROM `event` WHERE user_id = ?");
         $select_event->execute([$user_id]);
         if($select_event->rowCount() > 0){
            while($fetch_event = $select_event->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>event name : <span><?= $fetch_event ['details']; ?></span></p>
      <p>Date : <span><?= $fetch_event ['date']; ?></span></p>
      <p>booking time : <span><?= $fetch_event ['time']; ?></span></p>
      <p>user name : <span><?= $fetch_event ['name']; ?></span></p>
      <p>email : <span><?= $fetch_profile ['email']; ?></span></p>
      <p>number : <span><?= $fetch_profile ['number']; ?></span></p>
      <p>booked : <span><?= $fetch_event ['method']; ?></span></p>
      

   </div>
   <?php
      }
      }else{
         echo '<p class="empty">no booked yet!</p>';
      }
      }
   ?>

   </div>

</section>








<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>