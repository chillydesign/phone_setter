<?php

include('connect.php');
include('functions.php');




// SET PHONE NUMBER IN TEXT FILE FOR TWILIO TO USE

if (isset($_GET['phone'])):
    $phone = $_GET['phone']; 
    if ($phone != '') {
        $myfile = fopen("phone.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $phone);
        fclose($myfile);

        header('Location: index.php?success');
    } else {
        header('Location: index.php?error=didntassign');
    }
else:
    header('Location: index.php?error=nonumber');
endif;



?>
