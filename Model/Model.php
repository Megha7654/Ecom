<?php 
 class Model{
    
       public $connection;   
       public function __construct(){
       		$this->connection=new mysqli("localhost","root","","ecom_db");
       		
       }
    /*   
       


        */
       public function insert_data_tbl($table,$data){
       	    print_r(array_keys($data));
       	    print_r(array_values($data));
       	    $key= implode(",", array_keys($data));
       	    $value=implode("','", array_values($data));
       		echo $query="insert into $table ($key)values('$value')";
       		$this->connection->query($query);
       }

 }


 ?>