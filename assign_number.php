<?php

include('connect.php');
include('functions.php');




// SET PHONE NUMBER IN TEXT FILE FOR TWILIO TO USE

if (isset($_POST['submit'])):
    $phone = $_POST['phone']; 
    if ($phone != '') {
        $myfile = fopen("phone.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $phone);
        fclose($myfile);

        header('Location: index.php?success');
    } else {
        header('Location: index.php?error=didntassign');
    }
endif;



?>
