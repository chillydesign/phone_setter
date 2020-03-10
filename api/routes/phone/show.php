<?php




$current_phone = current_phone();
if ($current_phone) {
   
    $o = new stdClass();
    $o->number = $current_phone;

    echo json_encode($o);
    
} else {
    http_response_code(404);
    echo json_encode('Couldnt get number'); 
}







?>