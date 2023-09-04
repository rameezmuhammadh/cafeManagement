<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['method'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   /*$number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);*/
   $seat = $_POST['seat'];
   $seat = filter_var($seat, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);
   $time = $_POST['time'];
   $time = filter_var($time, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);


   $select_event = $conn->prepare("SELECT * FROM `event` WHERE name = ?  AND seat = ? AND date = ? AND time = ? AND details = ?");
   $select_event->execute([$name, $seat, $date, $time, $details]);

   if($select_event->rowCount() > 0){
      $message[] = 'already booked!';
   }else{

      $insert_event = $conn->prepare("INSERT INTO `event`(user_id, name,  seat, date, time, details, method) VALUES(?,?,?,?,?,?,?)");
      $insert_event->execute([$user_id, $name,  $seat, $date, $time, $details, $method]);

      $message[] = 'booking successfully!';

   }

}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>event booking</title>

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
   <h3>event booking</h3>
</div>

<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">

         <div class="content"><span>Book a Event</span>
            <h3>Celebrat your party in Our Place</h3>
            <p> We offer you best place celebrate your events and we arragne you for requests</p>
            <a href="#event_table" class="btn">book now</a>
         </div>

         <div class="image">
            <img src="images/event.jpg" alt="">
         </div>
         </div>
      </div>
   </div>

</section>

<!-- event booking section starts  -->

<section class="contact" id="event_table">

   <div class="row">

      <div class="image">
         <img src="images/event-2.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>booking for celebration</h3>
         <span>Name</span>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <span>Date</span>
         <input type="date" name="date" class="box" placeholder="enter your number" required maxlength="10">
         <span>Time</span>
         <input type="time" name="time" maxlength="50" class="box" placeholder="enter your email" required>
         <span>Number of Peoples</span>
         <input type="number" name="seat" maxlength="50" class="box" placeholder="enter your email" required>
         <span>Details</span>
         <textarea name="details" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="booked" name="method" class="btn">
      </form>

   </div>

   </section>







<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>