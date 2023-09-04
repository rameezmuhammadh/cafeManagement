<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['no'] .', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['District'] .', '. $_POST['province'] .','. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <div class="form-inputs">
      <form action="" method="post">
         <h3>your address</h3>
         <span> No : </span>
         <input type="text" class="box" placeholder="." required maxlength="50" name="no">
         <span> Address </span>
         <input type="text" class="box" placeholder="" required maxlength="50" name="street">
         <span> City</span>
         <input type="text" class="box" placeholder="" required maxlength="50" name="city">
         <span> District </span>
         <input type="text" class="box" placeholder="" required maxlength="50" name="District">
         <span> Province </span>
         <input type="text" class="box" placeholder="" required maxlength="50" name="province">
         <span> Zip Code </span>
         <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6" name="pin_code">
         <input type="submit" value="save address" name="submit" class="click_btn">
      </form>
   </div>

</section>










<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>