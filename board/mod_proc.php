<?php
    include_once '../db/db_board.php';
    
    session_start();
    $login_user = $_SESSION['login_user'];

    $b_id = $_POST['b_id'];
    $b_title = $_POST['b_title'];
    $b_ctnt = $_POST['b_ctnt'];
    $u_id = $login_user['u_id'];

    $param = [
        "b_id" => $b_id,
        "b_title" => $b_title,
        "b_ctnt" => $b_ctnt,
        "u_id" => $u_id,
    ];

    $result = upd_board($param);
    print "result: " . $result;
    if($result) {
        header("location: detail.php?b_id=$b_id");
    }