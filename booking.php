<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_table.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Table booking</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">

         <div class="content">
            <span>Book a Table</span>
            <h3>One Booking System. One Fixed Price</h3>
            <p> It's for lunch, date night, a birthday celebration, or after work dinner and drink, let us make your occasion a special one.</p>
            <a href="#table" class="btn">book now</a>
         </div>

         <div class="image">
            <img src="images/book-1.png" alt="">
         </div>
         </div>
      </div>
   </div>

</section>


<section class="category">

   <h1 class="title">booking table</h1>

   <div class="box-container">

            <div class="box">
                   <a href="#Lunch-Table" class="h-cat"> <img src="images/cat-1.png" alt=""></a>
                    <h3><a href="#Lunch-Table" class="h-cat">lunch</a></h3>
             </div>  
                <div class="box">
                   <a href="#Dinner-Table" class="h-cat"> <img src="images/cat-2.png" alt=""></a>
                    <h3><a href="#Dinner-Table" class="h-cat">dinner</a></h3>
                </div>   
                <div class="box">
                    <a href="eventbooking.php" class="h-cat"><img src="images/eventicon.png" alt=""></a>
                    <h3><a href="eventbooking.php" class="h-cat">event</a></h3>
                </div>       
           
            </div>
   </div>

</section>

<!-- table section starts  -->



<section class="table" id="Lunch-Table">
   
   <h1 class="title">Lunch table</h1>

   <div class="box-container">

      <?php

         $select_book_tables = $conn->prepare("SELECT * FROM `book_tables`");
         $select_book_tables->execute();
               if($select_book_tables->rowCount() > 0){
               while($fetch_book_tables = $select_book_tables->fetch(PDO::FETCH_ASSOC)){
      ?>

        
         <input type="hidden" name="t_category" value="<?= $fetch_book_tables['t_category']; ?>">
         
         
          <?php
            if($fetch_book_tables['t_category'] == "Lunch Table" ){
               ?>
      <form action="" method="post" class="box">
          <input type="hidden" name="tid" value="<?= $fetch_book_tables['table_id']; ?>">
         <input type="hidden" name="table_name" value="<?= $fetch_book_tables['table_name']; ?>">
         <input type="hidden" name="book_time" value="<?= $fetch_book_tables['book_time']; ?>">
         <input type="hidden" name="t_size" value="<?= $fetch_book_tables['t_size']; ?>">
         <input type="hidden" name="status" value="<?= $fetch_book_tables['status']; ?>">

         <div class="content">
           
   
            <h2><?= $fetch_book_tables['table_name']; ?></h2>

            <img src="images/tab.png">

            <div class="book_time"><?= $fetch_book_tables['book_time']; ?></div>

            <b><div class="t_category"><?= $fetch_book_tables['t_category']; ?></div></b>

            <div class="t_size"><?= $fetch_book_tables['t_size']; ?></div>

            <div class="status"><?= $fetch_book_tables['status']; ?></div>

            <button type="submit" name="status" value="booked" class="btn <?php if($fetch_book_tables['status'] == "booked"){echo 'disabled';} ?>" style="width:100%;">book</button> 

         </div>
         
         
   </form>

      <?php
   }
            }
            
         }else{
            echo '<p class="empty">no lanch tables added yet!</p>';}
            
      ?>

   </div>

</section>


<section class="table" id="Dinner-Table">
   
   <h1 class="title">Dinner table</h1>

   <div class="box-container">

      <?php

         $select_book_tables = $conn->prepare("SELECT * FROM `book_tables`");
         $select_book_tables->execute();
               if($select_book_tables->rowCount() > 0){
               while($fetch_book_tables = $select_book_tables->fetch(PDO::FETCH_ASSOC)){
      ?>


         <input type="hidden" name="t_category" value="<?= $fetch_book_tables['t_category']; ?>">
         

         
          <?php
            if($fetch_book_tables['t_category'] == "Dinner Table"){
               ?>
      <form action="" method="post" class="box">

         <input type="hidden" name="tid" value="<?= $fetch_book_tables['table_id']; ?>">
         <input type="hidden" name="table_name" value="<?= $fetch_book_tables['table_name']; ?>">
         <input type="hidden" name="book_time" value="<?= $fetch_book_tables['book_time']; ?>">
         <input type="hidden" name="t_size" value="<?= $fetch_book_tables['t_size']; ?>">
         <input type="hidden" name="status" value="<?= $fetch_book_tables['status']; ?>">
         <div class="content">
           
            
            <h2><?= $fetch_book_tables['table_name']; ?></h2>

            <img src="images/tab.png">

            <div class="book_time"><?= $fetch_book_tables['book_time']; ?></div>

            <b><div class="t_category"><?= $fetch_book_tables['t_category']; ?></div></b>

            <div class="t_size"><?= $fetch_book_tables['t_size']; ?></div>

            <div class="status"><?= $fetch_book_tables['status']; ?></div>

            <button type="submit" name="status" value="booked" class="btn <?php if($fetch_book_tables['status'] == "booked"){echo 'disabled';} ?>" style="width:100%;">book</button> 

         </div>

         <?php
      
      ?>
         
         
   </form>

      <?php
   }
            }
            
         }else{
            echo '<p class="empty">no lanch tables added yet!</p>';}
            
      ?>

   </div>

</section>


<!-- table section ends -->



   
   









<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>
