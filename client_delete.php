<?php
include('connect.php');
include('api/functions.php');


if (!empty($_GET['id'])) {


    $client_id = $_GET['id'];

    $deleted = delete_client($client_id);

    if ($deleted) {
       
  
        header('Location: index.php?success=deleted');
    } else {
        header('Location: index.php?error=didntdelete');
    }



} else {
    header('Location: index.php?error=noid');
}


?>
