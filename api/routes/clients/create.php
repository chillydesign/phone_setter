<?php


$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

if (!empty($data->phone)) {


    $client_attributes = $data;
    $client_id = create_client($client_attributes);

    
    if ($client_id) {
        $client = get_client($client_id);
        http_response_code(201);
        echo json_encode($client);
    } else {
        http_response_code(404);
        echo json_encode( 'Error1' );
    }



} else {
    http_response_code(404);
    echo json_encode( 'Error2'  );
}




