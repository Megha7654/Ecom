<?php 
include("../Model/Model.php");
session_start();
class Controller extends Model{

      public $site_url;
      public $base_url;
	  public function __construct(){

	  	 parent::__construct();
	  	 $this->site_url="http://localhost/laravel_revision/MVC/AdminLTE-master/";
	  	 $this->base_url="http://localhost/laravel_revision/MVC/AdminLTE-master/Controller/Controller.php/";
	  	 
	  	  
	  }

	  public function index(){
	  	include("../View/login.php");
	  }

	  public function product_create(){
	  	  include("../View/productadd.php");
	  	  
	  }

	  public function product_show(){
	  	$productdata=$this->select_data('product');
	  	include("../View/productview.php");
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
	  	  	  $folder="../upload/".$filename;

	  	  	  if($pname == ""){
	  	  	  	$_SESSION['error']="please enter pname";
	  	  	  	header("Location:".$this->base_url."productadd");
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
	  	  	  $this->insert_data_tbl('product',$inser_data);

	  	  }
	  }
	  public function cat_create(){
	  	include("../View/catadd.php");
	  }
	  public function catadddata(){
	  		if(isset($_REQUEST['cname'])){
	  	  	  $cname=$_REQUEST['cname'];
	  	  	 
	  	  	  $inser_data=[
	  	  	  	'cname'=>$cname
	  	  	  ];
	  	  	  $this->insert_data_tbl('category',$inser_data);
	  	  	}
	  }
	  public function test(){
	  	echo "test";
	  }
	  public function viewcate(){
	  	$category=$this->select_data('category');
	  	include('../View/categoryview.php');
	  }
	  public function delete_product(){
	  	if(isset($_REQUEST['pid'])){
	  		$id=$_REQUEST['pid'];
	  		$this->delete_data('product',['pid'=>$id]);
	  		header("Location:".$this->base_url."productview");
	  	}
	  }
	  public function update_product(){
	  	$id=$_REQUEST['pid'];
	  	$editdata=$this->select_where('product',['pid'=>$id]);
	  	$editdata=$editdata[0];
	  	include("../View/productadd.php");
	  }
	  public function editdata(){
	  	if(isset($_REQUEST['pname'])){
	  		  $pid=$_REQUEST['pid'];
	  	  	  $pname=$_REQUEST['pname'];
	  	  	  $desc=$_REQUEST['desc'];
	  	  	  $qty=$_REQUEST['qty'];
	  	  	  $price=$_REQUEST['price'];
	  	  	  $filename=$_FILES['pimage']['name'];
	  	  	  $type=$_FILES['pimage']['type'];
	  	  	  $temp=$_FILES['pimage']['tmp_name'];
	  	  	  $folder="../upload/".$filename;

	  	  	  if($pname == ""){
	  	  	  	$_SESSION['error']="please enter pname";
	  	  	  	header("Location:".$this->base_url."productadd");
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
	  	  	  $this->update_data_tbl('product',$inser_data,['pid'=>$pid]);
	  	  	  header("Location:".$this->base_url."productview");

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
       	 	$data=$this->select_where('user',$where);
       	 	$count=count($data);
       	 	if($count==1){
       	 		$_SESSION['userdata']=$data[0];
       	 		header("Location:".$this->base_url."productview");

       	 	}
       	 	else{
       	 		echo "login fail";
       	 	}
       	 }
       	 
       }
       public function logout(){
       	session_destroy();
       	header("Location:".$this->base_url);
       }	
}
$obj=new Controller();

if(isset($_SERVER['PATH_INFO'])){
	switch ($_SERVER['PATH_INFO']) {
		case '/':
			$obj->index();
			break;
		case '/productadd':
			$obj->product_create();
			break;
		case '/productview':
			$obj->product_show();
			break;	
		case '/test':
			$obj->test();
			break;	
		case '/add':
		   $obj->addProduct();
		   break;	
		case '/catadd':
		  $obj->cat_create();
		  break;
		case '/catinsert' :
		$obj->catadddata();
		break;  
		case '/viewcat':
		$obj->viewcate();
		break;
		case '/delete_product':
		$obj->delete_product();
		break;
		case '/update_product':
		$obj->update_product();
		break;
		case '/editProduct':
		$obj->editdata();
		break;
		case '/cokset':
		$obj->cookiesex();
		break;
		case '/cokget':
		$obj->cookiesget();
		break;
		case '/login':
		$obj->login();
		break;
		case '/logout':
		$obj->logout();
		break;


		
		default:
			# code...
			break;
	}
}

 ?>