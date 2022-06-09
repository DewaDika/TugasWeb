<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo"<center>Untuk Mengakses Halaman Ini Anda Harus Login </center><br>";
  echo"<center><a href=../../index.php> Silakan Login </center>";
}else{
$aksi="modul/pembayaran/aksi_pembayaran.php";
switch($_GET['aksi']){
     default:
?>
      <h3><i class="fa fa-angle-right"></i> Pembayaran </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Pembayaran</h4>
              <div class="col-lg-12">
              <a href=<?php echo"?p=penjualan&aksi=tambah" ?>><button type="button" class="btn btn-info">Tambah</button></a>
              </div> <br>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Pembayaran</th>
                      <th>Nama Pelanggan</th>
                      <th>Nama barang</th>  
                      <th>Kategori</th>  
                      <th>harga</th> 
                      <th>Kode Jasa</th>     
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   $sql=mysqli_query($con, "Select * from pembayaran order by nama_pembayaran asc"); 
                   $no=1;
                   while ($r=mysqli_fetch_array($sql)){
                       echo"<tr><td>$no</td>
                               <td>$r[kd_pembayaran]</td>
                               <td>$r[nama_pembayaran]</td>";

                                $sql2=mysqli_query($con,"Select * from barang where kd_barang=$r[kd_barang]");
                                $r2=mysqli_fetch_array($sql2);

                                echo "<td>$r2[nama]</td>";

                                $sql3=mysqli_query($con,"Select * from kategori where id_kategori=$r[id_kategori]");
                                $r3=mysqli_fetch_array($sql3);

                                echo "<td>$r3[nama_kategori]</td>
                                <td>$r[harga]</td>";
                                
                                $sql4=mysqli_query($con,"Select * from jasa where kd_jasa=$r[kd_jasa]");
                                $r4=mysqli_fetch_array($sql4);

                                echo "<td>$r4[nama_jasa]</td>
                                <td>                   
                                <a href=?p=penjualan&aksi=edit&id=$r[kd_pembayaran]><button type='button' class='btn btn-info'>Edit</button></a>
                                <a href='$aksi?act=hapus&id=$r[kd_pembayaran]'<button type='button' class='btn btn-danger'>Delete</button></a>
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

<h3><i class="fa fa-angle-right"></i> Pembayaran  </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Pembayaran </h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/pembayaran/aksi_pembayaran.php?act=tambah"; ?> enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_pembayaran">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
                  <div class="col-sm-10">
                  <select name="nama" class="form-control">
                        <?php
                        $sql=mysqli_query($con, "Select * from barang order by nama");
                        while($r=mysqli_fetch_array($sql)){
                            echo"<option value=$r[kd_barang]>$r[nama]</option>";
                        }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                  <select name="kategori" class="form-control">
                        <?php
                        $sql=mysqli_query($con, "Select * from kategori order by nama_kategori");
                        while($r=mysqli_fetch_array($sql)){
                            echo"<option value=$r[id_kategori]>$r[nama_kategori]</option>";
                        }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="harga">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jasa Pengiriman</label>
                  <div class="col-sm-10">
                  <select name="jasa" class="form-control">
                        <?php
                        $sql=mysqli_query($con, "Select * from jasa order by nama_jasa");
                        while($r=mysqli_fetch_array($sql)){
                            echo"<option value=$r[kd_jasa]>$r[nama_jasa]</option>";
                        }
                        ?>
                      </select>
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

      $sql=mysqli_query($con, "Select * from pembayaran where kd_pembayaran='$_GET[id]'");
      $r=mysqli_fetch_array($sql);
?>
    
      <h3><i class="fa fa-angle-right"></i> Edit Pembayaran</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Pembayaran</h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/pembayaran/aksi_pembayaran.php?act=update"; ?> enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="kode" value=<?php echo"$r[kd_pembayaran]";?>>
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama_pembayaran" value=<?php echo"$r[nama_pembayaran]";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
                  <div class="col-sm-10">
                  <select name="nama" class="form-control">
                      <?php
                        $tampil=mysqli_query($con, "Select * from barang ORDER BY nama");
                            if($r['kd_barang']==0){
                              echo "<option value=0 selected>- Pilih Barang -</option>";
                            }

                           while($w=mysqli_fetch_array($tampil)){
                             if($r['kd_barang']==$w['kd_barang']){
                               echo "<option value=$w[kd_barang] selected>$w[nama]</option>";
                             }
                             else{
                               echo "<option value=$w[kd_barang]>$w[nama]</option>";
                             }
                           }
                           ?>
                      </select>
                </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                  <select name="kategori" class="form-control">
                      <?php
                        $tampil=mysqli_query($con, "Select * from kategori ORDER BY nama_kategori");
                            if($r['id_kategori']==0){
                              echo "<option value=0 selected>- Pilih Kategori -</option>";
                            }

                           while($w=mysqli_fetch_array($tampil)){
                             if($r['id_kategori']==$w['id_kategori']){
                               echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
                             }
                             else{
                               echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
                             }
                           }
                           ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="harga" value=<?php echo"$r[harga]";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jasa Pengiriman</label>
                  <div class="col-sm-10">
                  <select name="jasa" class="form-control">
                      <?php
                        $tampil=mysqli_query($con, "Select * from jasa ORDER BY nama_jasa");
                            if($r['kd_jasa']==0){
                              echo "<option value=0 selected>- Pilih Jasa Pengiriman -</option>";
                            }

                           while($w=mysqli_fetch_array($tampil)){
                             if($r['kd_jasa']==$w['kd_jasa']){
                               echo "<option value=$w[kd_jasa] selected>$w[nama_jasa]</option>";
                             }
                             else{
                               echo "<option value=$w[kd_jasa]>$w[nama_jasa]</option>";
                             }
                           }
                           ?>
                      </select>
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