<?php




$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

if (!empty($data->number)) {

    assign_phone_number($data->number);
    echo json_encode( $data );


} else {
    http_response_code(404);
    echo json_encode( 'Error'  );
}









?>