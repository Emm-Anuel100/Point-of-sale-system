<?php
## Function to generate a random token
function generateToken() {
    return bin2hex(random_bytes(32));
}

## Function to securely hash the password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

## Function to verify hashed password
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

## Function to redirect to the error page
function redirectToErrorPage() {
    header("Location: ../error.htm");
    exit;
}

?>
