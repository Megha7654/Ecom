
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
       public function select_limit($table,$start,$end){
        $query="select * from $table limit $start,$end";
        $res=$this->connection->query($query);
            while($row=$res->fetch_object()){
               $rw[]=$row;
            }
            return $rw;
       }

       public function multiple_delete($table,$where,$value){
        $id= implode(",", $where);
        $query="delete from $table where $value in($id)";
        $this->connection->query($query);
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
           return $rw ?? [];
       }

       public function update_data_tbl($table,$inser_data,$where){
        //update product set pn=1 ,pi=1, where pid=2
        $count=count($inser_data);
        $i=0;
        $query="update $table set ";
        foreach ($inser_data as $key => $value) {
           if($i< $count-1)
            $query.= $key ." = '".$value."' ,";
          else
            $query.= $key ." = '".$value."'";
          $i++;
         } 
        $query.=" where 1=1";
         foreach ($where as $key => $value) {
             $query.= " AND ".$key. " = '".$value."'";
           }
        $this->connection->query($query);
       }

       public function select_like($table,$data){

        //select * from product where productname like '%s%';
        $key= implode(",", array_keys($data));
        $value=implode("','", array_values($data));
         $query="select * from $table where  $key like '%$value%'";
        $res=$this->connection->query($query);
           while($row=$res->fetch_object()){
              $rw[]=$row;
           }
           return $rw ?? [];
       }



 }


 ?>