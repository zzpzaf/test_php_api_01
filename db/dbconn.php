
<?php


class Database{
    
  //private $db_host = '81ae82d0b350';
  private $db_host = '192.168.0.84';
  //private $db_host = '127.0.0.1';
  //private $db_port = '3306';
  private $db_port = '6306';
  private $db_name = 'kudoangular1';
  private $db_username = 'usrphp1';
  private $db_password = 'passphp1';
  //private $db_username = 'root';
  //private $db_password = 'kukupz2';
  private $charset = 'utf8mb4';



    public function dbConnection(){
          
      try{

        //$conn = new PDO('mysql:host=' . $this->db_host . '; port='. $this->db_port . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);
       
        //$constr =  'mysql:host='. $this->db_host .'; port='. $this->db_port . '; dbname=' . $this->db_name . '; charset=' . $this->$charset; 
        $constr =  'mysql:host='. $this->db_host .'; port='. $this->db_port . '; dbname=' . $this->db_name;  
        $conn = new PDO($constr,$this->db_username,$this->db_password);          
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        //echo "Connected successfully"; 

        return $conn;

      }
      catch(PDOException $e){

          echo "Connection error ".$e->getMessage(); 
          exit;
      }
      
      
    }
  }

?>



