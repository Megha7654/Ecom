<?php 
include("../Model/Model.php");

class Controller extends Model{

      public $site_url;
      public $base_url;
	  public function __construct(){

	  	 parent::__construct();
	  	 $this->site_url="http://localhost/laravel_revision/MVC/AdminLTE-master/";
	  	 $this->base_url="http://localhost/laravel_revision/MVC/AdminLTE-master/Controller/Controller.php/";
	  	  
	  }

	  public function index(){
	  	include("../View/index.php");
	  }

	  public function product_create(){
	  	  include("../View/productadd.php");
	  	  
	  }

	  public function product_show(){
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

		
		default:
			# code...
			break;
	}
}

 ?>