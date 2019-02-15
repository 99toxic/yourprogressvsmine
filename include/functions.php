<?php

/* Error Handlers */

  $errorEmpty = false;
  $errorInvalid = false;
  $errorEmail = false;
  $errorPassword = false;
  $errorPwdMatch = false;
  $errorUser = false;

//check for empty fields
function emptyFields($empty) {
  if ( empty( $empty ) ) {
    echo '<p>Please fill in all fields!</p>';
    $errorEmpty = true;
  }
}
// Check if email and username are valid
function nameEmailValid($uid, $email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
    echo '<p>That was an invalid username and email!</p>';
    $errorInvalid = true;
  }
}
// Check if email is valid
function emailValid($email) {
  if ( !filter_var( $email, FILTER_VALIDATE_EMAIL) ) {
    echo '<p>That was an invalid email!</p>';
    $errorEmail = true;
  }
}
// Check if username is valid
function nameValid($uid) {
  if ( !preg_match( '/^[a-zA-Z0-9]*$/', $uid ) ) {
    echo '<p>That was an invalid username!</p>';
    $errorUser = true;
  }
}
// check if passwords match
function pwdMatch($pwd, $pwd_two) {
  if ( $pwd !== $pwd_two ) {
    echo '<p>Password does not match!</p>';
    $errorPassword = true;
  }
}

/* End Error Handlers */
