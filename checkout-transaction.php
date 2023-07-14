<?php
include './config/functions.php';

if(isset($_POST)){


  global $db;
  $firstname = $db->real_escape_string($_POST['firstname']);
  $lastname = $db->real_escape_string($_POST['lastname']);
  $email = $db->real_escape_string($_POST['email']);
  $contact = $db->real_escape_string($_POST['contact']);
  $country = $db->real_escape_string($_POST['country']);
  $address = $db->real_escape_string($_POST['address']);
  $city = $db->real_escape_string($_POST['city']);
  $state = $db->real_escape_string($_POST['state']);
  $zip_code = $db->real_escape_string($_POST['zip']);

  $method_of_payment = $db->real_escape_string($_POST['method_of_payment']);
  $notes = $db->real_escape_string($_POST['notes']);
  $shipping_fee = $db->real_escape_string($_POST['ship_fee']);

  staffTransaction($firstname,$lastname,$email,$contact,$country,$address,$city,$state,$zip_code,$method_of_payment,$notes,$shipping_fee);

}

?>