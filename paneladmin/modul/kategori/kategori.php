<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo"<center>Untuk Mengakses Halaman Ini Anda Harus Login </center><br>";
  echo"<center><a href=../../index.php> Silakan Login </center>";
}else{
$aksi="modul/kategori/aksi_kategori.php";
switch($_GET['aksi']){
     default:
?>
      <h3><i class="fa fa-angle-right"></i> Kategori Produk</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Kategori</h4>
              <div class="col-lg-12">
              <a href=<?php echo"?p=kategori&aksi=tambah" ?>><button type="button" class="btn btn-info">Tambah</button></a>
              </div> <br>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Kategori</th>
                      <th >Nama Kategori</th>     
                      <th >Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   $sql=mysqli_query($con, "Select * from kategori order by nama_kategori asc"); 
                   $no=1;
                   while ($r=mysqli_fetch_array($sql)){
                       echo"<tr><td>$no</td>
                                <td>$r[id_kategori]</td>
                                <td>$r[nama_kategori]</td>
                                <td>                   
                                <a href=?p=kategori&aksi=edit&id=$r[id_kategori]><button type='button' class='btn btn-info'>Edit</button></a>
                                <a href='$aksi?act=hapus&id=$r[id_kategori]'<button type='button' class='btn btn-danger'>Delete</button></a>
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

<h3><i class="fa fa-angle-right"></i> Master Kategori</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Kategori</h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/kategori/aksi_kategori.php?act=tambah"; ?>>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_kategori">
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

      $sql=mysqli_query($con, "Select * from kategori where id_kategori='$_GET[id]'");
      $r=mysqli_fetch_array($sql);
?>
    
      <h3><i class="fa fa-angle-right"></i> Edit Kategori</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Katagori</h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/kategori/aksi_kategori.php?act=update"; ?>>
              <input type="hidden" class="form-control" name="kode" value=<?php echo"$r[id_kategori]";?>>
              
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_kategori" value=<?php echo"$r[nama_kategori]";?>>
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