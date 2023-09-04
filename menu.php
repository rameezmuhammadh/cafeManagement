<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>

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
   <h3>our menu</h3>
</div>
<section class="category">



   <div class="box-container">

            <div class="box">
                   <a href="#Fast Food" class="h-cat"> <img src="images/cat-1.png" alt=""></a>
                    <h3><a href="#Fast Food" class="h-cat">Fast Food</a></h3>
             </div>  
                <div class="box">
                    <a href="#fresh food" class="h-cat"><img src="images/cat-2.png" alt=""></a>
                    <h3><a href="#fresh food" class="h-cat">fresh food</a></h3>
                </div>   
                <div class="box">
                    <a href="#drinks" class="h-cat"><img src="images/cat-3.png" alt=""></a>
                    <h3><a href="#drinks" class="h-cat">Drinks</a></h3>
                </div>       
                <div class="box">
                    <a href="#desserts" class="h-cat"><img src="images/cat-4.png" alt=""></a>
                    <h3><a href="#desserts" class="h-cat">Deserts</a></h3>
                </div>           
            </div>
   </div>

</section>



<!-- menu section starts -->

<section class="products" id="Fast Food">

   <h1 class="title">Fast Food</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

     
         <input type="hidden" name="category" value="<?= $fetch_products['category']; ?>">

         <?php
            if($fetch_products['category'] == "fast food" ){
               ?>

      <form action="" method="post" class="box">
          <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>

         <div class="image">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>

         <div class="content">

            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <h3><?= $fetch_products['name']; ?></h3>
            <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"> &nbsp

            <button type="submit" name="add_to_cart" class="btn">add to cart</button> 

         </div>
   </form>

      <?php
   }
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>


<section class="products" id="fresh food">

   <h1 class="title">fresh food</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

        
         <input type="hidden" name="category" value="<?= $fetch_products['category']; ?>">

         <?php
            if($fetch_products['category'] == "fresh food" ){
               ?>   

      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>

         <div class="image">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>

         <div class="content">

            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <h3><?= $fetch_products['name']; ?></h3>
            <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"> &nbsp

            <button type="submit" name="add_to_cart" class="btn">add to cart</button> 

         </div>
   </form>

      <?php
         }
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>

<section class="products" id="drinks">

   <h1 class="title">drinks</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

        
         <input type="hidden" name="category" value="<?= $fetch_products['category']; ?>">

         <?php
            if($fetch_products['category'] == "drinks" ){
               ?>  

      <form action="" method="post" class="box">
          <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>

         <div class="image">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>

         <div class="content">

            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <h3><?= $fetch_products['name']; ?></h3>
            <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"> &nbsp

            <button type="submit" name="add_to_cart" class="btn">add to cart</button> 

         </div>
   </form>

      <?php
   }
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>

<section class="products" id="desserts">

   <h1 class="title">desserts</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

       
         <input type="hidden" name="category" value="<?= $fetch_products['category']; ?>">

         <?php
            if($fetch_products['category'] == "desserts" ){
               ?>  

      <form action="" method="post" class="box">
           <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>

         <div class="image">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>

         <div class="content">

            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <h3><?= $fetch_products['name']; ?></h3>
            <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"> &nbsp

            <button type="submit" name="add_to_cart" class="btn">add to cart</button> 

         </div>
   </form>

      <?php
   }
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
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