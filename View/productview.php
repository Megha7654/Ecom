<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<style type="text/css">
  .disabled {
    pointer-events:none; //This makes it not clickable
    opacity:0.6;         //This grays it out to look disabled
}
.mainlist .listdata{
  width: 50px;
  border:1px solid #3997F4;
  border-radius: 30px;
  display: inline-block;
  text-align: center
}
</style>
  

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
                      <th>#</th>
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
                    <form method="post">
                   <?php 
                   if($tabledata){
                   foreach ($tabledata as $key) {
                     ?>
                     <tr>

                      <td><input type="checkbox" name="del[]" value="<?php echo $key->pid;?>"></td>
                      <td><?php echo $key->pid ?></td>
                       <td><?php echo $key->pname ?></td>
                       <td><?php echo $key->description;?></td>
                       <td>
                         <img src="<?php echo $this->site_url?>upload/<?php echo $key->image;?>" height="50px" width="50px" id="pimage_<?php  echo $key->pid ?>" class="pimg">
                       </td>
                       <td><?php echo $key->price; ?></td>
                       <td><?php echo $key->qty;?></td>
                       <td><a href="<?php echo 'delete_product?pid='.$key->pid?>">DELETE</a></td>
                       <td><a href="<?php echo 'update_product?pid='.$key->pid?>">UPDATE</a></td>
                     </tr>
                     <?php
                   }
                 }
                    ?>
                    <tr>
                     
                      <td colspan="8" align="left"><input type="submit" name="muldel" class="btn btn-danger" value="DELETE"></td>
                   
                    </tr>
                     </form>
                  </tbody>
                </table>
                <ul class="pagination mainlist">
                  <li class="listdata" ><a href="?page=1">first</a></li>
                  <li class="listdata" <?php if($page<=1){echo 'hidden';}?>><a href="
                  <?php
                  if($totalpage<=1 ){echo "#";}
                  else{echo "?page=".($page-1);}
                  ?>">
                    prev
                  </a></li>
                  
                  <li class="listdata" <?php if($page>=$totalpage){echo 'hidden';}?>><a href="<?php
                  if($page >= $totalpage){echo "#";}
                  else{echo "?page=".($page+1);}
                  ?>">next</a></li>
                  <li class="listdata"><a href="?page=<?php echo $totalpage;?>">last</a></li>
                </ul>
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