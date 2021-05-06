<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  

  <!-- Navbar -->
  <?php include('header.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
         
          <section class="col-lg-5 connectedSortable">

            
           <h1>Product add</h1>
           <?php 
            if(isset($_SESSION['error'])){
              ?>

              <p class="alert alert-danger"><?php echo $_SESSION['error']; ?></p>
              <?php
              session_destroy();
            }
            ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php 
   if(isset($_REQUEST['pid'])){
    echo $this->base_url.'editProduct?pid='.$_REQUEST['pid'];
   }
   else{
     echo $this->base_url.'add';
   }
  ?>"
  <div class="form-group">
    <label class="control-label col-md-4" for="email">ProductName</label>
    <div class="col-md-8">
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="pname" value="<?php echo $editdata->pname ?? '';?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-4" for="pwd">Description</label>
    <div class="col-md-8">
      <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="desc" value="<?php  echo $editdata->description ?? ''?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-4" for="pwd">Image</label>
    <div class="col-md-8">
      <?php if(isset($_REQUEST['pid'])){
        ?>
        <img height="100px" width="100px" src="<?php echo $this->site_url?>/upload/<?php echo $editdata->image ?? ''?>">
        <input type="hidden" name="img" value="<?php echo $editdata->image ?? ''?>">
        <?php

      } ?>
      <input type="file" class="form-control" name="pimage">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-4" for="pwd">Price</label>
    <div class="col-md-8">
      <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="price" value="<?php echo $editdata->price ?? '';?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-4" for="pwd">Quantity</label>
    <div class="col-md-8">
      <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="qty" value="<?php echo $editdata->qty ?? '';?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" name="submit">
    </div>
  </div>
</form>
          
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php'); ?>