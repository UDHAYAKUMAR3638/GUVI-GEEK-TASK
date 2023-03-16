<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->mydb->users;
$username = $_POST["uname"];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email = $_POST["email"];
$dob = $_POST["dob"];
$contact = $_POST["phoneno"];

$conn = new mysqli ("localhost", "root","", "tamilhacks") or die("Connection Failed");
session_start();
$stmt = $conn->prepare('UPDATE register SET email=?,fname=?,lname=?,dob=?,phoneno=? WHERE uname1=?');
    // Bind the parameters
    $stmt->bind_param('ssssss', $email, $fname,$lname,$dob,$contact,$username);
    $user1="SELECT * FROM REGISTER WHERE uname1=$username";
    include '../profile.html';
    // Execute the SQL statement
    $stmt->execute();
    //     echo 'User details updated successfully';
    // } else {
    //     echo 'Error updating user details: ' . $stmt->error;
    // }

    // // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

  if( empty($username)){
    echo "Please Fill Out The Form!";
    exit;
  }

  $user = $collection->findOne(['username' => $username]);
  if($user){
    echo "Username Has Already Taken";
    exit;
  }
  else{
    $user = [
      'username' => $username,
      'email' => $email,
      'fname'=>$fname,
      'lname'=>$lname,
      'dob' => $dob,
      'contact' => $contact
    ];
    $result = $collection->insertOne($user);
    if($result->getInsertedCount() > 0){
      header('Location: ../profile.html');
      exit;
    }
  }

?>