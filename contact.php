<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);


   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

if(isset($_POST['send_review'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $review = $_POST['review'];
   $review = filter_var($review, FILTER_SANITIZE_STRING);
   $rate = $_POST['rate'];
   $rate = filter_var($rate, FILTER_SANITIZE_STRING);


   $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE name = ? AND email = ? AND review = ? AND rate = ?");
   $select_reviews->execute([$name, $email, $review, $rate]);

   if($select_reviews->rowCount() > 0){
      $message[] = 'already sent review!';
   }else{
   
      $insert_reviews = $conn->prepare("INSERT INTO `reviews`(user_id, name, email, review, rate) VALUES(?,?,?,?,?)");
      $insert_reviews->execute([$user_id, $name, $email, $review, $rate]);

      $message[] = 'Send review successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

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
   <h3>contact us</h3>
</div>

<!-- contact section starts  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Tell us something!</h3>
         <span>Name</span>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <span>Telephone Number</span>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="enter your number" required maxlength="10">
         <span>Email</span>
         <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
         <span>Message</span>
         <textarea name="msg" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>

   </div>

   </section>

   <section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/review.png" alt="">
      </div>

      <form action="" method="post">
         <h3>Tell us Your feedbacks</h3>
         <span>Name</span>
         <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
         <span>Email</span>
         <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
         <span>Review</span>
         <textarea name="review" class="box" required placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <span>Your Rating</span>
         <input type="number" name="rate" min="1" max="5" class="box" placeholder="rating (1-5) " required maxlength="1">
         <input type="submit" value="send review" name="send_review" class="btn">
         
   
      </form>

   </div>

</section>



<!-- review section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>