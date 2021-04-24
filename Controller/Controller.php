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
		
		default:
			# code...
			break;
	}
}

 ?>