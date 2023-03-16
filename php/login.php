<?php
$connect = new mysqli ("localhost", "root","", "tamilhacks") or die("Connection Failed");
session_start();
if(isset($_POST['save'])){

   $name = mysqli_real_escape_string($connect, $_POST['uname1']);
   $pass = $_POST['upswd1'];
   $select = " SELECT * FROM register WHERE uname1 = '$name' && upswd1 = '$pass' ";
   $result = mysqli_query($connect, $select);

   if(mysqli_num_rows($result) > 0){
         $_SESSION["Login"]=true;
         header('location: ../profile.html');
         exit;
      }
     else{
      echo "incorrect email or password!";
   }

};
?>
