<?php



    function getQueryStringALL() {


        $query = "";
        $queryALL = "SELECT c.id as id, c.name as name, c.capital as capital, c.region as region, c.subregion as subregion, " . 
                    "c.population as population, c.area as area, c.alpha2code as alpha2code, c.alpha3code as alpha3code, c.gdp as gdp " .
                    "FROM countries as c ORDER BY c.id ASC";
  
                    
        return $queryALL;
    }


    function gerQueryById(int $id){

        $query = "SELECT c.id as id, c.name as name, c.capital as capital, c.region as region, c.subregion as subregion, " . 
                 "c.population as population, c.area as area, c.alpha2code as alpha2code, c.alpha3code as alpha3code, c.gdp as gdp " .
                 "FROM countries as c " .
                 "WHERE c.id = " . $id;

        return $query;
    }



    function addPrepQueryString() {


        // This worked OK
        //$insquery = "INSERT INTO quotes (descr, fpersonsid, lupdate) VALUES('" . $descr ."', $fpersonsid " . ",' $lupdate')";
        //$prep_query = "INSERT INTO quotes (descr, fpersonsid, lupdate) VALUES( :descr, :fpersonsid, :lupdate )";
        
        $prep_query = "INSERT INTO countries (" .
                                              "name, capital, region, subregion, population, area, alpha2code, alpha3code, gdp" .
                                             ") " .
                      "VALUES(" . 
                              " :name, :capital, :region, :subregion, :population, :area, :alpha2code, :alpha3code, :gdp " .
                            ")";




        return $prep_query;

    }




    function updatePreQueryString() {


        // This worked OK

        $prep_query = "UPDATE countries " . 
                      "SET " . 
                      "name = :name, capital = :capital, region = :region, subregion = :subregion, " . 
                      "population = :population, area = :area, alpha2code = :alpha2code, alpha3code = :alpha3code, gdp = :gdp " . 
                      "WHERE id = :id";
        
        return $prep_query;

    }


    function deletePrepQueryString() {


        // This worked OK

        $prep_query = "DELETE From countries WHERE id = :id";
        
        return $prep_query;

    }



?>
