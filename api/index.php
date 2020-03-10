<?php

ini_set('default_charset', 'UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json;charset=UTF-8');



include('../connect.php');
include('functions.php');


if ( isset($_GET['route'])  ) {
    $route = $_GET['route'];
    
    if ($route == 'clients') {
        if (isset($_GET['id'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                include('routes/clients/delete.php');
            } else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
                include('routes/clients/update.php');
            } else {
                include('routes/clients/show.php');
            }
        } else 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include('routes/clients/create.php');
        } else {
            include('routes/clients/index.php');
        }
    } // end of if route is clients
    

    if ($route == 'phone') {
      

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include('routes/phone/create.php');
        } else {
            include('routes/phone/show.php');
        }
    }
    
    
    
    
} else {
    //  error
    http_response_code(404);
    echo json_encode('error'); 
    
}





?>
