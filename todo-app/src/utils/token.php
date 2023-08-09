<?php
function generateToken(): string {
    $length = 32;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for ($i = 0; $i < $length; $i++) { 
        $token .=$characters[rand(0, strlen($characters) - 1)]; 
    } 
    return $token;
}

?>