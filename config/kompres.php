<?php

function UploadImage($fupload_name){
    $vdir_upload = "../../../foto_produk/";
    $vfile_upload = $vdir_upload . $fupload_name;

    move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload);

    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_width = imageSY($im_src);

    $dst_width = 110;
    $dst_heiht = ($dst_width/$src_width)*$src_height;

    $im = imagecreatetruecolor($dst_width, $dst_heiht);
    imagecopysampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_heiht, $src_width, $src_height);

    imagejpg($im, $vdir_upload . "small_" . $fupload_name);

    $dst_width2 = 233;
    $dst_heiht2 = 288;

    $im2 = imagecreatetruecolor($dst_width2, $dst_heiht2);
    imagecopysampled($im, $im_src, 0, 0, 0, 0, $dst_width2, $dst_heiht2, $src_width, $src_height);

    imagejpg($im, $vdir_upload . "medium_" . $fupload_name);

    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}
?>