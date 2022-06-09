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
        mysqli_query($con,"Delete from barang where kd_barang='$_GET[id]'");
        header('location:../../media.php?p=produk');

    }else if($act=='tambah'){   
           $lokasi_file = $_FILES['file']['tmp_name'];
           $nama_file   = $_FILES['file']['name'];
           $folder      = "../../../foto_produk/$nama_file";
           $tgl_upload  = date("Ymd");

           if(!empty($lokasi_file)){
               move_uploaded_file($lokasi_file,"$folder");
               $sql=mysqli_query($con, "Insert into barang (nama, id_kategori, deskripsi, jumlah, tanggal_masuk, harga_jual, foto) 
                values ('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$_POST[jumlah]','$_POST[tanggal_masuk]','$_POST[harga]','$nama_file')");
                header('location:../../media.php?p=produk');
           } else{
            $sql=mysqli_query($con, "Insert into barang (nama, id_kategori, deskripsi, jumlah, tanggal_masuk, harga_jual) 
            values ('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$_POST[jumlah]','$_POST[tanggal_masuk]','$_POST[harga]')");
           }

       }else if($act=='update'){   
        $lokasi_file = $_FILES['file']['tmp_name'];
        $nama_file   = $_FILES['file']['name'];
        $folder      = "../../../foto_produk/$nama_file";
        $tgl_upload  = date("Ymd");

        if(empty($lokasi_file)){  
            $sql=mysqli_query($con, "Update barang set nama='$_POST[nama]', id_kategori='$_POST[kategori]', deskripsi='$_POST[deskripsi]', jumlah='$_POST[jumlah]', tanggal_masuk='$_POST[tanggal_masuk]'
            , harga_jual='$_POST[harga]' where kd_barang ='$_POST[kode]'"); 
             header('location:../../media.php?p=produk');
        } else{
         move_uploaded_file($lokasi_file,"$folder");
         $sql=mysqli_query($con, "Update barang set nama='$_POST[nama]', id_kategori='$_POST[kategori]', deskripsi='$_POST[deskripsi]', jumlah='$_POST[jumlah]', tanggal_masuk='$_POST[tanggal_masuk]'
         , harga_jual='$_POST[harga]', foto='$nama_file' where kd_barang ='$_POST[kode]'");
         header('location:../../media.php?p=produk');
        }
    }
    
    }

?>