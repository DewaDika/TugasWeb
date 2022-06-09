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
        mysqli_query($con,"Delete from pelanggan where id_pelanggan='$_GET[id]'");
        header('location:../../media.php?p=customer');

    }else if($act=='tambah'){   

               $sql=mysqli_query($con, "Insert into pelanggan (nama_pelanggan, email, hp) values ('$_POST[nama_pelanggan]','$_POST[email]','$_POST[hp]')");
                header('location:../../media.php?p=customer');
         

       }else if($act=='update'){   

        
            $sql=mysqli_query($con, "Update pelanggan set nama_pelanggan='$_POST[nama_pelanggan]', email='$_POST[email]', hp='$_POST[hp]' where id_pelanggan ='$_POST[kode]'"); 
             header('location:../../media.php?p=customer');
       
    }
    
    }

?>