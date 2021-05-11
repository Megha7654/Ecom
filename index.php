<?php 
include('Controller/Controller.php');
include('Controller/ProductController.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if(isset($url)){
	switch ($uriSegments[4]) {
		case '':
			$obj->index();
			break;
		case 'productadd':
			$obj->product_create();
			break;
		case 'productview':
			$obj->product_show();
			break;	
		case 'test':
			$obj->test();
			break;	
		case 'add':
		   $obj->addProduct();
		   break;	
		case '/catadd':
		  $obj->cat_create();
		  break;
		case 'catinsert' :
		$obj->catadddata();
		break;  
		case 'viewcat':
		$obj->viewcate();
		break;
		case 'delete_product':
		$obj->delete_product();
		break;
		case 'update_product':
		$obj->update_product();
		break;
		case 'editProduct':
		$obj->editdata();
		break;
		case 'cokset':
		$obj->cookiesex();
		break;
		case 'cokget':
		$obj->cookiesget();
		break;
		case 'login':
		$obj->login();
		break;
		case 'logout':
		$obj->logout();
		break;
		case 'productfind':
		$obj->productfind();
		break;
		case 'pro':
		$producrobj->index();
		break;


		
		default:
			# code...
			break;
	}
}



 ?>