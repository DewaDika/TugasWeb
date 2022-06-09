<?php
session_start();
session_destroy();
echo "<script>alert('Anda Keluar Dari Halaman Admin'); window.location = 'index.php' </script>";
?>