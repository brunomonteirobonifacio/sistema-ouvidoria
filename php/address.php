<?php
// this file will contain functions referring to address tables (`cidade` and `estado`)
$functions = [
    'getCities' => function() {

    }
];

$function = $_POST['function'];
if (key_exists($function, $functions)) {
    $functions[$function]();
}