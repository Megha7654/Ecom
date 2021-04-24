<?php 
 class Model{
    
       public $connection;   
       public function __construct(){
       		$this->connection=new mysqli("localhost","root","","ecom_db");
       		
       }

 }


 ?>