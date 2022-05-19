<?php
    include_once "../db/db_board.php";

    $s_id= $_POST['s_id'];
    $ctnt = $_POST['ctnt'];

    $param = [
        "s_id" => $s_id,
        "ctnt" => $ctnt
    ];

    $rs = ins_ctnt($param);
    if($rs) {
        echo "성공";
        
    }