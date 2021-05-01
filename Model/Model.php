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

       public function select_data($table){
            $sel="select * from $table";
            $res=$this->connection->query($sel);
            while($row=$res->fetch_object()){
               $rw[]=$row;
            }
            return $rw;
       }



       public function delete_data($table,$where){
           $del="delete from $table where 1=1";
           foreach ($where as $key => $value) {
              $del.= " AND ".$key." = '".$value."'";
           }
           $this->connection->query($del);

       }

       public function select_where($table,$where){
           $sel="select * from $table where 1=1";
           foreach ($where as $key => $value) {
             $sel.= " AND ".$key. " = '".$value."'";
           }
           $res=$this->connection->query($sel);
           while($row=$res->fetch_object()){
              $rw[]=$row;
           }
           return $rw;
       }

 }


 ?>