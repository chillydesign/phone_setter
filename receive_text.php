<?php

include('connect.php');
include('api/functions.php');

assign_text($_POST);



$body = 'Code: ' . $_POST['Body'];
mail('rissel.melissa@gmail.com', 'Text Message Recieved', $body);
