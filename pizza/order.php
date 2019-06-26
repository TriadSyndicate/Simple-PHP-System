<?php
include '../assets/db/dbconnection.php';
$conn = OpenCon();
session_start();
$user_id=$_SESSION['user_id'];
$usernames = $_SESSION['pizzaorderer'];

$Pizza = new \stdClass();
$last_id = "error";

$largeQuantity = $_POST['large'];
$mediumQuantity = $_POST['medium'];
$smallQuantity = $_POST['small'];

$topType = $_POST['top'];
$donations = $_POST['donate'];
$dateTime = date("Y-m-d H:i:s");

$toppingsAmount = 0;
if ($topType=="Meat") {
  $toppingsAmount = 150;
}

if ($topType=="Vegetable") {
  $toppingsAmount = 100;
}

$pizzaQuantity = $largeQuantity + $mediumQuantity + $smallQuantity;


$largeUnit = 1000;
$mediumUnit = 800;
$smallUnit = 500;

$largeTotal = $largeQuantity * $largeUnit;
$mediumTotal = $mediumQuantity * $mediumUnit;
$smallTotal = $smallQuantity * $smallUnit;

$toppingsTotal = $toppingsAmount * $pizzaQuantity;

$Total = $largeTotal + $mediumTotal + $smallTotal + $toppingsTotal + $donations;

$sqlInsertOrders = "INSERT into orders(user_id, date_created, amount, status) VALUES('$user_id', '$dateTime', '$Total', '0')";
if ($conn->query($sqlInsertOrders) === TRUE) {
  $last_id = $conn->insert_id;
  if ($largeTotal!='0') {
      $sqlLarge = "INSERT into order_details(order_id,unit_amount,description,quantity,date_created,status) VALUES('$last_id', '$largeUnit','Large_Pizza','$largeQuantity','$dateTime','0')";
      $conn->query($sqlLarge);
  }

if ($mediumTotal!='0') {
    $sqlMedium = "INSERT into order_details(order_id,unit_amount,description,quantity,date_created,status) VALUES('$last_id', '$mediumUnit','Medium_Pizza','$mediumQuantity','$dateTime','0')";
      $conn->query($sqlMedium);
}

if ($smallTotal!='0') {
    $sqlSmall = "INSERT into order_details(order_id,unit_amount,description,quantity,date_created,status) VALUES('$last_id', '$smallUnit','Small_Pizza','$smallQuantity','$dateTime','0')";
      $conn->query($sqlSmall);
}


  if ($toppingsTotal!='0') {
      $sqlToppings = "INSERT into order_details(order_id,unit_amount,description,quantity,date_created,status) VALUES('$last_id', '$toppingsAmount','$topType','$pizzaQuantity','$dateTime','0')";
      $conn->query($sqlToppings);
  }

  if($donations!='0'){
      $sqlDonations = "INSERT into order_details(order_id,unit_amount,description,quantity,date_created,status) VALUES('$last_id', '$donations','Donation','1','$dateTime','0')";
      $conn->query($sqlDonations);
  }

  $Pizza->lpizza = $largeTotal;
  $Pizza->mpizza = $mediumTotal;
  $Pizza->spizza = $smallTotal;
  $Pizza->toptotal = $toppingsTotal;
  $Pizza->total = $Total;
  $Pizza->orderid = $last_id;
  $Pizza->userid = $user_id;
  $Pizza->username = $usernames;
  $Pizza->pizzaquantity = $pizzaQuantity;

  echo (json_encode($Pizza));
  $_POST = array();
}

?>
