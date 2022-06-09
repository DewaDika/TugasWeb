<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo"<center>Untuk Mengakses Halaman Ini Anda Harus Login </center><br>";
  echo"<center><a href=../../index.php> Silakan Login </center>";
}else{
$aksi="modul/pelanggan/aksi_pelanggan.php";
switch($_GET['aksi']){
     default:
?>
      <h3><i class="fa fa-angle-right"></i> Customer </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Pelanggan</h4>
              <div class="col-lg-12">
              <a href=<?php echo"?p=customer&aksi=tambah" ?>><button type="button" class="btn btn-info">Tambah</button></a>
              </div> <br>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Pelanggan</th>
                      <th >Nama Pelanggan</th>
                      <th >Email</th>  
                      <th >No. HP</th>      
                      <th >Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   $sql=mysqli_query($con, "Select * from pelanggan order by nama_pelanggan asc"); 
                   $no=1;
                   while ($r=mysqli_fetch_array($sql)){
                       echo"<tr><td>$no</td>
                                <td>$r[id_pelanggan]</td>
                                <td>$r[nama_pelanggan]</td>
                                <td>$r[email]</td>
                                <td>$r[hp]</td>
                                <td>                   
                                <a href=?p=customer&aksi=edit&id=$r[id_pelanggan]><button type='button' class='btn btn-info'>Edit</button></a>
                                <a href='$aksi?act=hapus&id=$r[id_pelanggan]'<button type='button' class='btn btn-danger'>Delete</button></a>
                                </td>";
                        $no++;
                   }
                   ?>
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-4 -->
        </div>

<?php
    break;
    case 'tambah':
?>  

<h3><i class="fa fa-angle-right"></i> Customer </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Customer </h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/pelanggan/aksi_pelanggan.php?act=tambah"; ?> enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Pelanggan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_pelanggan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">NO. HP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hp">
                  </div>
                </div>
                <div class="form-group">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="simpan">
                </div>
                </div>
              </form>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>
<?php
    break;
    case 'edit':

      $sql=mysqli_query($con, "Select * from pelanggan where id_pelanggan='$_GET[id]'");
      $r=mysqli_fetch_array($sql);
?>
    
      <h3><i class="fa fa-angle-right"></i> Edit Customer</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Customer</h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/pelanggan/aksi_pelanggan.php?act=update"; ?> enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="kode" value=<?php echo"$r[id_pelanggan]";?>>
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Pelanggan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_pelanggan" value=<?php echo"$r[nama_pelanggan]";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value=<?php echo"$r[email]";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No. HP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hp" value=<?php echo"$r[hp]";?>>
                  </div>
                </div>              
                <div class="form-group">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="update">
                </div>
                </div>
              </form>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>
<?php
break;
    }
}
?>