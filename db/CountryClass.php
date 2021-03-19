<?php


require "CountryQueries.php";

class Country{

    // DataBase Connection instance
    private $connection;

    // table name
    //private $table_name = "quotes";


    // table columns
    // -------------------------------------
    public $id;                // number;
    public $name;              // string; 
    public $capital;           // string;
    public $region;            // string;
    public $subregion;         // string;
    public $population;        // number;
    public $area;              // number;
    public $alpha2code;        // string;
    public $alpha3code;        // string;
    public $gdp;               // number;
    
    
    
    

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
    }
    //R






    public function getALLCountries() {
        $query = getQueryStringALL();
        return $query;
    }
    public function getCountry(int $id){

        $query = gerQueryById($id);
        //$stmt = $this->connection->prepare($query);
        //$stmt->execute();

        //return $stmt;
        return $query;
    }


    public function insertCountry($row){

        // inserting a record
        
        // ===============================================================================================================

        $insPrepQuery = addPrepQueryString();
        $stmt = $this->connection->prepare($insPrepQuery);        
        
        // 
        $res = $stmt->execute(array(
                                    ':name' => $row['name'] , 
                                    ':capital' => $row['capital'], 
                                    ':region' => $row['region'],
                                    ':subregion' => $row['subregion'],     
                                    ':population' => $row['population'],     
                                    ':area' => $row['area'],
                                    ':alpha2code' => $row['alpha2code'],                                         
                                    ':alpha3code' => $row['alpha3code'],     
                                    ':gdp' => $row['gdp']                                    
                                   )
                            );
        $last_id = 0;
        if ($res) {
            //It returns the last inserted ID
            $last_id = $this->connection->lastInsertId();
        }
        // This is boolean, true means Ok
        return $last_id;
    }







    public function updateCountry($row){

        // updating a record
        // ===============================================================================================================

        $updPrepQuery = updatePreQueryString();
        $stmt = $this->connection->prepare($updPrepQuery);        
       
        $stmt->execute(array(
                             ':name' => $row['name'] , 
                             ':capital' => $row['capital'], 
                             ':region' => $row['region'],
                             ':subregion' => $row['subregion'],     
                             ':population' => $row['population'],     
                             ':area' => $row['area'],
                             ':alpha2code' => $row['alpha2code'],                                         
                             ':alpha3code' => $row['alpha3code'],     
                             ':gdp' => $row['gdp'],
                             ':id' => $row['id']                                
                            )
                      );

        $upd_id = 0;
        if ($stmt->rowCount() > 0) {
            //It returns the last inserted ID
            $upd_id = $row['id'];
        }
        // This is boolean, true means Ok
        return $upd_id;

    }




    public function deleteCountry($row){

        // deleting a record
        // ===============================================================================================================

        $delPrepQuery = deletePrepQueryString();
        $stmt = $this->connection->prepare($delPrepQuery);        
       
        $stmt->execute(array(':id' => $row['id'] ));

        $del_id = 0;
        if ($stmt->rowCount() > 0) {
            //It returns the last inserted ID
            $del_id = $row['id'];
        }
        // This is integer
        return $del_id;

    }


}

?>
