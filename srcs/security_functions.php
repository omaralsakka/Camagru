<?php

// password validation
function validate_password($password)
{
    if (strlen($password) > 6   &&  
    preg_match('/[a-z]/', $password) &&
    preg_match('/[A-Z]/', $password) &&
    preg_match('/[0-9]/', $password)) 
    {
        return 1;
    } else {
        return 0;
    }
}

// double validation for user entries
function validate_data($data)
{
 $data = trim($data);
 $data = stripslashes($data);
 $data = strip_tags($data);
 $data = htmlspecialchars($data);
 return $data;    
}

?>