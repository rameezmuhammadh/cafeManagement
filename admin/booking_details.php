<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_booked_tables = $conn->prepare("DELETE FROM `booked_tables` WHERE id = ?");
   $delete_booked_tables->execute([$delete_id]);
   header('location:booking_details.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>booking details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Booking Details</h1>

   <div class="box-container">

   <?php
      $select_booked_tables = $conn->prepare("SELECT * FROM `booked_tables`");
      $select_booked_tables->execute();
      if($select_booked_tables->rowCount() > 0){
         while($fetch_booked_tables = $select_booked_tables->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_booked_tables['user_id']; ?></span> </p>
      <p> table name : <span><?= $fetch_booked_tables['table_name']; ?></span> </p>
      <p> chairs : <span><?= $fetch_booked_tables['t_size']; ?></span> </p>
      <p> table name : <span><?= $fetch_booked_tables['book_time']; ?></span> </p>
      <p> name : <span><?= $fetch_booked_tables['name']; ?></span> </p>
      <p> email : <span><?= $fetch_booked_tables['email']; ?></span> </p>
      <p> book : <span><?= $fetch_booked_tables['booked']; ?></span> </p>

      <form action="" method="POST">
         <input type="hidden" name="table_id" value="<?= $fetch_book['id']; ?>">
         
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no table booked yet!</p>';
   }
   ?>

   </div>

</section>

<!-- placed orders section ends -->