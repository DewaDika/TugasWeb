<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo"<center>Untuk Mengakses Halaman Ini Anda Harus Login </center><br>";
  echo"<center><a href=../../index.php> Silakan Login </center>";
}else{
    include "../../../config/koneksi.php";

    $p=$_GET['p'];
    $act=$_GET['act'];

    if($act=='hapus'){
        mysqli_query($con,"Delete from pembayaran where kd_pembayaran='$_GET[id]'");
        header('location:../../media.php?p=penjualan');

    }else if($act=='tambah'){   

               $sql=mysqli_query($con, "Insert into pembayaran (nama_pembayaran, kd_barang, id_kategori, harga, kd_jasa) 
                values ('$_POST[nama_pembayaran]','$_POST[nama]','$_POST[kategori]','$_POST[harga]','$_POST[jasa]')");
                header('location:../../media.php?p=penjualan');
         

       }else if($act=='update'){   

        
            $sql=mysqli_query($con, "Update pembayaran set nama_pembayaran='$_POST[nama_pembayaran]', kd_barang='$_POST[nama]', id_kategori='$_POST[kategori]', harga='$_POST[harga]', kd_jasa='$_POST[jasa]'
             where kd_pembayaran ='$_POST[kode]'"); 
             header('location:../../media.php?p=penjualan');
       
    }
    
    }

?>