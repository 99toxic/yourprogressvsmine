<?php

/* Error Handlers */
//Check if fields are empty
function emptyFields($empty) {
  if ( empty( $empty ) ) {
    echo '<p>Please fill in all fields!</p>';
    return true;
  }
}
// Check if fields are empty
function validFields($empty, $email, $uid, $pwd, $pwd_two) {
  if ( empty( $empty ) ) {
    echo '<p>Please fill in all fields!</p>';
    return true;
  }
  // check if email and username are valid
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
    echo '<p>That was an invalid username and email!</p>';
    return true;
  }
  // Check if email is valid
  elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL) ) {
    echo '<p>That was an invalid email!</p>';
    return true;
  }
  //Check if username is valid
  elseif ( !preg_match( '/^[a-zA-Z0-9]*$/', $uid ) ) {
    echo '<p>That was an invalid username!</p>';
    return true;
  }
  //Check if passwords match
  elseif ( $pwd !== $pwd_two ) {
    echo '<p>Password does not match!</p>';
    return true;
  }
}

/* End Error Handlers */
