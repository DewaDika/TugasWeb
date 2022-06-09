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
        mysqli_query($con,"Delete from kategori where kd_jasa='$_GET[id]'");
        header('location:../../media.php?p=jasa');

    }else if($act=='tambah'){   

               $sql=mysqli_query($con, "Insert into jasa (nama_jasa) 
                values ('$_POST[nama_jasa]')");
                header('location:../../media.php?p=jasa');
         

       }else if($act=='update'){   

        
            $sql=mysqli_query($con, "Update jasa set nama_jasa='$_POST[nama_jasa]' where kd_jasa ='$_POST[kode]'"); 
             header('location:../../media.php?p=jasa');
       
    }
    
    }

?>