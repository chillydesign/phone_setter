<?php

include('connect.php');
include('api/functions.php');




// SET PHONE NUMBER IN TEXT FILE FOR TWILIO TO USE

if (isset($_GET['phone'])):
    $phone = $_GET['phone']; 
    if ($phone != '') {

        assign_phone_number($phone);
       

        header('Location: index.php?success');
    } else {
        header('Location: index.php?error=didntassign');
    }
else:
    header('Location: index.php?error=nonumber');
endif;



?>
