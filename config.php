<?php
// =========================================================================================
// this file contains envinronmental variables and database settings used within the system
// =========================================================================================

$forbiddenFiles = ['config.php', 'connection.php', 'mailer.php'];

$currentFile = explode('/', $_SERVER['REQUEST_URI']);
$currentFile = $currentFile[count($currentFile) - 1];

// prevents user from entering the files listed in $forbiddenFiles
if (in_array($currentFile, $forbiddenFiles)) {
    header("location: javascript:history.go(-1)");
}

$_ENV['pepper'] = '%\\wh5oX6';
$_ENV['db_config'] = ['localhost', 'root', '', 'sistema_ouvidoria'];