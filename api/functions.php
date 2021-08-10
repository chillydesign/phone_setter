<?php


function assign_phone_number($number) {
 
    $f = FILELOC . "/phone.txt";
    $myfile = fopen($f, "w") or die("Unable to open file!");
    fwrite($myfile, $number);
    fclose($myfile);
}


function current_phone() {
    $current_phone =  '-';
    $f = FILELOC . "/phone.txt";
    $read_phone = fopen($f, "r") or die("Unable to open phone file!");
    $current_phone =  fread($read_phone,filesize($f));
    fclose($read_phone);
    // SET PHONE NUMBER IN TEXT FILE FOR TWILIO TO USE
    return $current_phone;
}



function get_clients(){
    global $conn;



    try {
        $query = "SELECT *  FROM clients
        ORDER BY clients.last_name ASC";
        $clients_query = $conn->prepare($query);
        $clients_query->setFetchMode(PDO::FETCH_OBJ);
        $clients_query->execute();
        $clients_count = $clients_query->rowCount();

        if ($clients_count > 0) {
            $clients =  $clients_query->fetchAll();
            $clients = processClients($clients);
        } else {
            $clients =  [];
        }

        unset($conn);
        return $clients;

    } catch(PDOException $err) {
        return [];
    };
}


function get_client($client_id = null) {

    global $conn;
    if ( $client_id != null) {


        try {
            $query = "SELECT * FROM clients WHERE clients.id = :id LIMIT 1";
            $client_query = $conn->prepare($query);
            $client_query->bindParam(':id', $client_id);
            $client_query->setFetchMode(PDO::FETCH_OBJ);
            $client_query->execute();

            $client_count = $client_query->rowCount();

            if ($client_count == 1) {
                $client =  $client_query->fetch();
                $client = processClient($client);
            } else {
                $client =  null;
            }

            unset($conn);
            return $client;
        } catch(PDOException $err) {
            return null;
        };
    } else { // if client id is not greated than 0
        return null;
    }
}




function create_client($client) {
    global $conn;
    if ( !empty($client->last_name)  && !empty($client->phone)  ){

  
        try {
            $query = "INSERT INTO clients
             (first_name, last_name, phone, company_name) VALUES 
             (:first_name, :last_name, :phone, :company_name)";
            $client_query = $conn->prepare($query);
            $client_query->bindParam(':first_name', $client->first_name);
            $client_query->bindParam(':last_name', $client->last_name);
            $client_query->bindParam(':phone', $client->phone);
            $client_query->bindParam(':company_name', $client->company_name);
            $client_query->execute();
            $client_id = $conn->lastInsertId();
            unset($conn);
            return ($client_id);

        } catch(PDOException $err) {

            return false;

        };

    } else { // client client_id was blank
        return false;
    }


}




function delete_client($client_id) {

    global $conn;
    if ($client_id > 0) {

        try {
            $query = "DELETE FROM clients  WHERE id = :id    ";
            $client_query = $conn->prepare($query);
            $client_query->bindParam(':id', $client_id);
            $client_query->setFetchMode(PDO::FETCH_OBJ);
            $client_query->execute();

            unset($conn);
            return true;


        } catch(PDOException $err) {
            return false;
        };
    } else {
        return false;
    }

}


function processClient($client) {

    $client->name =  $client->first_name . ' '  . $client->last_name ;
    $client->id = intval($client->id);
    return $client;
}


function processClients($clients) {
    
    foreach ($clients as $client) {
       processClient($client);
    }

    return $clients;
}



// // ADD TO DIRECTORY
// if (isset($_POST['directory_submit'])):
//     $phone = $_POST['phone']; 
//     $client = $_POST['client']; 
//     if ($phone != '') {
//         $directoryfile = "directory.txt";
//         // Open the file to get existing content
//         $current = file_get_contents($directoryfile);
//         // Append a new person to the file
//         $current .=  $client . ',' . $phone . "\n";
//         // Write the contents back to the file
//         file_put_contents($directoryfile, $current);

    
//     }
// endif;

// // ADD TO DIRECTORY



// // READ LIST OF PHONE NUMBERS SAVED IN TEXT FILE
// $numbers = array();
// $read_directory = fopen("directory.txt", "r") or die("Unable to open directory file!");
// while(! feof($read_directory)){
//   $number_ar =  explode(',' , fgets($read_directory)) ;
//   if ($number_ar[0] != '') {
//     array_push($numbers,  $number_ar   );
//   }
// }
// fclose($read_directory);
// // READ LIST OF PHONE NUMBERS SAVED IN TEXT FILE


function assign_text($data) {
 
    $f = FILELOC . "/text_code.txt";
    $myfile = fopen($f, "w") or die("Unable to open text_code!");
    $d = implode("", $data);
    fwrite($myfile, $d);
    fclose($myfile);
}
