<?php 
    header("Access-Control-Allow-Methods: POST");

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Credentials: true");

    header("Content-Type: text/html; charset=UTF-8");


    //require "Queries.php";
    require './db/dbconn.php';
    require './db/CountryClass.php';
    

    $inserted_ids = '';

    $dbclass = new Database();
    $conn = $dbclass->dbConnection();
    $country = new Country($conn);

    $data_array = json_decode("{}", true);
    
    $entityBody = file_get_contents('php://input');
    if (strlen($entityBody) > 0 && isValidJSON($entityBody)) {
    //if(!empty(trim($entityBody)){
        $data_array = json_decode($entityBody, true);
    
        $row_array = $data_array['Countries'];
        foreach($row_array as $row) { 
    
            $lid =  $country->insertCountry($row);
            $inserted_ids = $inserted_ids . $lid . ',';      
        }
        $inserted_ids = substr_replace($inserted_ids, "", -1);

    }


    function isValidJSON($str) {
        json_decode($str);
        return json_last_error() == JSON_ERROR_NONE;
        // return json_last_error();
     }


    echo $inserted_ids;

    $conn = null;



?>

    
