<?php
// This file is dedicated to user-related functions in database, such as sign-up and log-in

$functions = [
    'createUser' => function() {
        
    }
];

// $function will receive what was passed through $.post() with AJAX, and if the function actually exists it will be executed
$function = $_POST['function'] ?? null;
if (key_exists($function, $functions)) {
    $functions[$function]();
}