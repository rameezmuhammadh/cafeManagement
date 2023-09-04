<?php

if(isset($_POST['status'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

   $tid = $_POST['tid'];
   $tid = filter_var($tid, FILTER_SANITIZE_STRING);
   $table_name = $_POST['table_name'];
   $table_name = filter_var($table_name, FILTER_SANITIZE_STRING);
   $t_size = $_POST['t_size'];
   $t_size = filter_var($t_size, FILTER_SANITIZE_STRING);
   $book_time = $_POST['book_time'];
   $book_time = filter_var($book_time, FILTER_SANITIZE_STRING);
   $t_category = $_POST['t_category'];
   $t_category = filter_var($t_category, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $check_tables_numbers= $conn->prepare("SELECT * FROM `tables` WHERE id = ? AND user_id = ?");
   $check_tables_numbers->execute([$tid, $user_id]);

   $check_book_tables = $conn->prepare("SELECT * FROM `book_tables` WHERE table_id = ?");
   $check_book_tables->execute([$table_id]);


   if($check_tables_numbers->rowCount() > 0){
      $message[] = 'already booked!';

   }else{
      $insert_tables = $conn->prepare("INSERT INTO `tables`(user_id, tid, table_name, book_time, t_size, t_category, status) VALUES(?,?,?,?,?,?,?)");
      $insert_tables->execute([$user_id, $tid, $table_name, $book_time, $t_size, $t_category, $status]);

      if($status == 'booked'){
            header('location:checkoutbooking.php');
         }

      $update_status = $conn->prepare("UPDATE `book_tables` SET status = ? WHERE table_id = ?");
      $update_status->execute([$status, $tid]);
      $message[] = 'table booked successfully!';

      
      }

      
   }
}

?>