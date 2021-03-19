<?php 
    // SET HEADER
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");




    $id = 0; 
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);
    }

    require './db/dbconn.php';
    require './db/CountryClass.php';
    

    //echo '========================== ' . '<br>';

    $db_connection = new Database();
    $conn = $db_connection->dbConnection();
    $country = new Country($conn);

    // $tblnm = "countries";
    // $query = "SELECT id, name, capital, region, subregion, population, area, alpha2code, alpha3code, gdp FROM " . $tblnm;  


    if($id > 0){
        $query = $country->getCountry($id);
    }else {
        $query = $country->getALLCountries();
    }


    $stmt = $conn->prepare($query); 
    //$stmt->execute(array());
    $stmt->execute();    
    $count = $stmt->rowCount();

    $records_array = [];
    //CHECK WHETHER THERE IS ANY record IN OUR DATABASE
    if($count > 0){

        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $record_data = [

                'id' => $row['id'],
                'name' => $row['name'],
                'capital' => $row['capital'],
                'region' => $row['region'],
                'subregion' => $row['subregion'],
                'population' => $row['population'],
                'area' => $row['area'],
                'alpha2code' => $row['alpha2code'],
                'alpha3code' => $row['alpha3code'],
                'gdp' => $row['gdp']
            ];

            // PUSH record DATA IN OUR $records_array ARRAY
            array_push($records_array, $record_data);

        }

        http_response_code(200);

    }
    else{
        //IF THER IS NO record IN OUR DATABASE ... 
        echo json_encode(['message'=>'No record found']);
    }

    // Close now the PDO connection - Not absolutely necessary, since
    // PHP will automatically close the connection when your script ends
    $conn = null;




    //SHOW record(s) IN JSON FORMAT
    //echo json_encode($records_array);       //It does not work just this, we have to iterate!
    $output = [];
    $mystr = '';
    foreach($records_array as $row) {
        $mystr = $mystr . json_encode($row).', ';
    }

    $mystr = substr_replace($mystr, "", -2);                    // -2 instead of -1 due to UTF8 - 2byte characyer strings???
    $mystr =  '{' . '"Countries"'. ' : [' . $mystr . ']' . '}' ;
    echo $mystr;


?>


