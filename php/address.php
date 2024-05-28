<?php

$functions = [
    'getCities' => function() {
        
    }
];

$function = $_POST['function'];
if (key_exists($function, $functions)) {
    $functions[$function]();
}