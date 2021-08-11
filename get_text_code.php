<?php


include('connect.php');
include('api/functions.php');


ini_set('default_charset', 'UTF-8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Content-Type: application/json;charset=UTF-8');
$te = get_text_contents();
echo $te;
