<?php
$id = $_GET['id'];

$deleted = delete_client($id);

if ($deleted) {
     // success but not returning any content
    http_response_code(204);
    echo json_encode('deleted'); 

} else {
    http_response_code(404);
    echo json_encode('error'); 
}
?>