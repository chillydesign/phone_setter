<?php

include('connect.php');
include('api/functions.php');



if (!empty($_POST)) {


    $c = new stdClass();
    $c->first_name = $_POST['first_name'];
    $c->last_name = $_POST['last_name'];
    $c->company_name = $_POST['company_name'];
    $c->phone = $_POST['phone'];

    $client_id = create_client($c);

    if ($client_id) {
        
        $client = get_client($client_id);

        assign_phone_number($c->phone);
      
  
        header('Location: index.php?success');
    } else {
        header('Location: index.php?error=didntcreate');
    }



} else {
    header('Location: index.php?error=emptypost');
}


?>
