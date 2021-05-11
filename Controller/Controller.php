<?php
include("Model/Model.php");
session_start();
class Controller {

      public $site_url;
      public $base_url;
      public $model;
	  public function __construct(){
	  	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	 
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		//echo "<br>in c".$url;

	  	 $this->model=new model();
	  	 $this->site_url="http://localhost/laravel_revision/MVC/AdminLTE-master/";
	  	 $this->base_url=$url;

	  	 $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


		$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

	  	 
	  	  
	  }

	  public function index(){
	  	include("View/login.php");
	  	

	  }

	  public function product_create(){
	  	  include("View/productadd.php");
	  	  
	  }

	  public function product_show(){

	  	$productdata=$this->model->select_data('product');
	  	if(isset($_REQUEST['page'])){
	  		$page=$_REQUEST['page'];
	  	}
	  	else{
	  		$page=1;
	  	}
	  
	  	$count=count($productdata);
	  	$perpage=1;
	  	$totalpage=ceil($count/$perpage);
	  	$offset=($page-1)*$perpage;
	  	$tabledata=$this->model->select_limit("product",$offset,$perpage);
	  	if(isset($_REQUEST['muldel'])){
	  		$id=$_REQUEST['del'];
	  		$this->model->multiple_delete("product",$id,'pid');
	  		header("Location:productview");
	  	}
	  	include("View/productview.php");

	  }
	  public function addProduct(){
	  	  if(isset($_REQUEST['pname'])){

	  	  	  $pname=$_REQUEST['pname'];
	  	  	  $desc=$_REQUEST['desc'];
	  	  	  $qty=$_REQUEST['qty'];
	  	  	  $price=$_REQUEST['price'];
	  	  	  $filename=$_FILES['pimage']['name'];
	  	  	  $type=$_FILES['pimage']['type'];
	  	  	  $temp=$_FILES['pimage']['tmp_name'];
	  	  	  $folder="upload/".$filename;

	  	  	  if($pname == ""){
	  	  	  	$_SESSION['error']="please enter pname";
	  	  	  	header("Location:productadd");
	  	  	  }

	  	  	  if(move_uploaded_file($temp, $folder)){
	  	  	  	echo "suucess fully uploaded";
	  	  	  }
	  	  	  else{
	  	  	  	echo "fail";
	  	  	  }
	  	  	  $inser_data=[
	  	  	  	'pname'=>$pname,
	  	  	  	'description'=>$desc,
	  	  	  	'image'=>$filename,
	  	  	  	'price'=>$price,
	  	  	  	'qty'=>$qty,
	  	  	  	'subcat_id	'=>1
	  	  	  ];
	  	  	  $this->model->insert_data_tbl('product',$inser_data);
	  	  	  header("Location:productview");


	  	  }
	  }
	  public function cat_create(){
	  	include("View/catadd.php");
	  }
	  public function catadddata(){
	  		if(isset($_REQUEST['cname'])){
	  	  	  $cname=$_REQUEST['cname'];
	  	  	 
	  	  	  $inser_data=[
	  	  	  	'cname'=>$cname
	  	  	  ];
	  	  	  $this->model->insert_data_tbl('category',$inser_data);
	  	  	  header("Location:productview");
	  	  	}
	  }
	  public function test(){
	  	echo "test";
	  }
	  public function viewcate(){
	  	$category=$this->select_data('category');
	  	include('View/categoryview.php');
	  }
	  public function delete_product(){
	  	if(isset($_REQUEST['pid'])){
	  		$id=$_REQUEST['pid'];
	  		$this->model->delete_data('product',['pid'=>$id]);
	  		header("Location:productview");
	  	}
	  }
	  public function update_product(){
	  	$id=$_REQUEST['pid'];
	  	$editdata=$this->model->select_where('product',['pid'=>$id]);
	  	$editdata=$editdata[0];
	  	include("View/productadd.php");
	  }
	  public function editdata(){
	  	if(isset($_REQUEST['pname'])){
	  		  $pid=$_REQUEST['pid'];
	  	  	  $pname=$_REQUEST['pname'];
	  	  	  $desc=$_REQUEST['desc'];
	  	  	  $qty=$_REQUEST['qty'];
	  	  	  $price=$_REQUEST['price'];
	  	  	  if($_FILES['pimage']['name']){
		  	  	  	 $filename=$_FILES['pimage']['name'];
		  	  	  $type=$_FILES['pimage']['type'];
		  	  	  $temp=$_FILES['pimage']['tmp_name'];
		  	  	  $folder="../upload/".$filename;
		  	  	   if(move_uploaded_file($temp, $folder)){
		  	  	  	echo "suucess fully uploaded";
		  	  	  }
		  	  	  else{
		  	  	  	echo "fail";
		  	  	  }

	  	  	  }
	  	  	  else{
	  	  	  	$filename=$_REQUEST['img'];
	  	  	  }
	  	  	 
	  	  	  if($pname == ""){
	  	  	  	$_SESSION['error']="please enter pname";
	  	  	  	header("Location:productadd");
	  	  	  }

	  	  	 
	  	  	  $inser_data=[
	  	  	  	'pname'=>$pname,
	  	  	  	'description'=>$desc,
	  	  	  	'image'=>$filename,
	  	  	  	'price'=>$price,
	  	  	  	'qty'=>$qty,
	  	  	  	'subcat_id	'=>1
	  	  	  ];
	  	  	  $this->model->update_data_tbl('product',$inser_data,['pid'=>$pid]);
	  	  	  header("Location:productview");

	  	  }

	  }
	   public function cookiesex(){
            setcookie("uname1","Megha",time()+60);
       }
       public function cookiesget(){
       		if(isset($_COOKIE['uname1'])){
       			echo $_COOKIE['uname1'];
       			unset($_COOKIE['uname1']);
       		}
       	}
       public function login(){
       	 if(isset($_REQUEST['loginname'])){
       	 	$email=$_REQUEST['loginname'];
       	 	$pass=$_REQUEST['loginpass'];
       	 	$where=['email'=>$email,"password"=>$pass];
       	 	$data=$this->model->select_where('user',$where);
       	 	$count=count($data);
       	 	if($count==1){
       	 		$_SESSION['userdata']=$data[0];
       	 		header("Location:productview");

       	 	}
       	 	else{
       	 		echo "login fail";
       	 	}
       	 }
       	 
       }
       public function logout(){
       	session_destroy();
       	header("Location: ");
       }
       public function productfind(){
       	  if(isset($_REQUEST['str'])){
       	  	$ch=$_REQUEST['str'];
       	  	$arr=['pname'=>$ch];
       	  	$productdata=$this->model->select_like("product",$arr);
       	  	?>
       	  	<table class="table" id="">
                  <thead>
                    <tr>
                      <th>Pid</th>
                      <th>ProductName</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($productdata as $key) {
                     ?>
                     <tr>
                      <td><?php echo $key->pid ?></td>
                       <td><?php echo $key->pname ?></td>
                       <td><?php echo $key->description;?></td>
                       <td>
                         <img src="<?php echo $this->site_url?>upload/<?php echo $key->image;?>" height="100px" width="100px">
                       </td>
                       <td><?php echo $key->price; ?></td>
                       <td><?php echo $key->qty;?></td>
                       <td><a href="<?php echo $this->base_url.'delete_product?pid='.$key->pid?>">DELETE</a></td>
                       <td><a href="<?php echo $this->base_url.'update_product?pid='.$key->pid?>">UPDATE</a></td>
                     </tr>
                     <?php
                   }
                    ?>
                  </tbody>

       	  	<?php

       	  }
       }	
}

$obj=new Controller();



 ?>