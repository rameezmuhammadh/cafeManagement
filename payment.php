<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $card_name = $_POST['card_name'];
   $card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
   $card_holder = sha1($_POST['card_holder']);
   $card_holder = filter_var($card_holder, FILTER_SANITIZE_STRING);
   $card_num = sha1($_POST['card_num']);
   $card_num = filter_var($card_num, FILTER_SANITIZE_STRING);
   $month = sha1($_POST['month']);
   $month = filter_var($month, FILTER_SANITIZE_STRING);
   $year = sha1($_POST['year']);
   $year = filter_var($year, FILTER_SANITIZE_STRING);
   $cvn = sha1($_POST['cvn']);
   $cvn = filter_var($cvn, FILTER_SANITIZE_STRING);
   $total_price = $_POST['total_price'];

   $select_payment = $conn->prepare("SELECT * FROM `payment` WHERE user_id = ? ");
   $select_payment->execute([$user_id]);

   if($total_price == ''){
      $message[] = 'your payment palance is 0';
   }else{

      $insert_payment = $conn->prepare("INSERT INTO `payment`(user_id, card_name, card_holder, card_num, month, year, cvn, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_payment->execute([$user_id, $card_name, $card_holder, $card_num, $month, $year, $cvn, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

      $message[] = 'successfully payed!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>payment</title>

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
   <h3>payment</h3>
</div>

<section class="form-container">

      <div class="form-inputs">

         <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      
            }
         }
      ?>

      
         <form action="" method="post">
            <h3>Payment Deatails</h3>
            <span> Card Type </span>
            <div calss="icon-container">
            &nbsp  &nbsp &nbsp &nbsp<input type="radio" class="rdo" name="card_name" value="Visa"><span>Visa</span>
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type="radio" class="rdo" name="card_name" value="Mastercard"><span>Mastercard</span>
            </div>
         </br>

            <span> Name On Card </span>
            <input type="text" name="card_holder" maxlength="50" class="box" placeholder="enter your name" required>
            <span> Card Number </span>
            <input type="text" name="card_num" required placeholder="XXXXXXXXXXXXXXXX" class="box" maxlength="16">

             <span>Expiry Date</span>
          </br>
                <select  name="month" class="t-box">
                    <option selected>Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                &nbsp  &nbsp   &nbsp   &nbsp   &nbsp   &nbsp  &nbsp 
                <select name="year" class="t-box">
                    <option selected>Year</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                </select>
             </br>

            <span> CVN </span>
            <input type="text" name="cvn" required placeholder="XXX" class="box" maxlength="3">
            </br></br></br></br>

            <div class="cart-total">
            <h3>total amount</h3>

            <div class="box">
            <p class="grand-total"><span class="name">Cart Total :</span><span class="price">Rs<?= $grand_total; ?></span></p>

            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" >
            </div>
            </div>

            <a href="checkout.php" class="btn">Cancel</a>

            &nbsp  &nbsp   &nbsp   &nbsp   &nbsp   &nbsp  &nbsp 
            
            <input type="submit" value="Pay" name="submit" class="click_btn">
            
            
         </form>
      </div>

   </section>






<?php include 'components/footer.php'; ?>






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>