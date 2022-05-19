<?php
include_once "../db/db_board.php";
session_start();
define("FILE_PATH", "../images/");

$login_user= &$_SESSION["login_user"];
$s_id= $_POST['s_id'];

// var_dump($_FILES);

if($_FILES["pic_img"]["name"] === "") {
    echo "이미지가 있나 확인해보시오";
    exit;
}

function gen_uuid_v4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0x0fff) | 0x4000
        , mt_rand(0, 0x3fff) | 0x8000
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff) 
    ); 
}

$img_name= $_FILES["pic_img"]["name"];
$last_index= mb_strrpos($img_name, ".");
$ext= mb_substr($img_name, $last_index);

$target_filenm= gen_uuid_v4() . $ext;
$target_path= FILE_PATH . $login_user["u_id"];
if(!is_dir($target_path)) {
    mkdir($target_path, 0777, true);
}

$tmp_img= $_FILES["pic_img"]["tmp_name"];

$imgUpload= move_uploaded_file($tmp_img, $target_path . "/" . $target_filenm);

if($imgUpload) {
    $param= [
        "pic_img" => $target_filenm
    ];
} else {
    $param= [
        "pic_img" => null
    ];
}

$param+= [
    "s_id" => $s_id 
];
$result= ins_img($param);

if($result) {
    echo
    "<script>
        alert('사진이 등록되었습니다.');
        location.replace('../show/show_detail.php?s_id={$s_id}');
    </script> ";
}