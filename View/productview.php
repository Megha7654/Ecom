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

            
           <h1>Product view</h1>
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search Product" aria-label="Search"
              aria-describedby="search-addon"  onkeyup="GetProduct(this.value)" />
            
        </div>
              <div id="tbl">     
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
                         <img src="<?php echo $this->site_url?>upload/<?php echo $key->image;?>" height="100px" width="100px" id="pimage_<?php  echo $key->pid ?>" class="pimg">
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
                </table>
              </div>
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