<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_event = $conn->prepare("DELETE FROM `event` WHERE id = ?");
   $delete_event->execute([$delete_id]);
   header('location:event_details.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Events Requests</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Event Requests</h1>

   <div class="box-container">

   <?php
      $select_event = $conn->prepare("SELECT * FROM `event`");
      $select_event->execute();
      if($select_event->rowCount() > 0){
         while($fetch_event = $select_event->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_event['user_id']; ?></span> </p>
      <p> event name : <span><?= $fetch_event['details']; ?></span> </p>
      <p> event time : <span><?= $fetch_event['time']; ?></span> </p>
      <p> name : <span><?= $fetch_event['name']; ?></span> </p>
      <p> email : <span><?= $fetch_event['email']; ?></span> </p>
      <p> book : <span><?= $fetch_event['method']; ?></span> </p>

      <form action="" method="POST">
         <input type="hidden" name="id" value="<?= $fetch_event['id']; ?>">
         
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no event booked yet!</p>';
   }
   ?>

   </div>

</section>

<!-- placed orders section ends -->