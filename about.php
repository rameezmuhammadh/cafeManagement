<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
   <h3>About us</h3>
</div>

<!-- about section starts  -->

<section class="about">

   

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3 class="about-heading">why choose us?</h3>
         <p>Restaurants range from expensive and informal launching or dining places catering to people working nearby, with modest food served in low prices.</p>
         
         <div class="icons-container">
            <div class="icons">
                <img src="images/serv-1.png" alt="">
                <h3>Fast Delivery</h3>
            </div>  
            <div class="icons">
                <img src="images/serv-2.png" alt="">
                <h3>Fresh Food</h3>
            </div>   
            <div class="icons">
                <img src="images/serv-3.png" alt="">
                <h3>Best Quality</h3>
            </div>  
            <div class="icons">
                <img src="images/serv-4.png" alt="">
                <h3>24/7 Support</h3>
            </div>           
        </div>
         
      </div>

   

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>order online</h3>
         <p>Order Our delius food from your place</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>We will deliver your foods in your place</p>
      </div>

      <div class="box">
         <img src="images/step-3.svg" alt="">
         <h3>enjoy food</h3>
         <p>enjoy meal you ordered.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->



   

  

</section>

<!-- reviews section starts -->

<!-- Tring php reviews ------>


<section class="reviews"> 

    <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         
       
              
          <?php
            $select_reviews = $conn->prepare("SELECT * FROM `reviews`
            LIMIT 15");
            $select_reviews->execute();
            if($select_reviews->rowCount() > 0){
            while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
         ?>

         <div class="swiper-slide slide">

            <p><span><?= $fetch_reviews['review']; ?></span></p>

           <?php 
               $rate = $fetch_reviews['rate'];
           if ($rate ==1  ){

            echo 
         
            '<div class="stars"> 
                  <i class="fas fa-star"></i>
            </div>';
      
           }
           elseif ($rate ==2) {

             echo 
            '<div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
           ';
           }
           elseif($rate ==3){

            echo '
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>';
           
           }
           elseif($rate ==4){

            echo '
         <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>';
           
           }
           else {
            echo '
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>';
           
           }

           
           ?>
            <h3><span><?= $fetch_reviews['name']; ?></span> </h3>  
        
        </div>

         <?php
               }
            }else{
             echo '<p class="empty">No reviews Yet</p>';
            }

         ?>
          

      </div>
      <div class="swiper-pagination"></div>

   </div>
   
   
</section>






<!-- reviews section ends -->


















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>