<?php 
    header("Access-Control-Allow-Methods: PUT");

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Credentials: true");

    header("Content-Type: text/html; charset=UTF-8");


    //require "Queries.php";
    require './db/dbconn.php';
    require "./db/CountryClass.php";
    

    $dbclass = new Database();
    $conn = $dbclass->dbConnection();
    $country = new Country($conn);



    $data_array = json_decode("{}", true);
    
    $entityBody = file_get_contents('php://input');
    if (strlen($entityBody) > 0 && isValidJSON($entityBody)) {
        //if(!empty(trim($entityBody)){
            $data_array = json_decode($entityBody, true);


        $updated_ids = '';
        $row_array = $data_array['Countries'];
        foreach($row_array as $row) { 

            $lid =  $country->updateCountry($row);
            $updated_ids = $updated_ids . $lid . ',';      

        }
        $updated_ids = substr_replace($updated_ids, "", -1);
        echo $updated_ids;

    }


    $conn = null;


    function isValidJSON($str) {
        json_decode($str);
        return json_last_error() == JSON_ERROR_NONE;
     }

?>

    
