<?php
function checkPassword($password, $confirm_password) {
  // Initialize variables
  $security = 0;
  $message = "";
  $msg_array=array();
  
  // Check passwords match
  if ($password!=$confirm_password){
    return array("Passwords must match");
  }

  // Check password length
  if (strlen($password) < 8) {
    array_push($msg_array,"Password must be at least 8 characters\n");
  } else {
    $security += 1;
  }

  // Check for mixed case
  if (preg_match("/[a-z]/", $password) && preg_match("/[A-Z]/", $password)) {
    $security += 1;
  } else {
    array_push($msg_array,"Password must contain a lower and uppercase letter\n");        
  }

  // Check for numbers
  if (preg_match("/\d/", $password)) {
    $security += 1;
  } else {
    array_push($msg_array,"Password must contain at least 1 number\n");        
  }

  // Check for special characters
  if (preg_match("/[^a-zA-Z\d]/", $password)) {
    $security += 1;
  } else {
    array_push($msg_array,"Password must contain at least 1 special character\n");        
  }
  
  return $msg_array;

/*
  // Return strength level
  if ($security < 2) {
    return "Too easy to guess. Increase password complexity.";
  } else if ($security === 2) {
    return "Moderately difficult";
  } else if ($security === 3) {
    return "Difficult";
  } else {
    return "Extremely difficult";
  }
  */
}
?>